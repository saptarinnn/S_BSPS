<x-app-layout>
    <x-slot:title>{{ $page_meta['title'] }}</x-slot>
    <x-slot:main_title>{{ $page_meta['title'] }}</x-slot>

    <x-app.card>
        <x-app.form url="{{ $page_meta['url'] }}" method="{{ $page_meta['method'] }}" back="{{ $page_meta['back'] }}">

            <x-app.form.content content="select" required label="Pilih mekanik" name="mekanik_id">
                <option value="">Pilih salah satu mekanik ...</option>
                @foreach ($mekaniks as $mekanik)
                    <option value="{{ $mekanik->id }}">{{ ucwords($mekanik->nama) }}</option>
                @endforeach
            </x-app.form.content>

            {{-- <x-app.form.content required content="textarea" label="Keterangan" name="keterangan"
                value="{{ old('keterangan') }}" /> --}}

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
