<x-guest-layout>
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
        <!-- Logo Shopping Cart -->
        <div class="flex justify-center mb-4">
            <i class="fas fa-shopping-cart text-green-500 text-5xl"></i> <!-- Gantikan dengan ikon shopping-cart -->
        </div>
        <h2 class="text-center text-xl font-bold text-gray-700 mb-6">Register</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nama -->
            <div class="mb-4">
                <x-input-label for="nama" :value="__('Nama')" />
                <x-text-input id="nama" name="nama" type="text" class="block mt-1 w-full border-gray-300 focus:ring-green-500 focus:border-green-500" :value="old('nama')" required autofocus />
                <x-input-error :messages="$errors->get('nama')" class="mt-2" />
            </div>

            <!-- Role -->
            <div class="mb-4">
                <x-input-label for="role" :value="__('Role')" />
                <select id="role" name="role" class="block mt-1 w-full border-gray-300 focus:ring-green-500 focus:border-green-500 rounded-md shadow-sm" required>
                    <option value="" disabled selected>{{ __('Pilih Role') }}</option>
                    <option value="Owner">Owner</option>
                    <option value="Staff">Staff</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="block mt-1 w-full border-gray-300 focus:ring-green-500 focus:border-green-500" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4 relative">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" name="password" type="password" class="block mt-1 w-full border-gray-300 focus:ring-green-500 focus:border-green-500 pr-10" required />
                <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-black">
                    <i id="eyeIconPassword" class="fas fa-eye"></i>
                </button>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-4">
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="block mt-1 w-full border-gray-300 focus:ring-green-500 focus:border-green-500" required />
            </div>

            <!-- Tombol Register -->
            <x-primary-button class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 rounded flex justify-center items-center">
                {{ __('Register') }}
            </x-primary-button>

            <!-- Link Login -->
            <div class="text-center mt-4">
                <p class="text-sm text-gray-500">
                    {{ __('Sudah punya akun?') }}
                    <a href="{{ route('login') }}" class="text-green-600 hover:underline">{{ __('Masuk di sini') }}</a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>

<script>
    // Fungsi Toggle Password
    function togglePassword(id) {
        const passwordField = document.getElementById(id);
        const eyeIcon = document.getElementById('eyeIconPassword');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
