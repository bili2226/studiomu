<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Transaksi Studio.mu</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            font-size: 12pt;
            color: #000;
        }
        .header {
            display: table;
            width: 100%;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
        }
        .header-logo {
            display: table-cell;
            width: 80px;
            vertical-align: middle;
        }
        .header-logo img {
            width: 70px;
            height: auto;
        }
        .header-text {
            display: table-cell;
            vertical-align: middle;
            text-align: left;
            padding-left: 15px;
        }
        .header-text h1 {
            margin: 0 0 5px 0;
            font-size: 18pt;
            text-transform: uppercase;
        }
        .header-text p {
            margin: 0;
            font-size: 11pt;
            color: #555;
        }
        .charts-container {
            width: 100%;
            text-align: center;
            margin: 20px 0;
        }
        .chart-box {
            display: inline-block;
            width: 48%;
            text-align: center;
        }
        .chart-box img {
            max-width: 100%;
            height: auto;
        }
        .section-title {
            font-size: 14pt;
            font-weight: bold;
            margin-top: 25px;
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }
        .summary-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        .summary-table td {
            padding: 5px 0;
            font-size: 12pt;
        }
        .summary-table td strong {
            display: inline-block;
            width: 180px;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 10pt;
        }
        .data-table th, .data-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .data-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .footer {
            margin-top: 50px;
            text-align: right;
        }
        .signature-box {
            display: inline-block;
            text-align: center;
            width: 200px;
        }
        .signature-box p {
            margin: 0 0 70px 0;
        }
    </style>
</head>
<body>

    @php
        $logoPath = public_path('img/logo.png');
        if(file_exists($logoPath)) {
            $logoData = base64_encode(file_get_contents($logoPath));
            $logoSrc = 'data:image/png;base64,'.$logoData;
        } else {
            $logoSrc = '';
        }
    @endphp

    <table width="100%" style="border-bottom: 2px solid #000; margin-bottom: 20px; padding-bottom: 10px;">
        <tr>
            <td width="100" style="vertical-align: middle;">
                @if($logoSrc)
                    <img src="{{ $logoSrc }}" alt="Studio.mu Logo" width="90">
                @endif
            </td>
            <td style="vertical-align: middle; text-align: left; padding-left: 10px;">
                <h1 style="margin: 0 0 5px 0; font-size: 18pt; text-transform: uppercase;">Laporan Hasil Transaksi Studio.mu</h1>
                <p style="margin: 0; font-size: 11pt; color: #555;">Dicetak pada: {{ \Carbon\Carbon::now()->format('d F Y, H:i') }}</p>
            </td>
        </tr>
    </table>

    <div class="section-title">Ringkasan Eksekutif</div>
    <table class="summary-table">
        <tr>
            <td><strong>Filter Status</strong></td>
            <td>: {{ $status ? $status : 'Semua Status' }}</td>
        </tr>
        <tr>
            <td><strong>Filter Tanggal</strong></td>
            <td>: 
                @if($dateRange == 'today') Hari Ini
                @elseif($dateRange == 'this_week') Minggu Ini
                @elseif($dateRange == 'this_month') Bulan Ini
                @else Semua Waktu
                @endif
            </td>
        </tr>
        <tr>
            <td><strong>Total Transaksi</strong></td>
            <td>: {{ $totalBookings }} Sesi</td>
        </tr>
        <tr>
            <td><strong>Total Pendapatan (Omzet)</strong></td>
            <td>: Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td>
        </tr>
    </table>

    @if($pieChartBase64 || $barChartBase64)
    <div class="charts-container">
        @if($pieChartBase64)
        <div class="chart-box">
            <h3 style="font-size: 11pt; margin-bottom: 5px;">Distribusi Layanan</h3>
            <img src="{{ $pieChartBase64 }}" alt="Pie Chart Layanan">
        </div>
        @endif
        
        @if($barChartBase64)
        <div class="chart-box">
            <h3 style="font-size: 11pt; margin-bottom: 5px;">Performa Fotografer</h3>
            <img src="{{ $barChartBase64 }}" alt="Bar Chart Fotografer">
        </div>
        @endif
    </div>
    @endif

    <div class="section-title">Detail Transaksi</div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">ID & Tanggal</th>
                <th width="20%">Pelanggan</th>
                <th width="20%">Layanan & Fotografer</th>
                <th width="10%">Status</th>
                <th width="15%">Total (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $index => $booking)
                <tr>
                    <td align="center">{{ $index + 1 }}</td>
                    <td>
                        <strong>BOOK-{{ $booking->id }}</strong><br>
                        {{ $booking->booking_date->format('d/m/Y') }}<br>
                        {{ $booking->booking_date->format('H:i') }}
                    </td>
                    <td>
                        {{ $booking->user->name ?? 'User Terhapus' }}<br>
                        <em>{{ $booking->user->email ?? '' }}</em>
                    </td>
                    <td>
                        <strong>{{ $booking->service_name }}</strong><br>
                        Fotografer: {{ $booking->photographer->name ?? 'Belum Ditugaskan' }}
                    </td>
                    <td>{{ $booking->status }}</td>
                    <td align="right">{{ number_format($booking->amount, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" align="center">Tidak ada data transaksi pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="section-title">Performa Fotografer</div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="50%">Nama Fotografer</th>
                <th width="20%">Total Sesi Dihandle</th>
            </tr>
        </thead>
        <tbody>
            @forelse($photographerStats as $index => $stat)
                <tr>
                    <td align="center">{{ $index + 1 }}</td>
                    <td>{{ $stat['name'] }}</td>
                    <td align="center">{{ $stat['count'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" align="center">Belum ada data fotografer.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <div class="signature-box">
            <p>Admin Studio.mu,</p>
            <strong>({{ auth()->user()->name ?? 'Admin' }})</strong>
        </div>
    </div>

</body>
</html>
