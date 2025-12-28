<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>E-Tiket - {{ $payment->package->title ?? 'Paket Wisata' }}</title>
    <style>
        body { font-family: Arial, sans-serif; color: #222; }
        .header { text-align: center; margin-bottom: 24px; }
        .title { font-size: 1.5rem; font-weight: bold; }
        .info-table { width: 100%; margin-bottom: 18px; }
        .info-table td { padding: 4px 8px; }
        .itinerary { background: #f8fafc; border-radius: 8px; padding: 12px; margin-top: 12px; }
        .footer { margin-top: 32px; font-size: 0.95rem; color: #666; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">E-Tiket Perjalanan</div>
        <div>GoTour - {{ config('app.url') }}</div>
    </div>
    <table class="info-table">
        <tr>
            <td><b>Nama Peserta</b></td>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <td><b>Paket</b></td>
            <td>{{ $payment->package->title ?? '-' }}</td>
        </tr>
        <tr>
            <td><b>Tanggal Berangkat</b></td>
            <td>{{ $payment->travel_date ? $payment->travel_date->format('d M Y') : '-' }}</td>
        </tr>
        <tr>
            <td><b>Jumlah Peserta</b></td>
            <td>{{ $payment->participants }} orang</td>
        </tr>
        <tr>
            <td><b>Total Pembayaran</b></td>
            <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td><b>ID Transaksi</b></td>
            <td>{{ $payment->transaction_id }}</td>
        </tr>
        <tr>
            <td><b>Durasi</b></td>
            <td>{{ $payment->package->duration ?? '-' }}</td>
        </tr>
    </table>
    <div class="itinerary">
        <b>Itinerary Perjalanan:</b><br>
        @php
            $itinerary = $payment->package->itinerary ?? '-';
            if (is_array($itinerary)) {
                $itinerary = implode("\n", $itinerary);
            }
        @endphp
        <pre style="font-family:inherit; margin:0;">{{ $itinerary }}</pre>
    </div>
    <div class="footer">
        E-Tiket ini sah tanpa tanda tangan. Tunjukkan file PDF ini saat keberangkatan.<br>
        &copy; {{ date('Y') }} GoTour
    </div>
</body>
</html>
