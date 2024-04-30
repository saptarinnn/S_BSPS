<x-app-layout>
    <x-slot:title>{{ $page_meta['title'] }}</x-slot>
    <x-slot:main_title>{{ $page_meta['title'] }}</x-slot>

    <x-app.card>
        <x-app.form url="{{ $page_meta['url'] }}" method="{{ $page_meta['method'] }}" back="{{ $page_meta['back'] }}">
            @if ($page_meta['method'] == 'put')
                <x-app.form.content required label="" name="barang_id" value="{{ $data->barang_id }}"
                    type="hidden" />
                <x-app.form.content required label="Nama Barang" name="" value="{{ $data->barang->nama }}" readonly
                    style="background: rgb(240, 240, 240)" />
            @else
                <x-app.form.content required content="select" label="Nama Barang" name="barang_id">
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id }}" {{ $data->barang_id == $barang->id ? 'selected' : '' }}>
                            {{ ucwords($barang->nama) }}</option>
                    @endforeach
                </x-app.form.content>
            @endif
            <x-app.form.content required label="Tgl. Barang Masuk" name="tanggal"
                value="{{ old('tanggal', $data->tanggal) }}" type="date" />
            <x-app.form.content required label="Jumlah Barang Masuk" name="jumlah"
                value="{{ old('jumlah', $data->jumlah) }}" type="number" />
            <x-app.form.content required label="Keterangan" name="ket" value="{{ old('ket', $data->ket) }}"
                content="textarea" />
        </x-app.form>
    </x-app.card>

</x-app-layout>
