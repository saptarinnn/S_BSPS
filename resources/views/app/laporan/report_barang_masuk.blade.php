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
            <th>Tgl. Masuk</th>
            <th>Barang</th>
            <th>Kategori</th>
            <th>Qty</th>
            <th>Ket</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->tanggal->format('d F Y') }}</td>
                <td>{{ ucwords($data->barang->nama) }}</td>
                <td>{{ ucwords($data->barang->kategori->nama) }}</td>
                <td>{{ $data->jumlah }}</td>
                <td>{{ ucwords($data->ket) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
