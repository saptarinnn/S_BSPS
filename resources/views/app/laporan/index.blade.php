<x-app-layout>
    <x-slot:title>{{ $page_meta['title'] }}</x-slot>
    <x-slot:main_title>{{ $page_meta['title'] }}</x-slot>

    <x-app.card>
        <form action="{{ $page_meta['route'] }}" method="post">
            @csrf
            <div class="row">
                <div class="gap-2 d-flex align-items-center justify-content-between">
                    <div class="mb-1 col-lg-4">
                        <label class="fw-semibold">Pilih bulan dan tahun</label>
                    </div>
                    <div class="mb-1 col-lg-3">
                        <select name="lapBulan" id="lapBulan" class="@error('lapBulan') is-invalid @enderror form-select"
                            required>
                            <option value="all">Semua bulan</option>
                            @foreach (getMonthIndonesian() as $i => $bulan)
                                <option value="{{ $i }}">{{ $bulan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-1 col-lg-3">
                        <select name="labTahun" id="labTahun"
                            class="@error('labTahun') is-invalid @enderror form-select" required>
                            <option value="">Pilih tahun</option>
                            @for ($i = 2024; $i < 2024 + 5; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-1 col-lg-3">
                        <button type="submit" class="btn btn-primary">Print laporan</button>
                    </div>
                </div>
            </div>
        </form>
    </x-app.card>

    <x-slot:script>
        @if (session('message'))
            <x-app.alert.error />
        @endif
    </x-slot>

</x-app-layout>
