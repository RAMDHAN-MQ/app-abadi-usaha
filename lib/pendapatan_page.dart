import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;

class PendapatanPage extends StatefulWidget {
  final int userId;
  final String username;

  const PendapatanPage({
    super.key,
    required this.username,
    required this.userId,
  });

  @override
  State<PendapatanPage> createState() => _PendapatanPageState();
}

class _PendapatanPageState extends State<PendapatanPage> {
  bool _loading = true;

  double totalPendapatan = 0;
  int jumlahPekerjaan = 0;
  List<dynamic> detailGaji = [];

  @override
  void initState() {
    super.initState();
    fetchPendapatan();
  }

  Future<void> fetchPendapatan() async {
    final url = Uri.parse(
      'http://192.168.1.65:8000/api/gaji/${widget.userId}',
    );

    try {
      final response = await http.get(url);
      print("API RESPONSE: ${response.body}");

      if (response.statusCode == 200) {
        final jsonData = json.decode(response.body);

        setState(() {
          totalPendapatan = (jsonData["total_pendapatan"] ?? 0).toDouble();
          jumlahPekerjaan = jsonData["jumlah_pekerjaan"] ?? 0;
          detailGaji = jsonData["data"] ?? [];
          _loading = false;
        });
      }
    } catch (e) {
      print("❌ ERROR: $e");
      setState(() => _loading = false);
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
          "Pendapatan",
          style: TextStyle(color: Colors.white, fontWeight: FontWeight.bold),
        ),
        centerTitle: true,
      ),
      body: _loading
          ? const Center(child: CircularProgressIndicator(color: Colors.white))
          : SingleChildScrollView(
              padding: const EdgeInsets.all(16),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  // =====================
                  //       SUMMARY CARD
                  // =====================
                  Container(
                    width: double.infinity,
                    padding: const EdgeInsets.all(20),
                    decoration: BoxDecoration(
                      color: Colors.orange,
                      borderRadius: BorderRadius.circular(20),
                    ),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        const Text(
                          "Total Pendapatan",
                          style: TextStyle(
                            color: Colors.white70,
                            fontSize: 16,
                          ),
                        ),
                        const SizedBox(height: 5),
                        Text(
                          "Rp ${totalPendapatan.toStringAsFixed(0)}",
                          style: const TextStyle(
                            color: Colors.white,
                            fontSize: 28,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                        const SizedBox(height: 10),
                        Text(
                          "Jumlah Pekerjaan: $jumlahPekerjaan",
                          style: const TextStyle(
                            color: Colors.white,
                            fontSize: 18,
                          ),
                        ),
                      ],
                    ),
                  ),

                  const SizedBox(height: 20),

                  // =====================
                  //    DETAIL PEKERJAAN
                  // =====================
                  const Text(
                    "Detail Pekerjaan",
                    style: TextStyle(
                      color: Colors.white,
                      fontSize: 20,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  const SizedBox(height: 12),

                  ...detailGaji.map((item) {
                    final pendapatan = (item['pendapatan'] ?? 0).toDouble();
                    final status = item['status'] ?? "-";
                    final statusColor =
                        status == "Lunas" ? Colors.green : Colors.red;

                    return SizedBox(
                      width: double.infinity,
                      child: Card(
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(20),
                        ),
                        color: Colors.white,
                        elevation: 4,
                        margin: const EdgeInsets.symmetric(vertical: 8),
                        child: Padding(
                          padding: const EdgeInsets.all(16),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              // Tanggal
                              Text(
                                "Tanggal: ${item['tanggal'] ?? '-'}",
                                style: const TextStyle(
                                  fontWeight: FontWeight.bold,
                                  fontSize: 16,
                                ),
                              ),

                              const SizedBox(height: 6),

                              // Pemesan & Layanan
                              Text("Pemesan: ${item['pemesanan']?['nama_pemesan'] ?? '-'}"),
                              Text("Layanan: ${item['pemesanan']?['layanan'] ?? '-'}"),

                              const SizedBox(height: 6),

                              // Pendapatan
                              Text(
                                "Pendapatan: Rp ${pendapatan.toStringAsFixed(0)}",
                                style: const TextStyle(
                                  fontSize: 16,
                                  color: Colors.green,
                                  fontWeight: FontWeight.bold,
                                ),
                              ),

                              const SizedBox(height: 6),

                              // Status Gaji
                              Text(
                                "Status: $status",
                                style: TextStyle(
                                  fontSize: 16,
                                  color: statusColor,
                                  fontWeight: FontWeight.bold,
                                ),
                              ),
                            ],
                          ),
                        ),
                      ),
                    );
                  }),
                ],
              ),
            ),
    );
  }
}
