import 'dart:convert';

import 'package:http/http.dart' as http;

class ApiClient {
  ApiClient({required this.baseUrl, http.Client? httpClient})
      : _httpClient = httpClient ?? http.Client();

  final String baseUrl;
  final http.Client _httpClient;

  Uri _uri(String path, [Map<String, String>? queryParameters]) {
    final normalizedBase = baseUrl.endsWith('/') ? baseUrl.substring(0, baseUrl.length - 1) : baseUrl;
    final normalizedPath = path.startsWith('/') ? path : '/$path';
    return Uri.parse('$normalizedBase$normalizedPath')
        .replace(queryParameters: queryParameters);
  }

  Future<Map<String, dynamic>> getJson(String path) async {
    final response = await _httpClient.get(
      _uri(path),
      headers: const {
        'Accept': 'application/json',
      },
    );

    if (response.statusCode < 200 || response.statusCode >= 300) {
      throw HttpException(response.statusCode, response.body);
    }

    final decoded = jsonDecode(response.body);
    if (decoded is Map<String, dynamic>) return decoded;
    throw const FormatException('Expected JSON object');
  }

  Future<List<dynamic>> getJsonList(String path) async {
    final response = await _httpClient.get(
      _uri(path),
      headers: const {
        'Accept': 'application/json',
      },
    );

    if (response.statusCode < 200 || response.statusCode >= 300) {
      throw HttpException(response.statusCode, response.body);
    }

    final decoded = jsonDecode(response.body);
    if (decoded is List) return decoded;
    throw const FormatException('Expected JSON array');
  }
}

class HttpException implements Exception {
  const HttpException(this.statusCode, this.body);

  final int statusCode;
  final String body;

  @override
  String toString() => 'HttpException($statusCode): $body';
}
