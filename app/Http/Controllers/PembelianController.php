<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Traits\SendNotificationWithWhatsapp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    use SendNotificationWithWhatsapp;

    public function index()
    {
        return view('app.pembelian.index', [
            'datas' => Transaksi::with(['customer', 'detail_transaksis'])->where('status_transaksi', '0')->get(['id', 'customer_id', 'kode_unik', 'tgl_transaksi', 'status_transaksi', 'keterangan']),
            'page_meta' => [
                'title' => 'Data Pembelian',
            ],
        ]);
    }

    public function show(Transaksi $pembelian)
    {
        $total = 0;
        foreach ($pembelian->detail_transaksis as $detail) {
            $total += $detail->sub_total;
        }

        return view('app.pembelian.show', [
            'data' => $pembelian,
            'total' => $total,
            'page_meta' => [
                'title' => 'Detail Data Pemesanan',
                'back' => route('pemesanan.index'),
            ],
        ]);
    }

    public function update(Request $request, Transaksi $pembelian)
    {
        DB::beginTransaction();
        try {
            $pembelian->update([
                'status_transaksi' => '1',
                'keterangan' => 'Pembayaran dan pengambilan barang telah dilakukan pada tanggal '.date('d F Y'),
            ]);
            DB::commit();

            $this->send($pembelian->customer->no_hp, 'Pembelian telah selesai, Pembayaran dan pengambilan barang telah dilakukan pada tanggal '.date('d F Y').'. Terima kasih telah melakukan pembayaran dan pengambilan barang.');

            return to_route('penjualan.index')->with('message', 'Konfirmasi pembelian barang berhasil.');
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }

    public function destroy(Transaksi $pembelian)
    {
        DB::beginTransaction();
        try {
            foreach ($pembelian->detail_transaksis as $detail_transaksi) {
                $barang = Barang::find($detail_transaksi->barang_id);
                $barang->update([
                    'stok' => $barang->stok + $detail_transaksi->jumlah_pembelian,
                ]);
            }

            $pembelian->delete();
            DB::commit();

            return to_route('pembelian.index')->with('message', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }
}
