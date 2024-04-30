<x-app-layout>
    <x-slot:title>{{ $page_meta['title'] }}</x-slot>
    <x-slot:main_title>{{ $page_meta['title'] }}</x-slot>

    <x-app.card>
        <x-app.form url="{{ $page_meta['url'] }}" method="{{ $page_meta['method'] }}" back="{{ $page_meta['back'] }}">
            <x-app.form.content label="Nama Kategori" name="nama" value="{{ old('nama', $data->nama) }}" />
        </x-app.form>
    </x-app.card>

</x-app-layout>
