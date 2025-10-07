import 'package:flutter/material.dart';

class AdminSidebar extends StatelessWidget {
  final Function(String) onItemSelected;

  const AdminSidebar({super.key, required this.onItemSelected});

  @override
  Widget build(BuildContext context) {
    return Drawer(
      child: Column(
        children: [
          DrawerHeader(
            padding: EdgeInsets.all(16),
            margin: EdgeInsets.zero,
            decoration: BoxDecoration(
              color: Color(0xFF3F3D9D),
            ),
            child: Align(
              alignment: Alignment.bottomLeft,
              child: Text(
                "ABADI USAHA",
                style: TextStyle(
                  fontSize: 24,
                  fontWeight: FontWeight.bold,
                  color: Color(0xFFFFFFFF),
                ),
              ),
            ),
          ),

          ListTile(
            leading: Icon(Icons.dashboard),
            title: Text("Beranda"),
            onTap: () => onItemSelected("dashboard"),
          ),
          ListTile(
            leading: Icon(Icons.shopping_cart),
            title: Text("Pemesanan"),
            onTap: () => onItemSelected("pemesanan"),
          ),
          ListTile(
            leading: Icon(Icons.settings),
            title: Text("Kelola Layanan"),
            onTap: () => onItemSelected("kelola_layanan"),
          ),
          ListTile(
            leading: Icon(Icons.person),
            title: Text("Kelola Petugas"),
            onTap: () => onItemSelected("kelola_petugas"),
          ),
          ListTile(
            leading: Icon(Icons.monetization_on),
            title: Text("Kelola Gaji"),
            onTap: () => onItemSelected("kelola_gaji"),
          ),
          ListTile(
            leading: Icon(Icons.logout),
            title: Text("Keluar"),
            onTap: () => onItemSelected("logout"),
          ),
        ],
      ),
    );
  }
}
