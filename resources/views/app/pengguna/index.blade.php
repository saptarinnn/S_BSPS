<x-app-layout>
    <x-slot:title>{{ $page_meta['title'] }}</x-slot>
    <x-slot:main_title>{{ $page_meta['title'] }}</x-slot>

    <x-app.card>

        <x-slot name="header">
            <x-app.button type="create" href="{{ route('pengguna.create') }}" />
        </x-slot>


        <x-app.table>
            <x-slot name="thead">
                <tr>
                    <x-app.table.th>#</x-app.table.th>
                    <x-app.table.th>Nama</x-app.table.th>
                    <x-app.table.th>No. Whatsapp</x-app.table.th>
                    <x-app.table.th>Username</x-app.table.th>
                    <x-app.table.th>Role</x-app.table.th>
                    <x-app.table.th>Login Terakhir</x-app.table.th>
                    <x-app.table.th>Aktif</x-app.table.th>
                    <x-app.table.th>Aksi</x-app.table.th>
                </tr>
            </x-slot>
            <x-slot name="tbody">
                @foreach ($datas as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ ucwords($data->nama) }}</td>
                        <td>{{ $data->no_hp }}</td>
                        <td>{{ $data->username }}</td>
                        <td>{{ ucwords(str_replace(['["', '"]'], '', $data->getRoleNames())) }}</td>
                        <td>{{ $data->login_terakhir ? $data->getSomeDate($data->login_terakhir) : '-' }}</td>
                        <td>
                            @if ($data->aktif == 1)
                                <span class="badge bg-light-success">Aktif</span>
                            @else
                                <span class="badge bg-light-danger">Tidak Aktif</span>
                            @endif
                        </td>
                        <td>
                            <x-app.button type="edit" href="{{ route('pengguna.edit', $data->id) }}" />
                            @if (str_replace(['["', '"]'], '', $data->getRoleNames()) != 'superadmin')
                                <x-app.button type="delete" action="{{ route('pengguna.destroy', $data->id) }}" />
                            @endif
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-app.table>

    </x-app.card>

    <x-slot:script>
        <x-app.alert.confirm />

        @if (session('message'))
            <x-app.alert.success />
        @endif
    </x-slot>
</x-app-layout>
