<x-app-layout>
    <x-slot:title>{{ $page_meta['title'] }}</x-slot>
    <x-slot:main_title>{{ $page_meta['title'] }}</x-slot>

    <x-app.card>

        <x-app.table>
            <x-slot name="thead">
                <tr>
                    <x-app.table.th>#</x-app.table.th>
                    <x-app.table.th>Tgl. Transaksi</x-app.table.th>
                    <x-app.table.th>Kode Unik</x-app.table.th>
                    <x-app.table.th>Nama Pembeli</x-app.table.th>
                    <x-app.table.th>No. Whatsapp</x-app.table.th>
                    <x-app.table.th>Status Pembelian</x-app.table.th>
                    <x-app.table.th>Aksi</x-app.table.th>
                </tr>
            </x-slot>
            <x-slot name="tbody">
                @foreach ($datas as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->tgl_transaksi->format('d F Y') }}</td>
                        <td>{{ $data->kode_unik }}</td>
                        <td>{{ ucwords($data->customer->nama) }}</td>
                        <td>{{ $data->customer->no_hp }}</td>
                        <td>
                            @if ($data->status_transaksi == 0)
                                <span class="badge fw-semibold bg-light-primary">Konfirmasi</span>
                            @elseif ($data->status_transaksi == 1)
                                <span class="badge fw-semibold bg-light-info">Pemesanan Selesai</span>
                            @endif
                        </td>
                        <td>
                            <x-app.button type="show" href="{{ route('pembelian.show', $data->id) }}" />
                            <x-app.button type="delete" action="{{ route('pembelian.destroy', $data->id) }}" />
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
