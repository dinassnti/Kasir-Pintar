<x-guest-layout>
    <!-- Card Login -->
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8" role="dialog" aria-labelledby="login-title">
        <div class="flex justify-center mb-6">
            <!-- Logo Shopping Cart -->
            <i class="fas fa-shopping-cart text-green-500 text-4xl"></i> <!-- Gantikan dengan ikon shopping-cart -->
        </div>
        <h2 id="login-title" class="text-center text-xl font-bold text-gray-700 mb-6">Login</h2>
        <p class="text-center text-sm text-gray-500 mb-6">
            Kamu dapat masuk sebagai <b>Owner</b> ataupun <b>Staff</b>
        </p>

        <!-- Form Login -->
        <form method="POST" action="{{ route('login') }}" onsubmit="return validateForm()">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:ring-green-500 focus:border-green-500" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4 relative">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full border-gray-300 focus:ring-green-500 focus:border-green-500 pr-10" type="password" name="password" required />
                <!-- Eye Icon -->
                <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-black focus:outline-none">
                    <i id="eyeIcon" class="fas fa-eye" aria-hidden="true"></i>
                </button>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Lupa Password -->
            <div class="flex justify-between items-center mb-6">
                <button type="button" class="text-sm text-green-600 hover:underline" onclick="showRoleModal()">Lupa Password?</button>
            </div>

            <!-- Tombol Login -->
            <x-primary-button class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 rounded flex justify-center items-center">
                {{ __('Login') }}
            </x-primary-button>

            <!-- Link Daftar -->
            <div class="text-center mt-4">
                <p class="text-sm text-gray-500">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-green-600 hover:underline">Daftar disini</a>
                </p>
            </div>
        </form>
    </div>

    <!-- Modal Pilih Role -->
    <div id="roleModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center z-50" role="dialog" aria-labelledby="role-modal-title">
        <div class="bg-white rounded-lg shadow-lg p-6 w-96">
            <h3 id="role-modal-title" class="text-lg font-bold text-gray-700 mb-4 text-center">Kamu mau masuk sebagai siapa?</h3>
            <ul class="space-y-4">
                <!-- Pilih Owner -->
                <li>
                    <a href="{{ route('password.request', ['role' => 'Owner']) }}" class="block text-center bg-gray-200 text-black py-2 rounded hover:bg-gray-300">
                        Owner
                    </a>
                </li>
                <!-- Pilih Staff -->
                <li>
                    <button type="button" onclick="showStaffMessage()" class="w-full text-center bg-gray-200 text-black py-2 rounded hover:bg-gray-300">
                        Staff
                    </button>
                </li>
            </ul>
            <button onclick="closeRoleModal()" class="mt-4 w-full text-center bg-gray-300 text-gray-700 py-2 rounded hover:bg-gray-400">
                Tutup
            </button>
        </div>
    </div>

    <!-- Pesan untuk Staff -->
    <div id="staffMessageModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center z-50" role="dialog" aria-labelledby="staff-modal-title">
        <div class="bg-white rounded-lg shadow-lg p-6 w-96">
            <h3 id="staff-modal-title" class="text-lg font-bold text-yellow-600 mb-4">Informasi</h3>
            <p class="text-sm text-gray-700 mb-6">
                Password Staff hanya bisa diubah oleh Owner. Hubungi Owner untuk merubah password.
            </p>
            <button onclick="closeStaffMessageModal()" class="mt-4 w-full text-center bg-gray-300 text-gray-700 py-2 rounded hover:bg-gray-400">Tutup</button>
        </div>
    </div>

    <script>
        function validateForm() {
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            if (!email || !password) {
                alert('Email dan Password harus diisi!');
                return false;
            }
            return true;
        }

        function showRoleModal() {
            document.getElementById('roleModal').classList.remove('hidden');
        }

        function closeRoleModal() {
            document.getElementById('roleModal').classList.add('hidden');
        }

        function showStaffMessage() {
            closeRoleModal();
            document.getElementById('staffMessageModal').classList.remove('hidden');
        }

        function closeStaffMessageModal() {
            document.getElementById('staffMessageModal').classList.add('hidden');
        }

        function togglePassword() {
            var passwordInput = document.getElementById('password');
            var eyeIcon = document.getElementById('eyeIcon');
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</x-guest-layout>
