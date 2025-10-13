import 'package:flutter/material.dart';

class RiwayatPage extends StatelessWidget {
  final String username;
  const RiwayatPage({super.key, required this.username});

  @override
  Widget build(BuildContext context) {
    // Dummy data pekerjaan yang sudah selesai
    final List<String> pekerjaanSelesai = [
      "Sedot WC Rumah Sheva",
      "Pembersihan Septic Tank Daerah Rejomulyo",
      "Perbaikan Saluran Air Rumah Sheva",
    ];

    return Scaffold(
      backgroundColor: const Color(0xFF3F3D9B),
      appBar: AppBar(
        backgroundColor: const Color(0xFF3F3D9B),
        elevation: 0,
        title: const Text(
          "Riwayat",
          style: TextStyle(
            color: Colors.white,
            fontWeight: FontWeight.bold,
          ),
        ),
        centerTitle: true,
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          children: [
            // CARD STATUS PROGRESS
            Container(
              width: double.infinity,
              padding: const EdgeInsets.all(16),
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.circular(20),
                boxShadow: const [
                  BoxShadow(
                    color: Colors.black26,
                    blurRadius: 8,
                    offset: Offset(0, 4),
                  ),
                ],
              ),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Row(
                    children: const [
                      Icon(Icons.timelapse, color: Colors.orange, size: 28),
                      SizedBox(width: 8),
                      Text(
                        "Progress",
                        style: TextStyle(
                          color: Colors.black87,
                          fontSize: 18,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                    ],
                  ),
                  const SizedBox(height: 10),
                  const Text(
                    "Progress pengerjaan sedang berlanjut.",
                    style: TextStyle(color: Colors.black54, fontSize: 14),
                  ),
                  const SizedBox(height: 12),
                  // Progress dummy
                  LinearProgressIndicator(
                    value: 0.6, // progress 60%
                    color: Colors.orange,
                    backgroundColor: Colors.orangeAccent.withOpacity(0.3),
                    minHeight: 10,
                  ),
                  const SizedBox(height: 8),
                  const Text(
                    "60% selesai",
                    style: TextStyle(color: Colors.black54, fontSize: 12),
                  ),
                ],
              ),
            ),

            const SizedBox(height: 20),

            // CARD STATUS SELESAI
            Container(
              width: double.infinity,
              padding: const EdgeInsets.all(16),
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.circular(20),
                boxShadow: const [
                  BoxShadow(
                    color: Colors.black26,
                    blurRadius: 8,
                    offset: Offset(0, 4),
                  ),
                ],
              ),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Row(
                    children: const [
                      Icon(Icons.check_circle, color: Colors.green, size: 28),
                      SizedBox(width: 8),
                      Text(
                        "Selesai",
                        style: TextStyle(
                          color: Colors.black87,
                          fontSize: 18,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                    ],
                  ),
                  const SizedBox(height: 10),
                  ...pekerjaanSelesai.map((job) => Padding(
                        padding: const EdgeInsets.symmetric(vertical: 4.0),
                        child: Text(
                          "• $job",
                          style: const TextStyle(
                              color: Colors.black54, fontSize: 14),
                        ),
                      )),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}
