<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>

<body class="h-screen w-screen flex items-center justify-center bg-cover bg-center"
    style="background-image: url('{{ asset('images/bg-gbi.jpg') }}');">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/40"></div>

    <div class="relative z-10 flex w-11/12 md:w-4/5 lg:w-3/4 xl:w-2/3 rounded-2xl overflow-hidden shadow-2xl">

        <!-- Left Section -->
        <div class="hidden md:flex w-1/2 bg-black/40 text-white flex-col justify-center items-center px-10 text-center">
            <!-- Logo -->
            <a href="{{ route('home') }}">
                <x-application-logo class="w-24 h-24 mb-6 fill-current text-white" />
            </a>
            <!-- Judul -->
            <h1 class="text-4xl font-bold mb-4">GBI KJK</h1>
            <p class="text-sm opacity-80">
                Silakan masuk untuk mengakses informasi, jadwal ibadah, dan pengumuman terbaru (ANN).
            </p>
        </div>

        <!-- Right Section (Login Form) -->
        <div class="w-full md:w-1/2 bg-white/90 backdrop-blur-lg p-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Masuk</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        placeholder="Masukkan Email Anda"
                        class="mt-1 block w-full px-3 py-2 border rounded-lg shadow-sm focus:ring-red-700 focus:border-red-700">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4 relative">
                    <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                    <input id="password" type="password" name="password" required placeholder="Masukkan Password Anda"
                        class="mt-1 block w-full px-3 py-2 border rounded-lg shadow-sm focus:ring-red-700 focus:border-red-700 pr-10">
                    <!-- Toggle show/hide -->
                    <button type="button" onclick="togglePassword()"
                        class="absolute inset-y-0 right-3 top-7 flex items-center text-gray-500 hover:text-gray-700">
                        <i id="toggleIcon" class="bi bi-eye"></i>
                    </button>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember & Forgot -->
                <div class="flex items-center justify-between mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember"
                            class="rounded border-gray-300 text-red-700 shadow-sm focus:ring-red-700">
                        <span class="ml-2 text-sm text-gray-600">Ingat Saya</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-red-700 hover:underline">
                            Lupa kata sandi?
                        </a>
                    @endif
                </div>

                <!-- Tombol Masuk -->
                <button type="submit"
                    class="w-full bg-red-700 text-white py-2 px-4 rounded-lg hover:bg-red-800 transition">
                    Masuk
                </button>

                <!-- Buat Akun Baru -->
                <p class="mt-6 text-sm text-center text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-red-700 hover:underline">Buat Akun Baru</a>
                </p>
            </form>
        </div>
    </div>

    <!-- Script Toggle Password -->
    <script>
        function togglePassword() {
            const pass = document.getElementById("password");
            const icon = document.getElementById("toggleIcon");
            if (pass.type === "password") {
                pass.type = "text";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            } else {
                pass.type = "password";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            }
        }
    </script>
</body>

</html>
