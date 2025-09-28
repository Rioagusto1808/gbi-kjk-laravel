<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-screen w-screen flex items-center justify-center bg-cover bg-center"
    style="background-image: url('{{ asset('images/bg-gbi.jpg') }}');">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/40"></div>

    <div class="relative z-10 flex w-11/12 md:w-4/5 lg:w-3/4 xl:w-2/3 rounded-2xl overflow-hidden shadow-2xl">

        <!-- Left Section -->
        <div
            class="hidden md:flex w-1/2 bg-black/40 text-white flex-col justify-center items-center px-10 py-12 text-center">
            <a href="{{ route('home') }}">
                <x-application-logo class="w-24 h-24 mb-6 fill-current text-white" />
            </a>
            <h1 class="text-4xl font-bold mb-4">GBI KJK</h1>
            <p class="mb-6 text-lg">GBI KJK</p>
            <p class="text-sm opacity-80">
                Terima kasih sudah mendaftar! Silakan verifikasi alamat email Anda untuk mulai menggunakan aplikasi.
            </p>
        </div>

        <!-- Right Section (Verify Email) -->
        <div class="w-full md:w-1/2 bg-white/90 backdrop-blur-lg p-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Verifikasi Email</h2>

            <div class="mb-4 text-sm text-gray-600">
                Kami telah mengirimkan link verifikasi ke email Anda.
                Jika tidak menerima email, Anda bisa meminta link baru di bawah ini.
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600">
                    Link verifikasi baru sudah dikirim ke alamat email Anda.
                </div>
            @endif

            <div class="mt-4 flex items-center justify-between">
                <!-- Resend -->
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit"
                        class="bg-red-700 text-white py-2 px-4 rounded-lg hover:bg-red-800 transition">
                        Kirim Ulang Email Verifikasi
                    </button>
                </form>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-red-700 hover:underline">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
