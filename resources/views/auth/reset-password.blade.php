<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
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
                Masukkan kata sandi baru untuk mengatur ulang akun Anda.
            </p>
        </div>

        <!-- Right Section (Reset Password Form) -->
        <div class="w-full md:w-1/2 bg-white/90 backdrop-blur-lg p-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Reset Kata Sandi</h2>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}"
                        required autofocus
                        class="mt-1 block w-full px-3 py-2 border rounded-lg shadow-sm focus:ring-red-700 focus:border-red-700">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4 relative">
                    <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi Baru</label>
                    <input id="password" type="password" name="password" required
                        class="mt-1 block w-full px-3 py-2 border rounded-lg shadow-sm focus:ring-red-700 focus:border-red-700 pr-10">
                    <button type="button" onclick="togglePassword('password','toggleIcon1')"
                        class="absolute inset-y-0 right-3 top-7 flex items-center text-gray-500 hover:text-gray-700">
                        <i id="toggleIcon1" class="bi bi-eye"></i>
                    </button>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Konfirmasi Password -->
                <div class="mb-4 relative">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Kata
                        Sandi</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="mt-1 block w-full px-3 py-2 border rounded-lg shadow-sm focus:ring-red-700 focus:border-red-700 pr-10">
                    <button type="button" onclick="togglePassword('password_confirmation','toggleIcon2')"
                        class="absolute inset-y-0 right-3 top-7 flex items-center text-gray-500 hover:text-gray-700">
                        <i id="toggleIcon2" class="bi bi-eye"></i>
                    </button>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Tombol -->
                <button type="submit"
                    class="w-full bg-red-700 text-white py-2 px-4 rounded-lg hover:bg-red-800 transition">
                    Reset Kata Sandi
                </button>

                <!-- Link kembali -->
                <p class="mt-6 text-sm text-center text-gray-600">
                    <a href="{{ route('login') }}" class="text-red-700 hover:underline">Kembali ke Login</a>
                </p>
            </form>
        </div>
    </div>

    <!-- Script Toggle Password -->
    <script>
        function togglePassword(fieldId, iconId) {
            const input = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            }
        }
    </script>
</body>

</html>
