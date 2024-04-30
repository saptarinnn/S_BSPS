<x-app-layout>
    <x-slot:title>{{ $page_meta['title'] }}</x-slot>
    <x-slot:main_title>{{ $page_meta['title'] }}</x-slot>

    <x-app.card>

        <table class="table">
            <tr>
                <th>Nama Pemesanan</th>
                <td>: {{ ucwords($data->pengguna->nama) }}</td>
            </tr>
            <tr>
                <th>Nomor Whatsapp</th>
                <td>: {{ $data->pengguna->no_hp }}</td>
            </tr>
            <tr>
                <th>Tanggal Pemesanan</th>
                <td>: {{ $data->tgl_pemesanan->format('d F Y') }}</td>
            </tr>
            <tr>
                <th>Plat Kendaraan</th>
                <td>: {{ strtoupper($data->plat_nomor) }}</td>
            </tr>
            <tr>
                <th>Merek Kendaraan</th>
                <td>: {{ ucwords($data->merek) }}</td>
            </tr>
            <tr>
                <th>Status Pemesanan</th>
                <td>:
                    @if ($data->status_pemesanan == 0)
                        <span class="badge bg-light-primary"> Konfirmasi</span>
                    @elseif ($data->status_pemesanan == 1)
                        <span class="badge bg-light-info"> Booking Diterima</span>
                    @elseif ($data->status_pemesanan == 2)
                        <span class="badge bg-light-success"> Servis Selesai</span>
                    @elseif ($data->status_pemesanan == 3)
                        <span class="badge bg-light-danger"> Booking Ditolak</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Keterangan Pemesanan</th>
                <td>: {{ ucwords($data->ket_pemesanan) }}</td>
            </tr>
            <tr>
                <th>Keterangan Status</th>
                <td>: {{ ucwords($data->ket_status) }}</td>
            </tr>
        </table>

        <div class="mt-2 col-sm-12 d-flex justify-content-end">
            <a href="{{ route('pemesanan.index') }}" class="btn btn-light-secondary">Kembali</a>
        </div>

    </x-app.card>

</x-app-layout>
