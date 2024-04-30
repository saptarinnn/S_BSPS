<x-app-layout>
    <x-slot:title>{{ $page_meta['title'] }}</x-slot>
    <x-slot:main_title>{{ $page_meta['title'] }} - {{ $data->kode_unik }}</x-slot>

    <x-app.card>

        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Nama Pembeli</th>
                    <td>{{ ucwords($data->customer->nama) }}</td>
                </tr>
                <tr>
                    <th>Nomor Whatsapp</th>
                    <td>{{ $data->customer->no_hp }}</td>
                </tr>
                <tr>
                    <th>Tanggal Pengambilan/Pembayaran</th>
                    <td>{{ $data->tgl_transaksi->format('d F Y') }}</td>
                </tr>
                <tr>
                    <th>Status Pengambilan/Pembayaran</th>
                    <td>
                        @if ($data->status_transaksi == 0)
                            <span class="badge bg-light-primary">Konfirmasi</span>
                        @elseif ($data->status_transaksi == 1)
                            <span class="badge bg-light-info">Pemesanan Selesai</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Keterangan Pemesanan</th>
                    <td>{{ ucwords($data->keterangan) }}</td>
                </tr>
            </table>
        </div>

        <div class="table-responsive-md">
            <table class="table mb-0 table-bordered" width="100%">
                <thead>
                    <tr>
                        <x-app.table.th>#</x-app.table.th>
                        <x-app.table.th>Barang</x-app.table.th>
                        <x-app.table.th>Qty</x-app.table.th>
                        <x-app.table.th>Harga Satuan</x-app.table.th>
                        <x-app.table.th>Subtotal</x-app.table.th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data->detail_transaksis as $detail_transaksi)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ ucwords($detail_transaksi->barang->nama) }}</td>
                            <td>{{ $detail_transaksi->jumlah_pembelian }}</td>
                            <td>Rp <span
                                    class="total">{{ \Illuminate\Support\Number::format($detail_transaksi->barang->harga, locale: 'id') }}</span>
                            </td>
                            <td class="fw-semibold">Rp <span
                                    class="total">{{ \Illuminate\Support\Number::format($detail_transaksi->sub_total, locale: 'id') }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-center fw-semibold">Total Pembayaran</td>
                        <th class="fw-semibold">Rp <span
                                class="total">{{ \Illuminate\Support\Number::format($total, locale: 'id') }}</span>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="gap-2 mt-4 col-sm-12 d-flex justify-content-end">
            <a href="{{ route('pembelian.index') }}" class="btn btn-sm btn-light-secondary">Kembali</a>
            @can('pembelian update')
                <form method="POST" action="{{ route('pembelian.update', $data->id) }}" class="d-inline">
                    @method('PUT')
                    @csrf
                    <input name="_method" type="hidden" value="PUT">
                    <button type="submit" class="btn btn-success btn-sm btn-confirm">
                        Konfirmasi Pembelian
                    </button>
                </form>
            @endcan
        </div>

    </x-app.card>

    <x-slot:script>
        <script type="module">
            $('.btn-confirm').click(function(e) {
                e.preventDefault();
                let form = $(this).closest("form");
                let name = $(this).data("name");
                Swal.fire({
                    title: "Konfirmasi?",
                    text: "Konfirmasi, jika pembayaran dan pengambilan barang telah dilakukan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, konfirmasi!",
                    cancelButtonText: "Batal",
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        </script>

    </x-slot>
</x-app-layout>
