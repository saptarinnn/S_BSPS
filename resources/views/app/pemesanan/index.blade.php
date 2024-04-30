<x-app-layout>
    <x-slot:title>{{ $page_meta['title'] }}</x-slot>
    <x-slot:main_title>{{ $page_meta['title'] }}</x-slot>

    <x-app.card>

        @can('pemesanan create')
            <x-slot name="header">
                <x-app.button type="create" href="{{ route('pemesanan.create') }}" />
            </x-slot>
        @endcan


        <x-app.table>
            <x-slot name="thead">
                <tr>
                    <x-app.table.th>#</x-app.table.th>
                    <x-app.table.th>Tgl. Pemesanan</x-app.table.th>
                    <x-app.table.th>Nama Pemesan</x-app.table.th>
                    <x-app.table.th>No. Whatsapp</x-app.table.th>
                    <x-app.table.th>Status Pemesanan</x-app.table.th>
                    <x-app.table.th>Aksi</x-app.table.th>
                </tr>
            </x-slot>
            <x-slot name="tbody">
                @foreach ($datas as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->tgl_pemesanan->format('d F Y') }}</td>
                        <td>{{ ucwords($data->pengguna->nama) }}</td>
                        <td>{{ $data->pengguna->no_hp }}</td>
                        <td>
                            @if ($data->status_pemesanan == 0)
                                <span class="badge fw-semibold bg-light-primary">Konfirmasi</span>
                            @elseif ($data->status_pemesanan == 1)
                                <span class="badge fw-semibold bg-light-info">Booking Diterima</span>
                            @elseif ($data->status_pemesanan == 2)
                                <span class="badge fw-semibold bg-light-success">Servis Selesai</span>
                            @elseif ($data->status_pemesanan == 3)
                                <span class="badge fw-semibold bg-light-danger">Booking Ditolak</span>
                            @endif
                        </td>
                        <td>
                            <x-app.button type="show" href="{{ route('pemesanan.show', $data->id) }}" />
                            @if ($data->status_pemesanan == 0)
                                @can('pemesanan update')
                                    <x-app.button type="edit" href="{{ route('pemesanan.edit', $data->id) }}" />
                                @endcan
                                @can('pemesanan destroy')
                                    <x-app.button type="delete" action="{{ route('pemesanan.destroy', $data->id) }}" />
                                @endcan
                                @can('konfirmasi pemesanan update')
                                    <x-app.button type="accepted"
                                        href="{{ route('konfirmasi_pemesanan.edit', $data->id) }}" />
                                @endcan
                                @can('konfirmasi pemesanan destroy')
                                    <x-app.button type="rejected"
                                        action="{{ route('konfirmasi_pemesanan.destroy', $data->id) }}" />
                                @endcan
                            @endif
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-app.table>

    </x-app.card>


    <x-slot:script>
        <x-app.alert.confirm />
        <x-app.alert.rejected />

        @if (session('message'))
            <x-app.alert.success />
        @endif
        @if (session('error'))
            <x-app.alert.error />
        @endif
    </x-slot>
</x-app-layout>
