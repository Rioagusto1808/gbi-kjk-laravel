<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Jadwal Ibadah Baru - GBI KJK</title>
</head>

<body style="font-family:Arial, sans-serif; background:#f9fafb; padding:24px;">
    <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" role="presentation"
                    style="background:#fff; border-radius:12px; overflow:hidden;">
                    <!-- Header -->
                    <tr>
                        <td style="background:#b91c1c; padding:18px; text-align:center;">
                            <img src="{{ $logo ?? asset('images/logo-gbi-email.png') }}" alt="GBI KJK" height="48"
                                style="display:block;margin:0 auto 6px;">
                            <div style="color:#fff; font-weight:700;">Gereja Bethel Indonesia KJK</div>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:24px; color:#374151;">
                            <h2 style="margin:0 0 12px;">Shalom Jemaat,</h2>
                            <p style="margin:0 0 16px;">Ada jadwal ibadah baru yang telah ditambahkan:</p>

                            <table width="100%" cellpadding="6" cellspacing="0"
                                style="margin-bottom:20px; border:1px solid #e5e7eb; border-radius:8px; font-size:14px;">
                                <tr>
                                    <td><strong>Jenis</strong></td>
                                    <td>{{ $ibadah->jenis }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tema</strong></td>
                                    <td>{{ $ibadah->tema ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Ayat</strong></td>
                                    <td>{{ $ibadah->ayat ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Gembala</strong></td>
                                    <td>{{ $ibadah->gembala ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Mulai</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($ibadah->tanggal_mulai)->format('d M Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Selesai</strong></td>
                                    <td>
                                        {{ $ibadah->tanggal_selesai ? \Carbon\Carbon::parse($ibadah->tanggal_selesai)->format('d M Y H:i') : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Lokasi</strong></td>
                                    <td>{{ $ibadah->lokasi ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status</strong></td>
                                    <td>{{ $ibadah->status }}</td>
                                </tr>
                            </table>

                            <p style="margin:0 0 24px;">Kami mengundang seluruh jemaat untuk hadir bersama-sama.</p>

                            <p style="margin:0 0 24px;">
                                <a href="{{ route('ibadah.show', $ibadah->id) }}"
                                    style="background:#b91c1c; color:#fff; text-decoration:none; padding:12px 20px; border-radius:8px; font-weight:700;">
                                    Lihat Detail Ibadah
                                </a>
                            </p>

                            <p style="margin:0 0 8px; font-size:13px; color:#6b7280;">Salam hormat,</p>
                            <p style="margin:0; font-weight:700;">GBI KJK</p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding:16px; background:#f3f4f6; text-align:center; font-size:12px; color:#6b7280;">
                            © {{ date('Y') }} GBI KJK • Jl. …, Lampung Utara •
                            <a href="mailto:rioagustor18@gmail.com"
                                style="color:#b91c1c; text-decoration:none;">rioagustor18@gmail.com</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
