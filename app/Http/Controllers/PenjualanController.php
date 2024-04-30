<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;

class PenjualanController extends Controller
{
    public function index()
    {
        return view('app.penjualan.index', [
            'datas' => Transaksi::with(['customer', 'detail_transaksis'])->where('status_transaksi', '1')->get(['id', 'customer_id', 'kode_unik', 'tgl_transaksi', 'status_transaksi', 'keterangan']),
            'page_meta' => [
                'title' => 'Data Penjualan Selesai',
            ],
        ]);
    }

    public function show(Transaksi $penjualan)
    {
        $total = 0;
        foreach ($penjualan->detail_transaksis as $detail) {
            $total += $detail->sub_total;
        }

        return view('app.penjualan.show', [
            'data' => $penjualan,
            'total' => $total,
            'page_meta' => [
                'title' => 'Detail Data Penjualan Sukses',
                'back' => route('penjualan.index'),
            ],
        ]);
    }
}
