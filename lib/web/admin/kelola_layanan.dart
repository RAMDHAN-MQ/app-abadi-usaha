import 'package:flutter/material.dart';
import 'sidebar.dart';

class KelolaLayananPage extends StatelessWidget {
  const KelolaLayananPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: Text("Kelola Layanan")),
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
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.center,
          children: [
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceEvenly,
              children: [
                ElevatedButton.icon(
                  onPressed: () {
                  },
                  icon: Icon(Icons.add),
                  label: Text('Tambah'),
                ),

                SizedBox(
                  width: 250,
                  child: TextField(
                    decoration: InputDecoration(
                      labelText: 'Cari...',
                      prefixIcon: Icon(Icons.search),
                      border: OutlineInputBorder(),
                    ),
                    onChanged: (value) {
                    },
                  ),
                ),
              ],
            ),

            const SizedBox(
              height: 16,
            ), 
            SingleChildScrollView(
              scrollDirection: Axis
                  .horizontal,
              child: DataTable(
                columns: const <DataColumn>[
                  DataColumn(
                    label: Text(
                      'ID Layanan',
                      style: TextStyle(
                        fontStyle: FontStyle.italic,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                  ),
                  DataColumn(
                    label: Text(
                      'Nama Layanan',
                      style: TextStyle(
                        fontStyle: FontStyle.italic,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                  ),
                  DataColumn(
                    label: Text(
                      'Deskripsi',
                      style: TextStyle(
                        fontStyle: FontStyle.italic,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                  ),
                  DataColumn(
                    label: Text(
                      'Harga',
                      style: TextStyle(
                        fontStyle: FontStyle.italic,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                  ),
                  DataColumn(
                    label: Text(
                      'Aksi',
                      style: TextStyle(
                        fontStyle: FontStyle.italic,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                  ),
                ],
                rows: const <DataRow>[
                  DataRow(
                    cells: <DataCell>[
                      DataCell(Text('1')),
                      DataCell(Text('Sedot WC')),
                      DataCell(Text('Layanan sedot WC lengkap')),
                      DataCell(Text('Rp150.000,-')),
                      DataCell(
                        Row(
                          children: [
                            IconButton(icon: Icon(Icons.edit), onPressed: null),
                            IconButton(
                              icon: Icon(Icons.delete),
                              onPressed: null,
                            ),
                          ],
                        ),
                      ),
                    ],
                  ),
                  DataRow(
                    cells: <DataCell>[
                      DataCell(Text('2')),
                      DataCell(Text('Pelancaran')),
                      DataCell(Text('Layanan pelancaran saluran air')),
                      DataCell(Text('Rp300.000,-')),
                      DataCell(
                        Row(
                          children: [
                            IconButton(icon: Icon(Icons.edit), onPressed: null),
                            IconButton(
                              icon: Icon(Icons.delete),
                              onPressed: null,
                            ),
                          ],
                        ),
                      ),
                    ],
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}
