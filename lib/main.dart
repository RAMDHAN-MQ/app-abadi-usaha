import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'mobile/main.dart' as android_main;
import 'web/main.dart' as web_main;

void main() {
  if (kIsWeb) {
    runApp(web_main.MyApp());
  } else {
    runApp(android_main.MyApp());
  }
}