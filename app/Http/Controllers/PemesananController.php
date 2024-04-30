<?php

namespace App\Http\Controllers;

use App\Http\Requests\PemesananRequest;
use App\Models\Pemesanan;
use App\Models\Pengguna;
use App\Traits\SendNotificationWithWhatsapp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PemesananController extends Controller
{
    use SendNotificationWithWhatsapp;

    public function index()
    {
        $datas = Pemesanan::with('pengguna')->get(['id', 'pengguna_id', 'tgl_pemesanan', 'plat_nomor', 'merek', 'status_pemesanan', 'ket_pemesanan']);
        if (auth()->user()->hasRole('customer')) {
            $datas = Pemesanan::with('pengguna')->where('pengguna_id', Auth::user()->id)->get(['id', 'pengguna_id', 'tgl_pemesanan', 'plat_nomor', 'merek', 'status_pemesanan', 'ket_pemesanan']);
        }

        return view('app.pemesanan.index', [
            'datas' => $datas,
            'page_meta' => [
                'title' => 'Data Pemesanan',
            ],
        ]);
    }

    public function create()
    {
        return view('app.pemesanan.form', [
            'data' => new Pemesanan(),
            'page_meta' => [
                'title' => 'Tambah Data Pemesanan',
                'url' => route('pemesanan.store'),
                'method' => 'post',
                'back' => route('pemesanan.index'),
            ],
        ]);
    }

    public function store(PemesananRequest $request)
    {
        $servis = Pengguna::all();
        $user = '';
        foreach ($servis as $ser) {
            if ((str_replace(['["', '"]'], '', $ser->getRoleNames()) == 'admin service') || (str_replace(['["', '"]'], '', $ser->getRoleNames()) == 'admin servis')) {
                $user = $ser;
            }
        }

        // Cek Pengguna
        $pengguna = Pengguna::find($request->pengguna_id);
        if (! $pengguna) {
            return back()->with('error', 'Maaf data pengguna tidak ditemukan');
        }

        // Cek Pemesanan
        $pemesanan = Pemesanan::where('pengguna_id', $pengguna->id)->where('status_pemesanan', '0')->first();
        if ($pemesanan) {
            return to_route('pemesanan.index')->with('error', 'Maaf, telah terdapat pemesanan service yang sedang berlangsung.');
        }

        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $validated['ket_status'] = 'Booking Service berhasil ditambahkan, silahkan menunggu konfirmasi dari admin.';
            Pemesanan::create($validated);
            DB::commit();

            // Send to customer
            $this->send($pengguna->no_hp, $validated['ket_status']);
            // Send to Admin Servis
            $this->send($user->no_hp, 'Terdapat booking servis yang baru. Dengan nama pemesan '.ucwords($pengguna->nama).' dengan keluhan '.ucwords($request->ket_pemesanan).'. Silahkan periksa dan lakukan konfirmasi.');

            return to_route('pemesanan.index')->with('message', 'Booking Service berhasil ditambahkan, silahkan menunggu konfirmasi dari admin.');
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }

    public function show(Pemesanan $pemesanan)
    {
        return view('app.pemesanan.show', [
            'data' => $pemesanan,
            'page_meta' => [
                'title' => 'Detail Data Pemesanan',
                'back' => route('pemesanan.index'),
            ],
        ]);
    }

    public function edit(Pemesanan $pemesanan)
    {
        return view('app.pemesanan.form', [
            'data' => $pemesanan,
            'page_meta' => [
                'title' => 'Ubah Data Pemesanan',
                'url' => route('pemesanan.update', $pemesanan->id),
                'method' => 'put',
                'back' => route('pemesanan.index'),
            ],
        ]);
    }

    public function update(PemesananRequest $request, Pemesanan $pemesanan)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $validated['ket_status'] = 'Booking Service berhasil ditambahkan, silahkan menunggu konfirmasi dari admin.';
            $pemesanan->update($validated);
            DB::commit();

            return to_route('pemesanan.index')->with('message', 'Data berhasil dirubah.');
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }

    public function destroy(Pemesanan $pemesanan)
    {
        DB::beginTransaction();
        try {
            $pemesanan->delete();
            DB::commit();

            return to_route('pemesanan.index')->with('message', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }
}
