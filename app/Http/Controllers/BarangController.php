<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarangRequest;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BarangController extends Controller
{
    public function index()
    {
        return view('app.barang.index', [
            'datas' => Barang::with('kategori')->get(),
            'page_meta' => [
                'title' => 'Data Barang',
            ],
        ]);
    }

    public function create()
    {
        return view('app.barang.form', [
            'data' => new Barang(),
            'kategoris' => Kategori::get(),
            'page_meta' => [
                'title' => 'Tambah Data Barang',
                'url' => route('barang.store'),
                'method' => 'post',
                'back' => route('barang.index'),
            ],
        ]);
    }

    public function store(BarangRequest $request)
    {
        $validate = $request->validated();
        $gambar = '';
        if ($gambar) {
            $gambar = $validate['gambar']->store('barang');
        }

        DB::beginTransaction();
        try {
            Barang::create([
                'nama' => $request->nama,
                'slug' => Str::slug($request->nama),
                'gambar' => $gambar,
                'kategori_id' => $request->kategori_id,
                'stok' => 0,
                'harga' => $request->harga,
                'deskripsi' => $request->deskripsi,
            ]);
            DB::commit();

            return to_route('barang.index')->with('message', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }

    public function edit(Barang $barang)
    {
        return view('app.barang.form', [
            'data' => $barang,
            'kategoris' => Kategori::get(),
            'page_meta' => [
                'title' => 'Ubah Data Barang',
                'url' => route('barang.update', $barang->id),
                'method' => 'put',
                'back' => route('barang.index'),
            ],
        ]);
    }

    public function show(Barang $barang)
    {
        return view('app.barang.show', [
            'data' => $barang,
            'page_meta' => [
                'title' => 'Detail Data Barang',
                'back' => route('barang.index'),
            ],
        ]);
    }

    public function update(BarangRequest $request, Barang $barang)
    {
        $validate = $request->validated();

        DB::beginTransaction();
        try {
            if (! $request->file('gambar')) {
                $barang->update([
                    'nama' => $request->nama,
                    'slug' => Str::slug($request->nama),
                    'kategori_id' => $request->kategori_id,
                    'stok' => $barang->stok,
                    'harga' => $request->harga,
                    'deskripsi' => $request->deskripsi,
                ]);
            } else {
                $gambar = Storage::get($barang->gambar);
                if ($gambar) {
                    Storage::delete($barang->gambar);
                }
                $barang->update([
                    'nama' => $request->nama,
                    'slug' => Str::slug($request->nama),
                    'gambar' => $validate['gambar']->store('barang'),
                    'kategori_id' => $request->kategori_id,
                    'stok' => 0,
                    'harga' => $request->harga,
                    'deskripsi' => $request->deskripsi,
                ]);
            }

            // $barang->update($validate);
            DB::commit();

            return to_route('barang.index')->with('message', 'Data berhasil dirubah.');
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }

    public function destroy(Barang $barang)
    {
        DB::beginTransaction();
        try {
            $gambar = Storage::get($barang->gambar);
            if ($gambar) {
                Storage::delete($barang->gambar);
            }
            $barang->delete();
            DB::commit();

            return to_route('barang.index')->with('message', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }
}
