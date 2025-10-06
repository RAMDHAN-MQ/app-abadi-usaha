import 'package:flutter/material.dart';

class IndexPage extends StatelessWidget {
  const IndexPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      body: SingleChildScrollView(
        child: Column(
          children: [
            // 🔹 NAVBAR
            Container(
              padding: const EdgeInsets.symmetric(horizontal: 40, vertical: 20),
              color: const Color(0xFF2E2575),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  const Text(
                    "Abadi Usaha",
                    style: TextStyle(
                        color: Colors.white,
                        fontSize: 22,
                        fontWeight: FontWeight.bold),
                  ),
                  Row(
                    children: [
                      _buildNavItem("Beranda"),
                      _buildNavItem("Layanan"),
                      _buildNavItem("Tentang"),
                      _buildNavItem("Kontak"),
                      const SizedBox(width: 20),
                      TextButton(
                        onPressed: () {},
                        child: const Text("Daftar",
                            style: TextStyle(color: Colors.white)),
                      ),
                      ElevatedButton(
                        onPressed: () {},
                        style: ElevatedButton.styleFrom(
                          backgroundColor: Colors.white,
                        ),
                        child: const Text(
                          "Masuk",
                          style: TextStyle(color: Colors.black),
                        ),
                      ),
                    ],
                  )
                ],
              ),
            ),

            // 🔹 HERO SECTION
            Container(
              padding: const EdgeInsets.all(40),
              color: const Color(0xFF3B3486),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.spaceAround,
                children: [
                  Expanded(
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        const Text(
                          "Membantu Melancarkan\nSaluran WC",
                          style: TextStyle(
                              fontSize: 32,
                              fontWeight: FontWeight.bold,
                              color: Colors.white),
                        ),
                        const SizedBox(height: 15),
                        const Text(
                          "Abadi Usaha hadir untuk temukan pilihan terbaik\n"
                          "untuk membersihkan saluran rumah anda",
                          style: TextStyle(color: Colors.white70, fontSize: 16),
                        ),
                        const SizedBox(height: 20),
                        ElevatedButton(
                          onPressed: () {},
                          style: ElevatedButton.styleFrom(
                            backgroundColor: Colors.white,
                            foregroundColor: Colors.black,
                          ),
                          child: const Text("Pesan"),
                        ),
                      ],
                    ),
                  ),
                  const SizedBox(width: 30),
                  Expanded(
                    child: Image.network(
                      "https://cdn-icons-png.flaticon.com/512/3184/3184770.png",
                      height: 200,
                    ),
                  ),
                ],
              ),
            ),

            const SizedBox(height: 40),

            // 🔹 LAYANAN
            const Text("Layanan Kami",
                style: TextStyle(
                    fontSize: 22, fontWeight: FontWeight.bold, color: Colors.black)),
            const SizedBox(height: 20),
            Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                _buildServiceCard("Sedot WC", "Layanan Sedot WC-de"),
                const SizedBox(width: 20),
                _buildServiceCard("Pelancaran", "Pelancaran Tersumbat"),
              ],
            ),

            const SizedBox(height: 60),

            // 🔹 MENGAPA MEMILIH KAMI
            Container(
              padding: const EdgeInsets.all(40),
              color: const Color(0xFF3B3486),
              child: Column(
                children: [
                  const Text("Mengapa Harus Memilih Kami",
                      style: TextStyle(
                          fontSize: 22,
                          fontWeight: FontWeight.bold,
                          color: Colors.white)),
                  const SizedBox(height: 30),
                  Wrap(
                    spacing: 20,
                    runSpacing: 20,
                    children: List.generate(
                      6,
                      (index) => Container(
                        width: 150,
                        height: 100,
                        decoration: BoxDecoration(
                          color: Colors.grey[300],
                          borderRadius: BorderRadius.circular(12),
                        ),
                      ),
                    ),
                  )
                ],
              ),
            ),

            const SizedBox(height: 40),

            // 🔹 TESTIMONI
            const Text("Testimoni",
                style: TextStyle(
                    fontSize: 22, fontWeight: FontWeight.bold, color: Colors.black)),
            const SizedBox(height: 20),
            Wrap(
              spacing: 20,
              runSpacing: 20,
              children: List.generate(
                6,
                (index) => Container(
                  width: 150,
                  height: 100,
                  decoration: BoxDecoration(
                    color: Colors.grey[300],
                    borderRadius: BorderRadius.circular(12),
                  ),
                ),
              ),
            ),

            const SizedBox(height: 60),

            // 🔹 FOOTER
            Container(
              padding: const EdgeInsets.all(40),
              color: const Color(0xFF2E2575),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.spaceAround,
                children: [
                  Expanded(
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: const [
                        Text("Butuh Konsultasi..?",
                            style: TextStyle(
                                fontSize: 18,
                                fontWeight: FontWeight.bold,
                                color: Colors.white)),
                        SizedBox(height: 10),
                        Text("Silahkan kontak kami\nKami Siap Membantu",
                            style: TextStyle(color: Colors.white70)),
                        SizedBox(height: 20),
                        Text("📍 Jl. Imam Bonjol No.38, Kediri",
                            style: TextStyle(color: Colors.white)),
                        Text("📞 0821-4239-5050",
                            style: TextStyle(color: Colors.white)),
                        Text("✉️ abadiusaha@gmail.com",
                            style: TextStyle(color: Colors.white)),
                      ],
                    ),
                  ),
                  Expanded(
                    child: Image.network(
                      "https://cdn-icons-png.flaticon.com/512/2721/2721297.png",
                      height: 150,
                    ),
                  )
                ],
              ),
            ),

            Container(
              padding: const EdgeInsets.all(15),
              color: Colors.black,
              child: const Center(
                child: Text(
                  "Copyright ©2025 Abadi Usaha",
                  style: TextStyle(color: Colors.white70),
                ),
              ),
            )
          ],
        ),
      ),
    );
  }

  // widget helper navbar item
  Widget _buildNavItem(String text) {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 10),
      child: TextButton(
        onPressed: () {},
        child: Text(
          text,
          style: const TextStyle(color: Colors.white),
        ),
      ),
    );
  }

  // widget helper card layanan
  static Widget _buildServiceCard(String title, String desc) {
    return Container(
      width: 150,
      height: 120,
      decoration: BoxDecoration(
        color: Colors.grey[200],
        borderRadius: BorderRadius.circular(12),
      ),
      child: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            const Icon(Icons.build, size: 40, color: Colors.blue),
            const SizedBox(height: 10),
            Text(title,
                style: const TextStyle(
                    fontWeight: FontWeight.bold, color: Colors.black)),
            Text(desc, style: const TextStyle(fontSize: 12)),
          ],
        ),
      ),
    );
  }
}