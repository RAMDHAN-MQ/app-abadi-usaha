import 'package:flutter/material.dart';
import 'sidebar.dart';

class PemesananPage extends StatelessWidget {
  const PemesananPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Pemesanan"),
      ),
      drawer: AdminSidebar(
        onItemSelected: (item) {
          if (item == "dashboard") {
            Navigator.pushReplacementNamed(context, '/dashboard');
          } else if (item == "pemesanan") {
            Navigator.pushReplacementNamed(context, '/index/pemesanan');
          } else if (item == "kelola_layanan") {
            Navigator.pushReplacementNamed(context, '/index/layanan');
          } else if (item == "kelola_petugas") {
            Navigator.pushReplacementNamed(context, '/index/petugas');
          } else if (item == "kelola_gaji") {
            Navigator.pushReplacementNamed(context, '/index/gaji');
          } else if (item == "logout") {
            Navigator.pushReplacementNamed(context, '/login');
          }
        },
      ),
      body: Center(
        child: Text(
          "Isi halaman pemesanan",
          style: TextStyle(fontSize: 24),
        ),
      ),
    );
  }
}
