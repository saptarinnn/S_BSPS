<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailTransaksi;
use App\Models\Pemesanan;
use App\Models\Pengguna;
use App\Models\Servis;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Builder;

class DashboardController extends Controller
{
    public function index()
    {
        $labels = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $dataorder = [];
        $tahun = date('Y');
        foreach ($labels as $i => $label) {
            $bulan = $i + 1;
            $transaksis = Transaksi::where('status_transaksi', '1')->whereMonth('tgl_transaksi', $bulan)->whereYear('tgl_transaksi', $tahun)->get();
            $cache = 0;
            if ($transaksis->toArray()) {
                foreach ($transaksis as $transaksi) {
                    foreach ($transaksi->detail_transaksis as $detail_transaksi) {
                        $cache += $detail_transaksi->jumlah_pembelian;
                    }
                }
                array_push($dataorder, $cache);
            } else {
                array_push($dataorder, 0);
            }
        }
        $sales = 0;
        $order = 0;
        $detailTransaksis = DetailTransaksi::with('transaksi')->whereHas('transaksi', function (Builder $query) {
            $query->where('status_transaksi', '1');
        })->get();
        foreach ($detailTransaksis as $detailTransaksi) {
            $sales += $detailTransaksi->sub_total;
            $order += $detailTransaksi->jumlah_pembelian;
        }

        $serviceNew = Servis::where('mekanik_id', auth()->user()->id)->where('status_servis', 1)->get();
        $serviceProcess = Servis::where('mekanik_id', auth()->user()->id)->where('status_servis', 2)->get();
        $serviceFinish = Servis::where('mekanik_id', auth()->user()->id)->where('status_servis', 3)->get();

        $newServis = Servis::with('pemesanan')->where('status_servis', 1)->whereHas('pemesanan', function (Builder $query) {
            $query->where('pengguna_id', auth()->user()->id);
        })->get();
        $processServis = Servis::with('pemesanan')->where('status_servis', 2)->whereHas('pemesanan', function (Builder $query) {
            $query->where('pengguna_id', auth()->user()->id);
        })->get();
        $finishServis = Servis::with('pemesanan')->where('status_servis', 3)->whereHas('pemesanan', function (Builder $query) {
            $query->where('pengguna_id', auth()->user()->id);
        })->get();

        $newBooking = Pemesanan::where('pengguna_id', auth()->user()->id)->where('status_pemesanan', 0)->get();
        $processBooking = Pemesanan::where('pengguna_id', auth()->user()->id)->where('status_pemesanan', 1)->get();
        $finishBooking = Pemesanan::where('pengguna_id', auth()->user()->id)->where('status_pemesanan', 3)->get();

        return view('app.dashboard', [
            /* Umum */
            'new' => Pemesanan::where('status_pemesanan', '0')->get(),
            'pending' => Pemesanan::where('status_pemesanan', '1')->get(),
            'success' => Pemesanan::where('status_pemesanan', '2')->get(),
            'failed' => Pemesanan::where('status_pemesanan', '3')->get(),
            'labels' => $labels,
            'dataorder' => $dataorder,
            'sales' => $sales,
            'order' => $order,
            'customer' => Pengguna::role('customer')->get(),
            'sparepart' => Barang::get(),

            /* Mekanik */
            'serviceNew' => ($serviceNew),
            'serviceProcess' => ($serviceProcess),
            'serviceFinish' => ($serviceFinish),

            /* Customer */
            'newServis' => ($newServis),
            'processServis' => ($processServis),
            'finishServis' => ($finishServis),
            'newBooking' => ($newBooking),
            'processBooking' => ($processBooking),
            'finishBooking' => ($finishBooking),

        ]);
    }
}
