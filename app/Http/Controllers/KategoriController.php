<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriRequest;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index()
    {
        return view('app.kategori.index', [
            'datas' => Kategori::get(['id', 'nama']),
            'page_meta' => [
                'title' => 'Data Kategori',
            ],
        ]);
    }

    public function create()
    {
        return view('app.kategori.form', [
            'data' => new User(),
            'page_meta' => [
                'title' => 'Tambah Data Kategori',
                'url' => route('kategori.store'),
                'method' => 'post',
                'back' => route('kategori.index'),
            ],
        ]);
    }

    public function store(KategoriRequest $request)
    {

        DB::beginTransaction();
        try {
            Kategori::create($request->validated());
            DB::commit();

            return to_route('kategori.index')->with('message', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }

    public function edit(Kategori $kategori)
    {
        return view('app.kategori.form', [
            'data' => $kategori,
            'page_meta' => [
                'title' => 'Ubah Data Kategori',
                'url' => route('kategori.update', $kategori->id),
                'method' => 'put',
                'back' => route('kategori.index'),
            ],
        ]);
    }

    public function update(KategoriRequest $request, Kategori $kategori)
    {
        DB::beginTransaction();
        try {
            $kategori->update($request->validated());
            DB::commit();

            return to_route('kategori.index')->with('message', 'Data berhasil dirubah.');
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

            return to_route('kategori.index')->with('message', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }
}
