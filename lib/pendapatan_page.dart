import 'package:flutter/material.dart';

class PendapatanPage extends StatelessWidget {
  final String username;

  const PendapatanPage({super.key, required this.username});

  @override
  Widget build(BuildContext context) {
    // Data dummy
    final double totalPendapatan = 1500000; // contoh total pendapatan
    final int jumlahPekerjaan = 12; // contoh jumlah pekerjaan
    final List<Map<String, dynamic>> transaksi = [
      {
        "tanggal": "2025-10-01",
        "uang": "Rp 150.000",
        "detail": [
          "Sedot WC Rumah A - Rp 100.000",
          "Pembersihan septic tank Rumah B - Rp 50.000"
        ]
      },
      {
        "tanggal": "2025-10-03",
        "uang": "Rp 200.000",
        "detail": [
          "Sedot WC Rumah C - Rp 120.000",
          "Pembersihan septic tank Rumah D - Rp 80.000"
        ]
      },
      {
        "tanggal": "2025-10-05",
        "uang": "Rp 100.000",
        "detail": ["Sedot WC Rumah E - Rp 100.000"]
      },
      {
        "tanggal": "2025-10-07",
        "uang": "Rp 250.000",
        "detail": [
          "Sedot WC Rumah F - Rp 150.000",
          "Pembersihan septic tank Rumah G - Rp 100.000"
        ]
      },
      {
        "tanggal": "2025-10-10",
        "uang": "Rp 300.000",
        "detail": [
          "Sedot WC Rumah H - Rp 200.000",
          "Pembersihan septic tank Rumah I - Rp 100.000"
        ]
      },
    ];

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
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16),
        child: Column(
          children: [
            // Card total pendapatan dan jumlah pekerjaan
            Row(
              children: [
                Expanded(
                  child: Card(
                    shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(20)),
                    color: Colors.orange,
                    elevation: 5,
                    child: Padding(
                      padding: const EdgeInsets.symmetric(
                          vertical: 20, horizontal: 16),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          const Text(
                            "Total Pendapatan",
                            style: TextStyle(
                                color: Colors.white70,
                                fontSize: 14,
                                fontWeight: FontWeight.w500),
                          ),
                          const SizedBox(height: 10),
                          Text(
                            "Rp ${totalPendapatan.toStringAsFixed(0)}",
                            style: const TextStyle(
                                color: Colors.white,
                                fontSize: 20,
                                fontWeight: FontWeight.bold),
                          ),
                        ],
                      ),
                    ),
                  ),
                ),
                const SizedBox(width: 16),
                Expanded(
                  child: Card(
                    shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(20)),
                    color: Colors.green,
                    elevation: 5,
                    child: Padding(
                      padding: const EdgeInsets.symmetric(
                          vertical: 20, horizontal: 16),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          const Text(
                            "Pekerjaan Selesai",
                            style: TextStyle(
                                color: Colors.white70,
                                fontSize: 14,
                                fontWeight: FontWeight.w500),
                          ),
                          const SizedBox(height: 10),
                          Text(
                            "$jumlahPekerjaan",
                            style: const TextStyle(
                                color: Colors.white,
                                fontSize: 20,
                                fontWeight: FontWeight.bold),
                          ),
                        ],
                      ),
                    ),
                  ),
                ),
              ],
            ),
            const SizedBox(height: 30),
            // List transaksi
            Align(
              alignment: Alignment.centerLeft,
              child: const Text(
                "Riwayat Uang Masuk",
                style: TextStyle(
                    color: Colors.white,
                    fontSize: 18,
                    fontWeight: FontWeight.bold),
              ),
            ),
            const SizedBox(height: 10),
            ListView.builder(
              physics: const NeverScrollableScrollPhysics(),
              shrinkWrap: true,
              itemCount: transaksi.length,
              itemBuilder: (context, index) {
                final item = transaksi[index];
                return Card(
                  shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(20)),
                  color: Colors.white,
                  elevation: 3,
                  margin: const EdgeInsets.symmetric(vertical: 6),
                  child: ListTile(
                    leading: const Icon(Icons.date_range, color: Colors.orange),
                    title: Text(item['tanggal'],
                        style: const TextStyle(
                            fontWeight: FontWeight.bold, fontSize: 16)),
                    trailing: Text(item['uang'],
                        style: const TextStyle(
                            fontWeight: FontWeight.bold, fontSize: 16)),
                    onTap: () {
                      // Tampilkan detail transaksi
                      showDialog(
                        context: context,
                        builder: (_) => AlertDialog(
                          title: Text("Detail Transaksi ${item['tanggal']}"),
                          content: SizedBox(
                            width: double.maxFinite,
                            child: ListView.builder(
                              shrinkWrap: true,
                              itemCount: (item['detail'] as List).length,
                              itemBuilder: (context, i) {
                                return ListTile(
                                  leading: const Icon(Icons.work, size: 20),
                                  title: Text(item['detail'][i]),
                                );
                              },
                            ),
                          ),
                          actions: [
                            TextButton(
                                onPressed: () => Navigator.pop(context),
                                child: const Text("OK"))
                          ],
                        ),
                      );
                    },
                  ),
                );
              },
            ),
          ],
        ),
      ),
    );
  }
}
