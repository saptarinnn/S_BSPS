<x-app-layout>
    <x-slot:title>{{ $page_meta['title'] }}</x-slot>
    <x-slot:main_title>{{ $page_meta['title'] }}</x-slot>

    <x-app.card>

        <div class="row">
            <div class="col-md-4 col-12">
                @if (Storage::get($data->gambar))
                    <img class="img-fluid rounded" src="{{ Storage::url($data->gambar) }}" alt="">
                @else
                    <img class="img-fluid rounded" src="{{ asset('img/No-Image-Placeholder.svg.png') }}" alt="">
                @endif
            </div>

            <div class="col-md-8 col-12">
                <table class="table">
                    <tr>
                        <th>Nama Barang</th>
                        <td>: {{ ucwords($data->nama) }}</td>
                    </tr>
                    <tr>
                        <th>Kategori Barang</th>
                        <td>: {{ ucwords($data->kategori->nama) }}</td>
                    </tr>
                    <tr>
                        <th>Stok Barang</th>
                        <td>: {{ $data->stok }}</td>
                    </tr>
                    <tr>
                        <th>Harga Barang</th>
                        <td>: Rp {{ \Illuminate\Support\Number::format($data->harga, locale: 'id') }}</td>
                    </tr>
                    <tr>
                        <th class="col-3">Deskripsi Barang</th>
                        <td class="col-9 text-justify">: {{ ucwords($data->deskripsi) }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="mt-2 col-sm-12 d-flex justify-content-end">
            <a href="{{ $page_meta['back'] }}" class="btn btn-light-secondary">Kembali</a>
        </div>

    </x-app.card>

</x-app-layout>
