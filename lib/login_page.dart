import 'package:flutter/material.dart';
import 'dashboard_page.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

class LoginPage extends StatefulWidget {
  const LoginPage({super.key});

  @override
  State<LoginPage> createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  final TextEditingController _usernameController = TextEditingController();
  final TextEditingController _passwordController = TextEditingController();
  bool _isLoading = false;

  Future<void> login() async {
    final username = _usernameController.text.trim();
    final password = _passwordController.text.trim();

    // Validasi form kosong
    if (username.isEmpty || password.isEmpty) {
      showDialog(
        context: context,
        builder: (_) => AlertDialog(
          title: const Text("Form Kosong"),
          content: const Text("Username atau password wajib diisi."),
          actions: [
            TextButton(
              onPressed: () => Navigator.pop(context),
              child: const Text("OK"),
            ),
          ],
        ),
      );
      return;
    }

    setState(() => _isLoading = true);

    try {
      final url = Uri.parse("http://192.168.1.65:8000/api/loginHP");
      final response = await http.post(
        url,
        headers: {"Content-Type": "application/json"},
        body: jsonEncode({"username": username, "password": password}),
      );

      print("STATUS CODE: ${response.statusCode}");
      print("RESPONSE BODY:\n${response.body}");

      final data = jsonDecode(response.body);

      if (data["status"] == "success") {
        // Login berhasil → alert otomatis hilang setelah 2 detik
        showDialog(
          context: context,
          barrierDismissible: false, // tidak bisa klik luar untuk dismiss
          builder: (_) => const AlertDialog(
            title: Text("Login Berhasil"),
            content: Text("Anda akan masuk ke dalam aplikasi!"),
          ),
        );

        // Tunggu 2 detik lalu pindah ke DashboardPage
        Future.delayed(const Duration(seconds: 2), () {
          Navigator.pop(context); // tutup dialog
          Navigator.pushReplacement(
            context,
            MaterialPageRoute(
              builder: (_) => DashboardPage(
                username: data["username"],
                phone: data["phone"],
                job: data["job"],
                pekerjaId: data["id"],
              ),
            ),
          );
        });
      } else {
        showDialog(
          context: context,
          builder: (_) => AlertDialog(
            title: const Text("Login Gagal"),
            content: Text(data["message"] ?? "Username atau password salah"),
            actions: [
              TextButton(
                onPressed: () => Navigator.pop(context),
                child: const Text("OK"),
              ),
            ],
          ),
        );
      }
    } catch (e) {
      print("❌ ERROR SAAT KONEKSI: $e");
      showDialog(
        context: context,
        builder: (_) => const AlertDialog(
          title: Text("Kesalahan Koneksi"),
          content: Text("Tidak dapat terhubung ke server."),
        ),
      );
    } finally {
      setState(() => _isLoading = false);
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Stack(
        children: [
          // Background gradient
          Container(
            decoration: const BoxDecoration(
              gradient: LinearGradient(
                colors: [Color(0xFF3F3D9B), Color(0xFF6EA4DA)],
                begin: Alignment.topCenter,
                end: Alignment.bottomCenter,
              ),
            ),
          ),
          Center(
            child: SingleChildScrollView(
              padding: const EdgeInsets.symmetric(horizontal: 24),
              child: Container(
                padding: const EdgeInsets.symmetric(
                  horizontal: 24,
                  vertical: 40,
                ),
                decoration: BoxDecoration(
                  color: Colors.white,
                  borderRadius: BorderRadius.circular(20),
                  boxShadow: const [
                    BoxShadow(
                      color: Colors.black26,
                      blurRadius: 10,
                      offset: Offset(0, 5),
                    ),
                  ],
                ),
                child: Column(
                  mainAxisSize: MainAxisSize.min,
                  children: [
                    const Text(
                      "ABADI USAHA",
                      style: TextStyle(
                        color: Color(0xFF3F3D9B),
                        fontSize: 26,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                    const SizedBox(height: 30),

                    // Username
                    TextField(
                      controller: _usernameController,
                      decoration: InputDecoration(
                        prefixIcon: const Icon(Icons.person),
                        hintText: 'Username',
                        filled: true,
                        fillColor: Colors.grey[100],
                        border: OutlineInputBorder(
                          borderRadius: BorderRadius.circular(30),
                          borderSide: BorderSide.none,
                        ),
                        contentPadding: const EdgeInsets.symmetric(
                          vertical: 14,
                          horizontal: 20,
                        ),
                      ),
                    ),
                    const SizedBox(height: 20),

                    // Password
                    TextField(
                      controller: _passwordController,
                      obscureText: true,
                      decoration: InputDecoration(
                        prefixIcon: const Icon(Icons.lock),
                        hintText: 'Password',
                        filled: true,
                        fillColor: Colors.grey[100],
                        border: OutlineInputBorder(
                          borderRadius: BorderRadius.circular(30),
                          borderSide: BorderSide.none,
                        ),
                        contentPadding: const EdgeInsets.symmetric(
                          vertical: 14,
                          horizontal: 20,
                        ),
                      ),
                    ),
                    const SizedBox(height: 30),

                    // Tombol login
                    SizedBox(
                      width: double.infinity,
                      height: 50,
                      child: ElevatedButton(
                        onPressed: _isLoading ? null : login,
                        style: ElevatedButton.styleFrom(
                          backgroundColor: const Color(
                            0xFF3F3D9B,
                          ), // warna tombol
                          foregroundColor: Colors.white, // warna tulisan
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(30),
                          ),
                        ),
                        child: _isLoading
                            ? const CircularProgressIndicator(
                                color: Colors.white,
                              )
                            : const Text(
                                "MASUK",
                                style: TextStyle(
                                  fontSize: 16,
                                  fontWeight: FontWeight.bold,
                                ),
                              ),
                      ),
                    ),
                  ],
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }
}
