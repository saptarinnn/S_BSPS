<section>
    <header>
        <h5>
            {{ __('Perbarui Kata Sandi') }}
        </h5>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <x-app.form.content required type="password" label="Kata Sandi Saat Ini" name="current_password" />
        <x-app.form.content required type="password" label="Kata Sandi Baru" name="password" />
        <x-app.form.content required type="password" label="Konfirmasi Kata Sandi" name="password_confirmation" />

        <div class="flex items-center gap-4">
            <button type="submit" class="mb-1 btn btn-sm btn-primary">Simpan Data</button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
