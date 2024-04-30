<x-guest-layout title="Verif Number Whatsapp">
    <div class="p-4">
        <div class="text-left">
            <h1 class="block text-2xl font-bold text-gray-800">Verifikasi Nomor Whatsapp</h1>
            <p class="mt-2 text-sm font-medium text-dark/70">
                Masukkan nomor otp yang telah dikirimkan ke nomor whatsapp yang telah di daftarkan.
            </p>
        </div>
        <div class="mt-7">
            <x-forms action="{{ route('verification.verify') }}" class="grid gap-y-4" method="POST">
                @csrf
                <x-forms.input name="otp" type="number" label="Nomor OTP" required autocomplete="off"
                    maxlength="3" />
                <!-- /Username -->

                <x-button>Submit OTP</x-button>
            </x-forms>
            <form action="{{ route('logout') }}" method="POST" class="mt-4 text-center">
                @csrf
                <button type="submit" class="text-sm fw-medium text-danger">Logout</button>
            </form>
            <!-- /Form -->
        </div>
    </div>
</x-guest-layout>
