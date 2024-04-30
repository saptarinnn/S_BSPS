<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengaturanRequest;
use App\Models\Pengaturan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    public function index()
    {
        $data = Pengaturan::select(['id', 'logo', 'judul', 'deskripsi', 'gambar'])->first();

        return view('app.pengaturan.form', [
            'data' => $data,
            'page_meta' => [
                'title' => 'Pengaturan Website',
                'url' => route('pengaturan.update', $data->id),
                'method' => 'put',
                'back' => route('dashboard'),
            ],
        ]);
    }

    public function update(PengaturanRequest $request, Pengaturan $pengaturan)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            if (! $request->file('gambar')) {
                $pengaturan->update($validated);
            } else {
                if ($pengaturan->gambar) {
                    $gambar = Storage::get($pengaturan->gambar);
                    if ($gambar) {
                        Storage::delete($pengaturan->gambar);
                    }
                }
                $validated['gambar'] = $validated['gambar']->store('home');
                $pengaturan->update($validated);
            }

            DB::commit();

            return to_route('pengaturan.index')->with('message', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }
}
