<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Pengguna;
use App\Models\Servis;
use App\Traits\SendNotificationWithWhatsapp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KonfirmasiPemesananController extends Controller
{
    use SendNotificationWithWhatsapp;

    public function edit(string $id)
    {
        $data = Pemesanan::findOrFail($id);

        return view('app.konfirmasi_pemesanan.form', [
            'data' => $data,
            'mekaniks' => Pengguna::roleMekanik(),
            'page_meta' => [
                'title' => 'Konfirmasi Pemesanan',
                'url' => route('konfirmasi_pemesanan.update', $data->id),
                'method' => 'put',
                'back' => route('pemesanan.index'),
            ],
        ]);
    }

    public function update(Request $request, string $id)
    {
        $mekaniks = Pengguna::all();
        $mekanik = '';
        foreach ($mekaniks as $meka) {
            if ((str_replace(['["', '"]'], '', $meka->getRoleNames()) == 'mekanik')) {
                $mekanik = $meka;
            }
        }

        // Validation
        $validated = $request->validate([
            'mekanik_id' => ['required'],
        ]);
        $pemesanan = Pemesanan::findOrFail($id);

        DB::beginTransaction();
        try {
            $pemesanan->update([
                'status_pemesanan' => '1',
                'ket_status' => 'Data booking service telah di konfirmasi oleh admin. Silahkan datang kebengkel pada tanggal yang telah ditentukan, serta tunjukan bukti booking service.',
            ]);

            Servis::create([
                'pemesanan_id' => $id,
                'mekanik_id' => $request->mekanik_id,
                'ket_servis' => 'Data booking service telah di konfirmasi oleh admin. Silahkan datang kebengkel pada tanggal yang telah ditentukan, serta tunjukan bukti booking service.',
            ]);
            DB::commit();

            // Send to customer
            $this->send($pemesanan->pengguna->no_hp, $pemesanan->ket_status);
            // Send to Admin Servis
            $this->send($mekanik->no_hp, 'Terdapat booking service yang baru. Silahkan cek untuk melihat keterangan lebih lanjut.');

            return to_route('servis.index')->with('message', 'Data booking service berhasil dikonfirmasi');
        } catch (\Exception $e) {
            throw $e;
            DB::rollback();
        }
    }

    public function destroy(string $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        DB::beginTransaction();
        try {
            $pemesanan->update([
                'status_pemesanan' => '3',
                'ket_status' => 'Data pemesanan/ booking service ditolak.',
            ]);

            DB::commit();

            return to_route('pemesanan.index')->with('message', 'Data pemesanan/ booking service di tolak.');
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }
}
