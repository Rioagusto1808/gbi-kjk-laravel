<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">

    <style>
        body {
            background-color: #f9fafb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #374151;
            margin: 0;
            padding: 0;
        }

        .wrapper {
            width: 100%;
            background-color: #f9fafb;
            padding: 20px 0;
        }

        .content {
            width: 100%;
        }

        .inner-body {
            background-color: #ffffff;
            border-radius: 12px;
            margin: 0 auto;
            padding: 30px;
            width: 570px;
        }

        .header {
            background-color: #b91c1c;
            padding: 20px;
            text-align: center;
            border-radius: 12px 12px 0 0;
        }

        .header img {
            height: 60px;
            margin-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
            color: #fff;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #6b7280;
        }

        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #b91c1c;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
                padding: 20px !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
                text-align: center;
            }
        }
    </style>
    {!! $head ?? '' !!}
</head>

<body>
    <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">

                    <!-- Header -->
                    <tr>
                        <td class="header">
                            <a href="{{ config('app.url') }}" style="display:inline-block;">
                                <img src="{{ asset('images/logo-gbi.jpg') }}" alt="GBI KJK">
                            </a>
                            <h1>GBI KJK</h1>
                        </td>
                    </tr>

                    <!-- Email Body -->
                    <tr>
                        <td class="body" width="100%" cellpadding="0" cellspacing="0"
                            style="border: hidden !important;">
                            <table class="inner-body" align="center" cellpadding="0" cellspacing="0"
                                role="presentation">
                                <tr>
                                    <td class="content-cell">
                                        {!! Illuminate\Mail\Markdown::parse($slot) !!}
                                        {!! $subcopy ?? '' !!}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td class="footer">
                            <p>© {{ date('Y') }} GBI KJK. Semua hak dilindungi.</p>
                            <p>Jl. Raya [alamat lengkap gereja], Lampung Utara</p>
                            <p>Hubungi kami: <a href="mailto:rioagustor18@gmail.com"
                                    style="color:#b91c1c; text-decoration:none;">rioagustor18@gmail.com</a></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
