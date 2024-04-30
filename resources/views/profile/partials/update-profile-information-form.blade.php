<section>
    <header>
        <h5>
            {{ __('Informasi Profil') }}
        </h5>

        <p class="text-black-50">
            {{ __('Perbarui informasi nama lengkap, username, dan nomor whatsapp anda.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <x-app.form.content required label="Nama Lengkap" name="nama" value="{{ old('nama', $user->nama) }}" />
        <x-app.form.content required label="Username" name="username" value="{{ old('username', $user->username) }}" />
        <x-app.form.content required label="Nomor Whatsapp" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" />

        <div class="flex items-center gap-4">
            <button type="submit" class="mb-1 btn btn-sm btn-primary">Simpan Data</button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
