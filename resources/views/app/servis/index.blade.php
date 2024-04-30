<x-app-layout>
    <x-slot:title>{{ $page_meta['title'] }}</x-slot>
    <x-slot:main_title>{{ $page_meta['title'] }}</x-slot>

    <x-app.card>

        <x-app.table>
            <x-slot name="thead">
                <tr>
                    <x-app.table.th>#</x-app.table.th>
                    <x-app.table.th>Tgl. Pemesanan</x-app.table.th>
                    <x-app.table.th>Nama Pemesan</x-app.table.th>
                    <x-app.table.th>Kendaraan</x-app.table.th>
                    <x-app.table.th>Mekanik</x-app.table.th>
                    <x-app.table.th>Status Servis</x-app.table.th>
                    <x-app.table.th>Aksi</x-app.table.th>
                </tr>
            </x-slot>
            <x-slot name="tbody">
                @foreach ($datas as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->pemesanan->tgl_pemesanan->format('d F Y') }}</td>
                        <td>{{ ucwords($data->pemesanan->pengguna->nama) }}</td>
                        <td>{{ ucwords($data->pemesanan->merek) }} ({{ strtoupper($data->pemesanan->plat_nomor) }})</td>
                        <td>{{ ucwords($data->mekanik->nama) }}</td>
                        <td>
                            @if ($data->status_servis == 1)
                                <span class="badge fw-semibold bg-light-primary">Diterima</span>
                            @elseif ($data->status_servis == 2)
                                <span class="badge fw-semibold bg-light-info">Proses Servis</span>
                            @elseif ($data->status_servis == 3)
                                <span class="badge fw-semibold bg-light-success">Servis Selesai</span>
                            @endif
                        </td>
                        <td>
                            <x-app.button type="show" href="{{ route('servis.show', $data->id) }}" />
                            @if ($data->status_servis == 1)
                                @can('servis destroy')
                                    <x-app.button type="delete" action="{{ route('servis.destroy', $data->id) }}" />
                                @endcan
                                @can('servis update')
                                    <x-app.button type="acc" action="{{ route('servis.update', $data->id) }}" />
                                @endcan
                            @endif
                            @can('servis finish')
                                @if ($data->status_servis == 2)
                                    <x-app.button type="finish" action="{{ route('servis.finish', $data->id) }}" />
                                @endif
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-app.table>

    </x-app.card>


    <x-slot:script>
        <x-app.alert.confirm />
        <x-app.alert.acc />

        @if (session('message'))
            <x-app.alert.success />
        @endif
    </x-slot>
</x-app-layout>
