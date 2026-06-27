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

    <?php
        $logoPath = public_path('img/logo.png');
        if(file_exists($logoPath)) {
            $logoData = base64_encode(file_get_contents($logoPath));
            $logoSrc = 'data:image/png;base64,'.$logoData;
        } else {
            $logoSrc = '';
        }
    ?>

    <table width="100%" style="border-bottom: 2px solid #000; margin-bottom: 20px; padding-bottom: 10px;">
        <tr>
            <td width="100" style="vertical-align: middle;">
                <?php if($logoSrc): ?>
                    <img src="<?php echo e($logoSrc); ?>" alt="Studio.mu Logo" width="90">
                <?php endif; ?>
            </td>
            <td style="vertical-align: middle; text-align: left; padding-left: 10px;">
                <h1 style="margin: 0 0 5px 0; font-size: 18pt; text-transform: uppercase;">Laporan Hasil Transaksi Studio.mu</h1>
                <p style="margin: 0; font-size: 11pt; color: #555;">Dicetak pada: <?php echo e(\Carbon\Carbon::now()->format('d F Y, H:i')); ?></p>
            </td>
        </tr>
    </table>

    <div class="section-title">Ringkasan Eksekutif</div>
    <table class="summary-table">
        <tr>
            <td><strong>Filter Status</strong></td>
            <td>: <?php echo e($status ? $status : 'Semua Status'); ?></td>
        </tr>
        <tr>
            <td><strong>Filter Tanggal</strong></td>
            <td>: 
                <?php if($dateRange == 'today'): ?> Hari Ini
                <?php elseif($dateRange == 'this_week'): ?> Minggu Ini
                <?php elseif($dateRange == 'this_month'): ?> Bulan Ini
                <?php else: ?> Semua Waktu
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td><strong>Total Transaksi</strong></td>
            <td>: <?php echo e($totalBookings); ?> Sesi</td>
        </tr>
        <tr>
            <td><strong>Total Pendapatan (Omzet)</strong></td>
            <td>: Rp <?php echo e(number_format($totalRevenue, 0, ',', '.')); ?></td>
        </tr>
    </table>

    <?php if($pieChartBase64 || $barChartBase64): ?>
    <div class="charts-container">
        <?php if($pieChartBase64): ?>
        <div class="chart-box">
            <h3 style="font-size: 11pt; margin-bottom: 5px;">Distribusi Layanan</h3>
            <img src="<?php echo e($pieChartBase64); ?>" alt="Pie Chart Layanan">
        </div>
        <?php endif; ?>
        
        <?php if($barChartBase64): ?>
        <div class="chart-box">
            <h3 style="font-size: 11pt; margin-bottom: 5px;">Performa Fotografer</h3>
            <img src="<?php echo e($barChartBase64); ?>" alt="Bar Chart Fotografer">
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

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
            <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td align="center"><?php echo e($index + 1); ?></td>
                    <td>
                        <strong>BOOK-<?php echo e($booking->id); ?></strong><br>
                        <?php echo e($booking->booking_date->format('d/m/Y')); ?><br>
                        <?php echo e($booking->booking_date->format('H:i')); ?>

                    </td>
                    <td>
                        <?php echo e($booking->user->name ?? 'User Terhapus'); ?><br>
                        <em><?php echo e($booking->user->email ?? ''); ?></em>
                    </td>
                    <td>
                        <strong><?php echo e($booking->service_name); ?></strong><br>
                        Fotografer: <?php echo e($booking->photographer->name ?? 'Belum Ditugaskan'); ?>

                    </td>
                    <td><?php echo e($booking->status); ?></td>
                    <td align="right"><?php echo e(number_format($booking->amount, 0, ',', '.')); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" align="center">Tidak ada data transaksi pada periode ini.</td>
                </tr>
            <?php endif; ?>
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
            <?php $__empty_1 = true; $__currentLoopData = $photographerStats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td align="center"><?php echo e($index + 1); ?></td>
                    <td><?php echo e($stat['name']); ?></td>
                    <td align="center"><?php echo e($stat['count']); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="3" align="center">Belum ada data fotografer.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        <div class="signature-box">
            <p>Admin Studio.mu,</p>
            <strong>(<?php echo e(auth()->user()->name ?? 'Admin'); ?>)</strong>
        </div>
    </div>

</body>
</html>
<?php /**PATH C:\Users\asus\Documents\kuliah\smt 8\sistem informasi studio.mu\studio\resources\views/admin/bookings/report.blade.php ENDPATH**/ ?>