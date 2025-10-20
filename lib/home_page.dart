import 'package:flutter/material.dart';
import 'dart:convert';
import 'package:http/http.dart' as http;

// Model PesananDetail
class PesananDetail {
  final int id;
  final String? verifikasi;
  final String? alasan;

  PesananDetail({required this.id, this.verifikasi, this.alasan});

  factory PesananDetail.fromJson(Map<String, dynamic> json) {
    return PesananDetail(
      id: json['detail_id'],
      verifikasi: json['verifikasi'],
      alasan: json['alasan'],
    );
  }
}

// Model Pesanan
class Pesanan {
  final int id;
  final String noTelp;
  final String alamat;
  final String layananNama;
  final PesananDetail detail;

  Pesanan({
    required this.id,
    required this.noTelp,
    required this.alamat,
    required this.layananNama,
    required this.detail,
  });

  factory Pesanan.fromJson(Map<String, dynamic> json) {
    return Pesanan(
      id: json['pesanan_id'],
      noTelp: json['no_telp'] ?? '-',
      alamat: json['alamat'] ?? '-',
      layananNama: json['nama_layanan'] ?? '-',
      detail: PesananDetail.fromJson(json),
    );
  }
}

class HomePage extends StatefulWidget {
  final int pekerjaId; // ID pekerja yang login
  const HomePage({super.key, required this.pekerjaId});

  @override
  State<HomePage> createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  late Future<List<Pesanan>> pesananFuture;

  @override
  void initState() {
    super.initState();
    pesananFuture = fetchPesanan();
  }

  // Ambil data pesanan dari API
  Future<List<Pesanan>> fetchPesanan() async {
    final url = Uri.parse(
        'http://192.168.1.65:8000/api/pesanan/${widget.pekerjaId}');
    final response = await http.get(url);

    if (response.statusCode == 200) {
      final jsonData = jsonDecode(response.body);
      final List list = jsonData['data'] as List;
      return list.map((e) => Pesanan.fromJson(e)).toList();
    } else {
      throw Exception('Gagal mengambil data pemesanan');
    }
  }

  // Update status verifikasi (terima / tolak) dan refresh list
  Future<void> updateVerifikasi(int detailId, String status) async {
    final url = Uri.parse(
        'http://192.168.1.65:8000/api/verifikasi_pemesanan/$detailId');
    final response = await http.put(
      url,
      headers: {"Content-Type": "application/json"},
      body: jsonEncode({"verifikasi": status}),
    );

    if (response.statusCode != 200) {
      throw Exception('Gagal update verifikasi');
    }

    // Refresh data setelah update
    setState(() {
      pesananFuture = fetchPesanan();
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFF3F3D9B),
      appBar: AppBar(
        backgroundColor: const Color(0xFF3F3D9B),
        elevation: 0,
        title: const Text(
          "Beranda",
          style: TextStyle(color: Colors.white, fontWeight: FontWeight.bold),
        ),
        centerTitle: true,
      ),
      body: FutureBuilder<List<Pesanan>>(
        future: pesananFuture,
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return const Center(child: CircularProgressIndicator());
          } else if (snapshot.hasError) {
            return Center(child: Text('Error: ${snapshot.error}'));
          } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
            return const Center(child: Text('Belum ada pesanan', style: TextStyle(color: Colors.white, fontSize: 16, fontWeight: FontWeight.bold),));
          } else {
            final pesananList = snapshot.data!;
            return ListView.builder(
              padding: const EdgeInsets.all(16),
              itemCount: pesananList.length,
              itemBuilder: (context, index) {
                final pesanan = pesananList[index];
                return Card(
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(20),
                  ),
                  elevation: 4,
                  margin: const EdgeInsets.only(bottom: 16),
                  child: Padding(
                    padding: const EdgeInsets.all(16),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text('No Telp: ${pesanan.noTelp}',
                            style: const TextStyle(
                                fontWeight: FontWeight.bold, fontSize: 16)),
                        Text('Alamat: ${pesanan.alamat}'),
                        Text('Layanan: ${pesanan.layananNama}'),
                        const SizedBox(height: 12),
                        Row(
                          mainAxisAlignment: MainAxisAlignment.end,
                          children: [
                            IconButton(
                              icon: const Icon(Icons.check_circle,
                                  color: Colors.green, size: 36),
                              onPressed: () async {
                                await updateVerifikasi(
                                    pesanan.detail.id, 'terima');
                                ScaffoldMessenger.of(context).showSnackBar(
                                  const SnackBar(
                                    content: Text('Pesanan diterima'),
                                  ),
                                );
                              },
                            ),
                            const SizedBox(width: 20),
                            IconButton(
                              icon: const Icon(Icons.close,
                                  color: Colors.red, size: 36),
                              onPressed: () async {
                                await updateVerifikasi(
                                    pesanan.detail.id, 'tolak');
                                ScaffoldMessenger.of(context).showSnackBar(
                                  const SnackBar(
                                    content: Text('Pesanan ditolak'),
                                  ),
                                );
                              },
                            ),
                          ],
                        ),
                      ],
                    ),
                  ),
                );
              },
            );
          }
        },
      ),
    );
  }
}
