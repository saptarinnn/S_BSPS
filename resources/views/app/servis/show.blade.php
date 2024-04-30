<x-app-layout>
    <x-slot:title>{{ $page_meta['title'] }}</x-slot>
    <x-slot:main_title>{{ $page_meta['title'] }}</x-slot>

    <x-app.card>

        <table class="table">
            <tr>
                <th>Nama Pemesanan</th>
                <td>: {{ ucwords($data->pemesanan->pengguna->nama) }}</td>
            </tr>
            <tr>
                <th>Nomor Whatsapp</th>
                <td>: {{ $data->pemesanan->pengguna->no_hp }}</td>
            </tr>
            <tr>
                <th>Tanggal Pemesanan</th>
                <td>: {{ $data->pemesanan->tgl_pemesanan->format('d F Y') }}</td>
            </tr>
            <tr>
                <th>Plat Kendaraan</th>
                <td>: {{ strtoupper($data->pemesanan->plat_nomor) }}</td>
            </tr>
            <tr>
                <th>Merek Kendaraan</th>
                <td>: {{ ucwords($data->pemesanan->merek) }}</td>
            </tr>
            <tr>
                <th>Status Servis</th>
                <td>:
                    @if ($data->status_servis == 1)
                        <span class="badge fw-semibold bg-light-primary">Diterima</span>
                    @elseif ($data->status_servis == 2)
                        <span class="badge fw-semibold bg-light-info">Proses Servis</span>
                    @elseif ($data->status_servis == 3)
                        <span class="badge fw-semibold bg-light-success">Servis Selesai</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Keterangan Pemesanan</th>
                <td>: {{ ucwords($data->pemesanan->ket_pemesanan) }}</td>
            </tr>
            @if ($data->status_servis == 3)
                <tr>
                    <th>Tgl. Selesai Servis</th>
                    <td>: {{ ucwords($data->tgl_selesai_servis?->format('d F Y')) }}</td>
                </tr>
            @endif
            <tr>
                <th>Keterangan Servis</th>
                <td>: {{ ucwords($data->ket_servis) }}</td>
            </tr>
        </table>

        <div class="mt-2 col-sm-12 d-flex justify-content-end">
            <a href="{{ $page_meta['back'] }}" class="btn btn-light-secondary">Kembali</a>
        </div>

    </x-app.card>

</x-app-layout>
