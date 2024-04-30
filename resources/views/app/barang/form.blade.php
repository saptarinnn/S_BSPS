<x-app-layout>
    <x-slot:title>{{ $page_meta['title'] }}</x-slot>
    <x-slot:main_title>{{ $page_meta['title'] }}</x-slot>

    <x-app.card>
        <x-app.form enctype="multipart/form-data" url="{{ $page_meta['url'] }}" method="{{ $page_meta['method'] }}"
            back="{{ $page_meta['back'] }}">
            <x-app.form.content label="Gambar Barang" name="gambar" value="{{ old('gambar', $data->gambar) }}"
                type="file" />
            <x-app.form.content required label="Nama Barang" name="nama" value="{{ old('nama', $data->nama) }}" />
            <x-app.form.content required content="select" label="Kategori" name="kategori_id">
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ $data->kategori_id == $kategori->id ? 'selected' : '' }}>
                        {{ ucwords($kategori->nama) }}</option>
                @endforeach
            </x-app.form.content>
            <x-app.form.content required label="Harga Satuan Barang" name="harga"
                value="{{ old('harga', $data->harga) }}" type="number" />
            <x-app.form.content required content="textarea" rows="10" label="Deskripsi Barang" name="deskripsi"
                value="{{ old('deskripsi', $data->deskripsi) }}" />
        </x-app.form>
    </x-app.card>

</x-app-layout>
