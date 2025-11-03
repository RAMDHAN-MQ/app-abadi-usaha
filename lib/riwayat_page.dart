import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

class RiwayatPage extends StatefulWidget {
  final String username;
  final int pekerjaId;
  const RiwayatPage({super.key, required this.username, required this.pekerjaId});

  @override
  State<RiwayatPage> createState() => _RiwayatPageState();
}

class _RiwayatPageState extends State<RiwayatPage> {
  List<dynamic> progressList = [];
  List<dynamic> selesaiList = [];
  bool isLoading = true;

  @override
  void initState() {
    super.initState();
    fetchRiwayat();
  }

  Future<void> fetchRiwayat() async {
    try {
      // Ganti pekerja_id sesuai yang login, misal sementara id 1
      final url = Uri.parse('http://192.168.1.65:8000/api/riwayatPesanan/${widget.pekerjaId}');
      final response = await http.get(url);

      if (response.statusCode == 200) {
        final data = jsonDecode(response.body);

        // Misal response dari Laravel punya struktur seperti:
        // { "data": [ { "id": 1, "nama_layanan": "...", "status": "proses" }, ... ] }
        List<dynamic> all = data["data"];

        setState(() {
          progressList = all
              .where((item) => item["status"] == "proses")
              .toList();
          selesaiList = all
              .where((item) => item["status"] == "selesai")
              .toList();
          isLoading = false;
        });
      } else {
        throw Exception("Gagal memuat data dari server");
      }
    } catch (e) {
      print("❌ Error: $e");
      setState(() => isLoading = false);
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text("Gagal memuat data riwayat")),
      );
    }
  }

  // Fungsi update status jadi "selesai"
  Future<void> tandaiSelesai(int id) async {
    try {
      final url = Uri.parse('http://192.168.1.65:8000/api/update-status/$id');
      final response = await http.put(
        url,
        headers: {"Content-Type": "application/json"},
        body: jsonEncode({"status": "selesai"}),
      );

      if (response.statusCode == 200) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(content: Text("Pekerjaan ditandai selesai")),
        );
        fetchRiwayat(); // Refresh data
      } else {
        throw Exception("Gagal update status");
      }
    } catch (e) {
      print("❌ Error update status: $e");
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFF3F3D9B),
      appBar: AppBar(
        backgroundColor: const Color(0xFF3F3D9B),
        elevation: 0,
        title: const Text(
          "Riwayat",
          style: TextStyle(color: Colors.white, fontWeight: FontWeight.bold),
        ),
        centerTitle: true,
      ),
      body: isLoading
          ? const Center(child: CircularProgressIndicator(color: Colors.white))
          : SingleChildScrollView(
              padding: const EdgeInsets.all(16.0),
              child: Column(
                children: [
                  // ====== BAGIAN PROGRESS ======
                  _buildSection(
                    title: "Progress",
                    icon: Icons.timelapse,
                    iconColor: Colors.orange,
                    data: progressList,
                    showButton: true,
                  ),

                  const SizedBox(height: 20),

                  // ====== BAGIAN SELESAI ======
                  _buildSection(
                    title: "Selesai",
                    icon: Icons.check_circle,
                    iconColor: Colors.green,
                    data: selesaiList,
                    showButton: false,
                  ),
                ],
              ),
            ),
    );
  }

  Widget _buildSection({
    required String title,
    required IconData icon,
    required Color iconColor,
    required List<dynamic> data,
    required bool showButton,
  }) {
    return Container(
      width: double.infinity,
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(20),
        boxShadow: const [
          BoxShadow(color: Colors.black26, blurRadius: 8, offset: Offset(0, 4)),
        ],
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              Icon(icon, color: iconColor, size: 28),
              const SizedBox(width: 8),
              Text(
                title,
                style: const TextStyle(
                  color: Colors.black87,
                  fontSize: 18,
                  fontWeight: FontWeight.bold,
                ),
              ),
            ],
          ),
          const SizedBox(height: 10),

          if (data.isEmpty)
            const Text(
              "Tidak ada data.",
              style: TextStyle(color: Colors.black54, fontSize: 14),
            )
          else
            ...data.map(
              (item) => Container(
                width: double.infinity,
                margin: const EdgeInsets.symmetric(vertical: 6),
                padding: const EdgeInsets.all(12),
                decoration: BoxDecoration(
                  color: iconColor.withOpacity(0.05),
                  borderRadius: BorderRadius.circular(12),
                  border: Border.all(color: iconColor.withOpacity(0.3)),
                ),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      item["nama_layanan"] ?? "-",
                      style: const TextStyle(
                        color: Colors.black87,
                        fontSize: 16,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                    const SizedBox(height: 4),
                    Text(
                      "No. HP: ${item["no_telp"] ?? '-'}",
                      style: const TextStyle(color: Colors.black87),
                    ),
                    Text(
                      "Alamat: ${item["alamat"] ?? '-'}",
                      style: const TextStyle(color: Colors.black87),
                    ),
                    if (showButton)
                      Align(
                        alignment: Alignment.bottomRight,
                        child: IconButton(
                          onPressed: () => tandaiSelesai(item["id"]),
                          icon: const Icon(
                            Icons.check_circle,
                            color: Colors.green,
                            size: 28,
                          ),
                        ),
                      ),
                  ],
                ),
              ),
            ),
        ],
      ),
    );
  }
}
