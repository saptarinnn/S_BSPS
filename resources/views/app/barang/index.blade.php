<x-app-layout>
    <x-slot:title>{{ $page_meta['title'] }}</x-slot>
    <x-slot:main_title>{{ $page_meta['title'] }}</x-slot>

    <x-app.card>

        <x-slot name="header">
            <x-app.button type="create" href="{{ route('barang.create') }}" />
        </x-slot>


        <x-app.table>
            <x-slot name="thead">
                <tr>
                    <x-app.table.th>#</x-app.table.th>
                    <x-app.table.th>Gambar</x-app.table.th>
                    <x-app.table.th>Nama Barang</x-app.table.th>
                    <x-app.table.th>Kategori</x-app.table.th>
                    <x-app.table.th>Stok</x-app.table.th>
                    <x-app.table.th>Harga</x-app.table.th>
                    <x-app.table.th>Aksi</x-app.table.th>
                </tr>
            </x-slot>
            <x-slot name="tbody">
                @foreach ($datas as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if (Storage::get($data->gambar))
                                <a href="{{ Storage::url($data->gambar) }}" target="_blank" rel="noopener noreferrer">
                                    <img width="50" src="{{ Storage::url($data->gambar) }}" alt="">
                                </a>
                            @else
                                <a href="{{ asset('img/No-Image-Placeholder.svg.png') }}" target="_blank"
                                    rel="noopener noreferrer">
                                    <img width="50" src="{{ asset('img/No-Image-Placeholder.svg.png') }}"
                                        alt="">
                                </a>
                            @endif
                        </td>
                        <td>{{ ucwords($data->nama) }}</td>
                        <td>{{ ucwords($data->kategori->nama) }}</td>
                        <td>{{ $data->stok }}</td>
                        <td>Rp {{ \Illuminate\Support\Number::format($data->harga, locale: 'id') }}</td>
                        <td>
                            <x-app.button type="show" href="{{ route('barang.show', $data->id) }}" />
                            <x-app.button type="edit" href="{{ route('barang.edit', $data->id) }}" />
                            <x-app.button type="delete" action="{{ route('barang.destroy', $data->id) }}" />
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
