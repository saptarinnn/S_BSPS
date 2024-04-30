<x-app-layout>
    <x-slot:title>{{ $page_meta['title'] }}</x-slot>
    <x-slot:main_title>{{ $page_meta['title'] }}</x-slot>

    <x-app.card>
        <x-app.form url="{{ $page_meta['url'] }}" method="{{ $page_meta['method'] }}" back="{{ $page_meta['back'] }}">
            <input type="hidden" name="pengguna_id" value="{{ auth()->user()->id }}">
            <x-app.form.content required label="Nama Pemesan" name="" value="{{ ucwords(auth()->user()->nama) }}"
                readonly style="background: #f1f1f1" />
            <x-app.form.content required label="No. Whatsapp" name=""
                value="{{ ucwords(auth()->user()->no_hp) }}" readonly style="background: #f1f1f1" />
            <x-app.form.content required label="Tanggal Pemesanan" name="tgl_pemesanan"
                value="{{ old('tgl_pemesanan', $data->tgl_pemesanan?->format('Y-m-d')) }}" type="date" />
            <x-app.form.content required label="Plat Kendaraan" name="plat_nomor"
                value="{{ old('plat_nomor', $data->plat_nomor) }}" />
            <x-app.form.content required label="Merek Kendaraan" name="merek"
                value="{{ old('merek', $data->merek) }}" />
            <x-app.form.content content="textarea" rows="5" label="Keterangan" name="ket_pemesanan"
                value="{{ old('ket_pemesanan', $data->ket_pemesanan) }}"
                desc="*Deskripsikan secara singkat permasalahan pada mobil anda." />
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
