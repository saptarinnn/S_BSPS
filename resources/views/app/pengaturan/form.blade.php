<x-app-layout>
    <x-slot:title>{{ $page_meta['title'] }}</x-slot>
    <x-slot:main_title>{{ $page_meta['title'] }}</x-slot>

    <x-app.card>
        <x-app.form enctype="multipart/form-data" url="{{ $page_meta['url'] }}" method="{{ $page_meta['method'] }}"
            back="{{ $page_meta['back'] }}">
            <x-app.form.content required label="Logo Website" name="logo" value="{{ old('logo', $data->logo) }}" />
            <x-app.form.content required label="Judul Website" name="judul" value="{{ old('judul', $data->judul) }}" />
            <x-app.form.content required content="textarea" label="Deskripsi Website" name="deskripsi"
                value="{{ old('deskripsi', $data->deskripsi) }}" />
            <x-app.form.content label="Gambar Website" name="gambar" value="{{ old('gambar', $data->gambar) }}"
                type="file" />
        </x-app.form>
    </x-app.card>


    <x-slot:script>
        @if (session('message'))
            <x-app.alert.success />
        @endif
        @if (session('error'))
            <x-app.alert.error />
        @endif
    </x-slot>
</x-app-layout>
