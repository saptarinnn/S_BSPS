<style>
    * {
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        font-size: 14px;
        font-weight: 600;
    }

    table {
        width: 90%;
        margin: auto;
    }

    table,
    tr,
    th,
    td {
        border-spacing: 0;
        border: 1px solid black !important;
    }

    table thead tr th,
    table tbody tr td,
    table tfoot tr td {
        padding: 10px 6px;
    }

    table thead tr th,
    table tfoot tr td {
        background-color: #eaeaea;
    }
</style>

<h3 style="font-size: 18px; text-align: center; padding: 10px 0;">
    Lapora Penjualan Sparepart Pada {{ $bulan == 'all' ? '' : 'Bulan ' . $bulan }} Tahun {{ $tahun }}
</h3>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Kode Unik</th>
            <th>Tgl. Transaksi</th>
            <th>Nama Customer</th>
            <th>Barang</th>
            <th>Qty</th>
            <th>SubTotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr>
                <td rowspan="{{ count($data->detail_transaksis) + 1 }}">{{ $loop->iteration }}</td>
                <td rowspan="{{ count($data->detail_transaksis) + 1 }}">{{ $data->kode_unik }}</td>
                <td rowspan="{{ count($data->detail_transaksis) + 1 }}">{{ $data->tgl_transaksi->format('d F Y') }}</td>
                <td rowspan="{{ count($data->detail_transaksis) + 1 }}">{{ ucwords($data->customer->nama) }}</td>
            </tr>
            @foreach ($data->detail_transaksis as $detail_transaksi)
                <tr>
                    <td>{{ ucwords($detail_transaksi->barang->nama) }}</td>
                    <td>{{ $detail_transaksi->jumlah_pembelian }}</td>
                    <td>
                        Rp <span
                            class="total">{{ \Illuminate\Support\Number::format($detail_transaksi->sub_total, locale: 'id') }}</span>
                    </td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6" align="center">Total Pembayaran</td>
            <td>
                Rp <span class="total">{{ \Illuminate\Support\Number::format($total, locale: 'id') }}</span>
            </td>
        </tr>
    </tfoot>
</table>
