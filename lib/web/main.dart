import 'package:flutter/material.dart';
import 'login.dart';
import 'index.dart';
import 'register.dart';
import 'admin/dashboard.dart';
import 'admin/pemesanan.dart';
import 'admin/kelola_layanan.dart';
import 'admin/kelola_petugas.dart';
import 'admin/kelola_gaji.dart';

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'Abadi Usaha',
      theme: ThemeData(primarySwatch: Colors.blue, fontFamily: 'Poppins'),
      initialRoute: '/login', // route awal
      routes: {
        '/login': (context) => LoginPage(),
        '/beranda': (context) => IndexPage(),
        '/register': (context) => RegisterPage(),
        '/dashboard': (context) => DashboardPage(),
        '/index/pemesanan': (context) => PemesananPage(),
        '/index/layanan': (context) => KelolaLayananPage(),
        '/index/petugas': (context) => KelolaPetugasPage(),
        '/index/gaji': (context) => KelolaGajiPage(),
      },
    );
  }
}
