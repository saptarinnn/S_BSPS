<x-guest-layout title="Register">
    <div class="p-4">
        <div class="text-left">
            <h1 class="block text-2xl font-bold text-gray-800">Register</h1>
            <p class="mt-1 text-sm text-gray-500">
                Silahkan masuk jika Anda sudah membuat akun.
            </p>
        </div>
        <div class="mt-7">
            <x-forms action="{{ route('register') }}" class="grid gap-y-4">
                <x-forms.input name="nama" label="Nama" required placeholder="Jhon Doe" />
                <!-- /Nama -->
                <x-forms.input name="no_hp" label="Nomor Whatsapp" type="number" maxlength="15" required
                    placeholder="081234567890" />
                <!-- /Nomor Whatsapp -->
                <x-forms.input name="username" label="Username" required placeholder="jhondoe" />
                <!-- /Username -->
                <x-forms.input name="password" label="Password" required type="password" />
                <!-- /Password -->
                <x-forms.input name="password_confirmation" label="Konfirmasi Password" required type="password" />
                <!-- /Konfirmasi Password -->
                <div class="flex items-center">
                    <div class="flex items-center">
                        <div class="flex">
                            <input id="agree" name="agree" type="checkbox"
                                class="border-gray-300 rounded text-primary focus:ring-primary" required>
                        </div>
                        <div class="ms-3">
                            <label for="agree" class="text-xs font-medium text-gray-500">Saya setuju dengan
                                Ketentuan Layanan dan
                                Kebijakan Privasi</label>
                        </div>
                    </div>
                    <!-- /Checkbox -->

                </div>
                <!-- /Konfirmasi -->
                <x-button>Register</x-button>
                <p class="mt-2 text-sm text-center text-gray-500">
                    Sudah punya akun? <a href="{{ route('login') }}" class="text-primary">Masuk disini.</a>
                </p>
            </x-forms>
            <!-- End Form -->
        </div>
    </div>
</x-guest-layout>
