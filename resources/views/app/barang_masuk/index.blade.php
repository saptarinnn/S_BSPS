<x-app-layout>
    <x-slot:title>{{ $page_meta['title'] }}</x-slot>
    <x-slot:main_title>{{ $page_meta['title'] }}</x-slot>

    <x-app.card>

        <x-slot name="header">
            <x-app.button type="create" href="{{ route('barang_masuk.create') }}" />
        </x-slot>


        <x-app.table>
            <x-slot name="thead">
                <tr>
                    <x-app.table.th>#</x-app.table.th>
                    <x-app.table.th>Nama Barang</x-app.table.th>
                    <x-app.table.th>Tgl. Barang Masuk</x-app.table.th>
                    <x-app.table.th>Jumlah</x-app.table.th>
                    <x-app.table.th>Keterangan</x-app.table.th>
                    <x-app.table.th>Aksi</x-app.table.th>
                </tr>
            </x-slot>
            <x-slot name="tbody">
                @foreach ($datas as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ ucwords($data->barang->nama) }}</td>
                        <td>{{ $data->getSomeDate($data->tanggal) }}</td>
                        <td>{{ $data->jumlah }}</td>
                        <td>{{ ucwords($data->ket) }}</td>
                        <td>
                            {{-- <x-app.button type="edit" href="{{ route('barang_masuk.edit', $data->id) }}" /> --}}
                            <x-app.button type="delete" action="{{ route('barang_masuk.destroy', $data->id) }}" />
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