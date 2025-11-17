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
  List<Map<String, dynamic>> periodeGaji = [];

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
      if (response.statusCode == 200) {
        final data = json.decode(response.body);

        // Jika API mengembalikan list per periode
        // Pastikan setiap item memiliki: periode_start, periode_end, total_pendapatan, jumlah_pekerjaan, status_terakhir
        setState(() {
          if (data['data'] != null && data['data'] is List) {
            // Group data by periode jika perlu, atau langsung gunakan list API
            periodeGaji = List<Map<String, dynamic>>.from(data['data']);
          }
          _loading = false;
        });
      } else {
        throw Exception("Gagal memuat data dari server");
      }
    } catch (e) {
      debugPrint("❌ Error: $e");
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
          : periodeGaji.isEmpty
              ? const Center(
                  child: Text(
                    "Belum ada gaji tersedia",
                    style: TextStyle(color: Colors.white70, fontSize: 16),
                  ),
                )
              : ListView.builder(
                  padding: const EdgeInsets.all(16),
                  itemCount: periodeGaji.length,
                  itemBuilder: (context, index) {
                    final item = periodeGaji[index];

                    // Fallback jika null
                    final periodeStart = item['periode_start'] ?? '-';
                    final periodeEnd = item['periode_end'] ?? '-';
                    final totalPekerjaan = item['jumlah_pekerjaan'] ?? 0;
                    final totalGaji = (item['total_pendapatan'] ?? 0).toDouble();
                    final status = item['status_terakhir'] ?? '-';

                    return Card(
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(20),
                      ),
                      color: Colors.orange,
                      elevation: 5,
                      margin: const EdgeInsets.symmetric(vertical: 8),
                      child: Padding(
                        padding: const EdgeInsets.all(20),
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Text(
                              "Periode: $periodeStart s/d $periodeEnd",
                              style: const TextStyle(
                                color: Colors.white70,
                                fontSize: 14,
                              ),
                            ),
                            const SizedBox(height: 10),
                            Text(
                              "Total Pekerjaan: $totalPekerjaan",
                              style: const TextStyle(
                                color: Colors.white,
                                fontSize: 18,
                                fontWeight: FontWeight.bold,
                              ),
                            ),
                            const SizedBox(height: 10),
                            Text(
                              "Total Gaji: Rp ${totalGaji.toStringAsFixed(0)}",
                              style: const TextStyle(
                                color: Colors.white,
                                fontSize: 18,
                                fontWeight: FontWeight.bold,
                              ),
                            ),
                            const SizedBox(height: 10),
                            Text(
                              "Status Gaji: $status",
                              style: TextStyle(
                                color: status == 'Lunas'
                                    ? Colors.greenAccent
                                    : Colors.redAccent,
                                fontSize: 16,
                                fontWeight: FontWeight.bold,
                              ),
                            ),
                          ],
                        ),
                      ),
                    );
                  },
                ),
    );
  }
}
