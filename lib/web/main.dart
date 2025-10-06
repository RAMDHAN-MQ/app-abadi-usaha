import 'package:flutter/material.dart';
import 'login.dart';
import 'index.dart';
import 'register.dart';

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
      },
    );
  }
}
