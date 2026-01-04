import 'package:flutter/material.dart';

import 'app_config.dart';
import 'api/api_client.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'GoTour Mobile',
      theme: ThemeData(
        colorScheme: ColorScheme.fromSeed(seedColor: Colors.blue),
        useMaterial3: true,
      ),
      home: const ApiSmokeTestPage(),
    );
  }
}

class ApiSmokeTestPage extends StatefulWidget {
  const ApiSmokeTestPage({super.key});

  @override
  State<ApiSmokeTestPage> createState() => _ApiSmokeTestPageState();
}

class _ApiSmokeTestPageState extends State<ApiSmokeTestPage> {
  late final ApiClient _api;
  Future<String>? _future;

  @override
  void initState() {
    super.initState();
    _api = ApiClient(baseUrl: AppConfig.apiBaseUrl);
  }

  void _ping() {
    setState(() {
      // Example endpoint from your Flutter errors earlier.
      _future = _api.getJson('/api/packages').then((json) => json.toString());
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('GoTour Mobile'),
      ),
      body: Padding(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.stretch,
          children: [
            Text('API Base URL: ${AppConfig.apiBaseUrl}'),
            const SizedBox(height: 12),
            FilledButton(
              onPressed: _ping,
              child: const Text('Test /api/packages'),
            ),
            const SizedBox(height: 12),
            Expanded(
              child: DecoratedBox(
                decoration: BoxDecoration(
                  border: Border.all(color: Theme.of(context).dividerColor),
                  borderRadius: BorderRadius.circular(8),
                ),
                child: Padding(
                  padding: const EdgeInsets.all(12),
                  child: _future == null
                      ? const Text('Tap the button to test the API.')
                      : FutureBuilder<String>(
                          future: _future,
                          builder: (context, snapshot) {
                            if (snapshot.connectionState ==
                                ConnectionState.waiting) {
                              return const Text('Loading...');
                            }
                            if (snapshot.hasError) {
                              return Text('Error: ${snapshot.error}');
                            }
                            return SingleChildScrollView(
                              child: Text(snapshot.data ?? ''),
                            );
                          },
                        ),
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}
