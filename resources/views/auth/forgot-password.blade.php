<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-screen w-screen flex items-center justify-center bg-cover bg-center"
    style="background-image: url('{{ asset('images/bg-gbi.jpg') }}');">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/40"></div>

    <div class="relative z-10 flex w-11/12 md:w-4/5 lg:w-3/4 xl:w-2/3 rounded-2xl overflow-hidden shadow-2xl">

        <!-- Left Section -->
        <div class="hidden md:flex w-1/2 bg-black/40 text-white flex-col justify-center items-center px-10 text-center">
            <a href="{{ route('home') }}">
                <x-application-logo class="w-24 h-24 mb-6 fill-current text-white" />
            </a>
            <h1 class="text-4xl font-bold mb-4">GBI KJK</h1>
            <p class="mb-6 text-lg">GBI KJK</p>
            <p class="text-sm opacity-80">
                Atur ulang kata sandi akun Anda untuk dapat kembali mengakses informasi, jadwal ibadah, dan pengumuman
                terbaru (ANN).
            </p>
        </div>

        <!-- Right Section (Forgot Password Form) -->
        <div class="w-full md:w-1/2 bg-white/90 backdrop-blur-lg p-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Lupa Kata Sandi</h2>

            <p class="mb-4 text-sm text-gray-600">
                Tidak masalah. Masukkan alamat email Anda, lalu kami akan mengirimkan link untuk mereset kata sandi.
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="mt-1 block w-full px-3 py-2 border rounded-lg shadow-sm focus:ring-red-700 focus:border-red-700">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Tombol -->
                <button type="submit"
                    class="w-full bg-red-700 text-white py-2 px-4 rounded-lg hover:bg-red-800 transition">
                    Kirim Link Reset Password
                </button>

                <!-- Kembali ke Login -->
                <p class="mt-6 text-sm text-center text-gray-600">
                    Ingat kata sandi Anda?
                    <a href="{{ route('login') }}" class="text-red-700 hover:underline">Masuk di sini</a>
                </p>
            </form>
        </div>
    </div>
</body>

</html>
