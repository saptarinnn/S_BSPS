<x-guest-layout title="Log in">
    <div class="p-4">
        <div class="text-left">
            <h1 class="block text-2xl font-bold text-gray-800">Log in</h1>
            <p class="mt-2 text-sm font-medium text-dark/70">
                Selamat datang kembali, masukkan kredensial Anda untuk melanjutkan.
            </p>
        </div>
        <div class="mt-7">
            <x-forms action="{{ route('login') }}" class="grid gap-y-4">
                <x-forms.input name="username" label="Username" required autocomplete="off" />
                <!-- /Username -->
                <x-forms.input name="password" type="password" label="Password" required />
                <!-- /Password -->
                <div class="flex items-center">
                    <div class="flex items-center">
                        <div class="flex">
                            <input id="remember-me" name="remember-me" type="checkbox"
                                class="border-gray-300 rounded text-primary focus:ring-primary">
                        </div>
                        <div class="ms-3">
                            <label for="remember-me" class="text-sm font-medium text-dark/70">Ingat saja saya</label>
                        </div>
                    </div>
                    <!-- /Checkbox -->

                </div>
                <x-button>Log in</x-button>
                <p class="p-0 mt-2 mb-0 text-sm font-medium text-center text-dark/70">
                    Belum punya akun? <a href="{{ route('register') }}" class="text-primary">Daftar disini.</a>
                </p>
            </x-forms>
            <!-- /Form -->
        </div>
    </div>
</x-guest-layout>
