{{-- resources/views/emails/auth/reset.blade.php --}}
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Reset Kata Sandi - GBI KJK</title>
</head>

<body style="font-family:Arial, sans-serif; background:#f9fafb; padding:24px;">
    <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" role="presentation"
                    style="background:#fff; border-radius:12px; overflow:hidden;">
                    <tr>
                        <td style="background:#b91c1c; padding:18px; text-align:center;">
                            <img src="{{ $logo ?? asset('images/logo-gbi-email.png') }}" alt="GBI KJK" height="48"
                                style="display:block;margin:0 auto 6px;">
                            <div style="color:#fff; font-weight:700;">Gereja Bethel Indonesia KJK</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:24px; color:#374151;">
                            <h2 style="margin:0 0 12px;">Shalom {{ $user->name ?? '' }},</h2>
                            <p style="margin:0 0 16px;">Kami menerima permintaan untuk mengatur ulang kata sandi akun
                                Anda.</p>
                            <p style="margin:0 0 24px;">
                                <a href="{{ $url }}"
                                    style="background:#b91c1c; color:#fff; text-decoration:none; padding:12px 20px; border-radius:8px; font-weight:700;">
                                    Reset Kata Sandi
                                </a>
                            </p>
                            <p style="margin:0 0 8px; font-size:13px; color:#6b7280;">Jika tombol di atas tidak
                                berfungsi, salin dan tempel URL ini:</p>
                            <p style="margin:0; font-size:12px; color:#6b7280; word-break:break-all;">
                                {{ $url }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:16px; background:#f3f4f6; text-align:center; font-size:12px; color:#6b7280;">
                            © {{ date('Y') }} GBI KJK • Jl. Jodipati No.03 Prokimal, Kotabumi, Lampung Utara,
                            Lampung. •
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
