<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Studio.mu</title>
    <style>
        body {
            background-color: #020617;
            color: #f8fafc;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: none;
            -ms-text-size-adjust: none;
        }
        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #020617;
            padding-bottom: 40px;
        }
        .main-table {
            max-width: 600px;
            width: 100%;
            margin: 0 auto;
            background-color: #0b0f19;
            border: 1px solid #1e293b;
            border-radius: 16px;
            overflow: hidden;
            margin-top: 40px;
        }
        .header {
            background: linear-gradient(135deg, #090d16 0%, #020617 100%);
            padding: 40px 20px;
            text-align: center;
            border-bottom: 1.5px solid #D4AF37;
        }
        .logo {
            font-size: 28px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: 2px;
            text-decoration: none;
            text-transform: uppercase;
        }
        .logo-span {
            color: #D4AF37;
        }
        .content {
            padding: 40px 30px;
            line-height: 1.7;
        }
        h1 {
            font-size: 22px;
            font-weight: 800;
            color: #ffffff;
            margin-top: 0;
            margin-bottom: 20px;
            letter-spacing: -0.5px;
        }
        p {
            font-size: 15px;
            color: #cbd5e1;
            margin-top: 0;
            margin-bottom: 20px;
        }
        .btn-container {
            text-align: center;
            margin: 35px 0;
        }
        .btn {
            background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
            color: #ffffff !important;
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
            padding: 14px 30px;
            border-radius: 10px;
            display: inline-block;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            box-shadow: 0 4px 12px rgba(180,83,9,0.25);
        }
        .features-table {
            width: 100%;
            margin-top: 30px;
            margin-bottom: 30px;
            border-collapse: collapse;
        }
        .feature-item {
            padding: 15px;
            background-color: #111827;
            border: 1px solid #1f2937;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .feature-title {
            color: #D4AF37;
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 5px;
        }
        .feature-desc {
            color: #9ca3af;
            font-size: 13px;
            margin: 0;
        }
        .footer {
            padding: 30px;
            background-color: #020617;
            text-align: center;
            border-top: 1px solid #1e293b;
        }
        .footer p {
            font-size: 11px;
            color: #64748b;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <table class="main-table" cellpadding="0" cellspacing="0">
            <tr>
                <td class="header">
                    <div class="logo">Studio<span class="logo-span">.mu</span></div>
                </td>
            </tr>
            <tr>
                <td class="content">
                    <h1>Halo, {{ $user->name }}!</h1>
                    <p>Selamat bergabung di keluarga besar <strong>Studio.mu Visual Art</strong>! Kami sangat senang bisa menjadi bagian dari perjalanan Anda untuk mengabadikan momen-momen berharga.</p>
                    
                    <p>Akun Anda telah berhasil terdaftar menggunakan email ini. Sekarang, Anda dapat menikmati berbagai layanan premium kami:</p>
                    
                    <div style="margin-top: 25px;">
                        <div class="feature-item">
                            <div class="feature-title">📅 Booking Cepat & Mudah</div>
                            <p class="feature-desc">Pesan sesi foto impian Anda kapan saja dan di mana saja langsung lewat dasbor customer.</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-title">🎁 Poin Loyalitas & Reward</div>
                            <p class="feature-desc">Kumpulkan poin dari setiap booking sesi foto dan tukarkan dengan diskon menarik atau voucher khusus.</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-title">📸 Fotografer Profesional</div>
                            <p class="feature-desc">Pilih fotografer terbaik yang siap membantu mengabadikan momen dengan kualitas visual tertinggi.</p>
                        </div>
                    </div>

                    <div class="btn-container">
                        <a href="{{ url('/menu-utama') }}" class="btn">Masuk Ke Dasbor</a>
                    </div>

                    <p>Jika Anda memiliki pertanyaan atau memerlukan bantuan, jangan ragu untuk menghubungi tim support kami dengan membalas email ini.</p>
                    <p style="margin-top: 40px; margin-bottom: 0;">Salam hangat,<br><strong style="color: #ffffff;">Studio.mu Visual Art Team</strong></p>
                </td>
            </tr>
            <tr>
                <td class="footer">
                    <p>&copy; {{ date('Y') }} Studio.mu. All rights reserved.</p>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
