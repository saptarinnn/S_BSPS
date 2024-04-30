<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LaporanController extends Controller
{
    public function penjualanIndex()
    {
        return view('app.laporan.index', [
            'page_meta' => [
                'title' => 'Cetak Laporan Penjualan',
                'route' => route('laporan-penjualan'),
            ],
        ]);
    }

    public function penjualanPost(Request $request)
    {
        $total = 0;
        $bulan = $request->lapBulan;
        $tahun = $request->labTahun;

        if ($bulan == 'all') {
            $datas = Transaksi::with(['customer', 'detail_transaksis'])->whereYear('tgl_transaksi', $tahun)->get();
        } else {
            $datas = Transaksi::with(['customer', 'detail_transaksis'])->whereMonth('tgl_transaksi', $bulan)->whereYear('tgl_transaksi', $tahun)->get();
        }

        foreach ($datas as $data) {
            foreach ($data->detail_transaksis as $detail) {
                $total += $detail->sub_total;
            }
        }

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('app.laporan.report_penjualan', [
            'datas' => $datas,
            'total' => $total,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);

        return $pdf->stream('Laporan-Penjualan-'.$bulan.'-'.$tahun.'-'.date('d/m/y').'pdf');

    }

    public function barangmasukIndex()
    {
        return view('app.laporan.index', [
            'page_meta' => [
                'title' => 'Cetak Laporan Barang Masuk',
                'route' => route('laporan-barangmasuk'),
            ],
        ]);
    }

    public function barangmasukPost(Request $request)
    {
        $bulan = $request->lapBulan;
        $tahun = $request->labTahun;

        if ($bulan == 'all') {
            $datas = BarangMasuk::with(['barang'])->whereYear('tanggal', $tahun)->get();
        } else {
            $datas = BarangMasuk::with(['barang'])->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();
        }

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('app.laporan.report_barang_masuk', [
            'datas' => $datas,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);

        return $pdf->stream('Laporan-BarangMasuk-'.$bulan.'-'.$tahun.'-'.date('d/m/y').'pdf');
    }
}
