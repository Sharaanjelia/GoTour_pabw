// This is a basic Flutter widget test.
//
// To perform an interaction with a widget in your test, use the WidgetTester
// utility in the flutter_test package. For example, you can send tap and scroll
// gestures. You can also use WidgetTester to find child widgets in the widget
// tree, read text, and verify that the values of widget properties are correct.

import 'package:flutter_test/flutter_test.dart';

import 'package:gotour_mobile/main.dart';

void main() {
  testWidgets('Renders API smoke test screen', (WidgetTester tester) async {
    await tester.pumpWidget(const MyApp());

    expect(find.text('GoTour Mobile'), findsOneWidget);
    expect(find.text('Test /api/packages'), findsOneWidget);
    expect(find.text('Tap the button to test the API.'), findsOneWidget);
  });
}
