<x-app-layout>
    <x-slot:title>{{ $page_meta['title'] }}</x-slot>
    <x-slot:main_title>{{ $page_meta['title'] }}</x-slot>

    <x-app.card>
        <x-app.form url="{{ $page_meta['url'] }}" method="{{ $page_meta['method'] }}" back="{{ $page_meta['back'] }}">
            <x-app.form.content label="Nama Pengguna" name="nama" value="{{ old('nama', $data->nama) }}" />
            <x-app.form.content label="Nomor Whatsapp" name="no_hp" type="number"
                value="{{ old('no_hp', $data->no_hp) }}" />
            <x-app.form.content label="Username" name="username" value="{{ old('username', $data->username) }}" />
            @if ($page_meta['method'] == 'post')
                <x-app.form.content label="Password" name="password" type="password"
                    value="{{ old('password', $data->password) }}" />
            @endif
            <x-app.form.content content="select" label="Pengguna Aktif" name="aktif" required>
                <option value="1" {{ $data->aktif == 1 ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ $data->aktif == 0 ? 'selected' : '' }}>Tidak Aktif</option>
            </x-app.form.content>
            <x-app.form.content content="select" label="Role Pengguna" name="role" required>
                <option value="">Pilih role pengguna</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}"
                        @if ($page_meta['method'] == 'put') {{ $role->name == $data->getRoleNames()[0] ? 'selected' : '' }} @endif>
                        {{ ucwords($role->name) }}
                    </option>
                @endforeach
            </x-app.form.content>

            @if ($page_meta['method'] == 'put')
                <x-app.form.content label="" name="password" type="hidden"
                    value="{{ old('password', $data->password) }}" />
            @endif
        </x-app.form>
    </x-app.card>

</x-app-layout>
