import 'package:flutter/material.dart';

class HomePage extends StatelessWidget {
  final String username;
  const HomePage({super.key, required this.username});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFF3F3D9B),
      appBar: AppBar(
        backgroundColor: const Color(0xFF3F3D9B),
        elevation: 0,
        toolbarHeight: 90,
        titleSpacing: 16,
        title: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const Text(
              "ABADI USAHA",
              style: TextStyle(
                color: Colors.white,
                fontSize: 22,
                fontWeight: FontWeight.bold,
              ),
            ),
            const SizedBox(height: 4),
            Text(
              "Halo, $username",
              style: const TextStyle(
                color: Colors.white70,
                fontSize: 16,
              ),
            ),
          ],
        ),
        actions: [
          IconButton(
            icon: const Icon(Icons.notifications_none, color: Colors.white),
            onPressed: () {},
          ),
        ],
      ),
      body: Padding(
        padding: const EdgeInsets.all(16),
        child: Column(
          children: [
            // Card pekerjaan dengan silang & centang
            Card(
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(20),
              ),
              elevation: 4,
              child: Padding(
                padding:
                    const EdgeInsets.symmetric(vertical: 20, horizontal: 16),
                child: Row(
                  children: [
                    // Deskripsi pekerjaan
                    Expanded(
                      child: Text(
                        "Sedot WC Rumah Aldi",
                        style: const TextStyle(
                          fontSize: 18,
                          fontWeight: FontWeight.w500,
                          color: Colors.black87,
                        ),
                      ),
                    ),
                    // Icon silang
                    const Icon(Icons.close, color: Colors.red, size: 40),
                    const SizedBox(width: 10),
                    // Icon centang
                    const Icon(Icons.check_circle,
                        color: Colors.green, size: 40),
                  ],
                ),
              ),
            ),

            const SizedBox(height: 20),

            // Card pekerjaan kedua
            Card(
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(20),
              ),
              elevation: 4,
              child: Padding(
                padding:
                    const EdgeInsets.symmetric(vertical: 20, horizontal: 16),
                child: Row(
                  children: [
                    Expanded(
                      child: Text(
                        "Pembersihan Septic Tank Daerah Bandar Lor",
                        style: const TextStyle(
                          fontSize: 18,
                          fontWeight: FontWeight.w500,
                          color: Colors.black87,
                        ),
                      ),
                    ),
                    const Icon(Icons.close, color: Colors.red, size: 40),
                    const SizedBox(width: 10),
                    const Icon(Icons.check_circle,
                        color: Colors.green, size: 40),
                  ],
                ),
              ),
            ),

            const SizedBox(height: 20),

            // Card pekerjaan ketiga
            Card(
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(20),
              ),
              elevation: 4,
              child: Padding(
                padding:
                    const EdgeInsets.symmetric(vertical: 20, horizontal: 16),
                child: Row(
                  children: [
                    Expanded(
                      child: Text(
                        "Perbaikan Saluran Air Rumah Aldi",
                        style: const TextStyle(
                          fontSize: 18,
                          fontWeight: FontWeight.w500,
                          color: Colors.black87,
                        ),
                      ),
                    ),
                    const Icon(Icons.close, color: Colors.red, size: 40),
                    const SizedBox(width: 10),
                    const Icon(Icons.check_circle,
                        color: Colors.green, size: 40),
                  ],
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}
