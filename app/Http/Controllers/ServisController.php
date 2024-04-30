<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Servis;
use App\Traits\SendNotificationWithWhatsapp;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServisController extends Controller
{
    use SendNotificationWithWhatsapp;

    public function index()
    {
        $datas = Servis::with(['pemesanan', 'mekanik'])->get(['id', 'pemesanan_id', 'mekanik_id', 'tgl_selesai_servis', 'status_servis', 'ket_servis']);
        if (auth()->user()->hasRole('customer')) {
            $datas = Servis::with(['pemesanan', 'mekanik'])->whereHas('pemesanan', function (Builder $query) {
                $query->where('pengguna_id', Auth::user()->id);
            })->get(['id', 'pemesanan_id', 'mekanik_id', 'tgl_selesai_servis', 'status_servis', 'ket_servis']);
        }
        if (auth()->user()->hasRole('mekanik')) {
            $datas = Servis::with(['pemesanan', 'mekanik'])->where('mekanik_id', Auth::user()->id)->get(['id', 'pemesanan_id', 'mekanik_id', 'tgl_selesai_servis', 'status_servis', 'ket_servis']);
        }

        return view('app.servis.index', [
            'datas' => $datas,
            'page_meta' => [
                'title' => 'Data Servis',
            ],
        ]);
    }

    public function show(Servis $servis)
    {
        return view('app.servis.show', [
            'data' => $servis,
            'page_meta' => [
                'title' => 'Detail Data Servis',
                'back' => route('servis.index'),
            ],
        ]);
    }

    public function update(Request $request, Servis $servis)
    {
        $pemesanan = Pemesanan::find($servis->pemesanan_id);
        DB::beginTransaction();
        try {
            $pemesanan->update([
                'ket_status' => 'Kendaraan sedang di periksa dan dilakukan perbaikan oleh mekanik atas nama '.ucwords($servis->mekanik->nama),
            ]);
            $servis->update([
                'status_servis' => '2',
                'ket_servis' => 'Kendaraan sedang di periksa dan dilakukan perbaikan oleh mekanik atas nama '.ucwords($servis->mekanik->nama),
            ]);
            DB::commit();

            return to_route('servis.index')->with('message', 'Data berhasil dikonfirmasi.');
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }

    public function finish(Request $request, Servis $servis)
    {
        $pemesanan = Pemesanan::find($servis->pemesanan_id);

        DB::beginTransaction();
        try {
            $pemesanan->update([
                'status_pemesanan' => '2',
                'ket_status' => 'Kendaraan telah selesai di servis oleh mekanik atas nama '.ucwords($servis->mekanik->nama).' silahkan kebagian pembayaran untuk melakukan pembayaran.',
            ]);
            $servis->update([
                'status_servis' => '3',
                'tgl_selesai_servis' => now(),
                'ket_servis' => 'Kendaraan telah selesai di servis oleh mekanik atas nama '.ucwords($servis->mekanik->nama).' silahkan kebagian pembayaran untuk melakukan pembayaran.',
            ]);
            DB::commit();

            $this->send($pemesanan->pengguna->no_hp, $servis->ket_servis);

            return to_route('servis.index')->with('message', 'Data berhasil dikonfirmasi.');
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }

    public function destroy(Kategori $kategori)
    {
        DB::beginTransaction();
        try {
            $kategori->delete();
            DB::commit();

            return to_route('servis.index')->with('message', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }
}
