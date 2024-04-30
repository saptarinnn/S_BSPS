<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarangMasukRequest;
use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
    public function index()
    {
        return view('app.barang_masuk.index', [
            'datas' => BarangMasuk::with('barang')->get(),
            'page_meta' => [
                'title' => 'Data Barang Masuk',
            ],
        ]);
    }

    public function create()
    {
        return view('app.barang_masuk.form', [
            'data' => new BarangMasuk(),
            'barangs' => Barang::get(),
            'page_meta' => [
                'title' => 'Tambah Data Barang Masuk',
                'url' => route('barang_masuk.store'),
                'method' => 'post',
                'back' => route('barang_masuk.index'),
            ],
        ]);
    }

    public function store(BarangMasukRequest $request)
    {
        DB::beginTransaction();
        try {
            $barangMasuk = BarangMasuk::create($request->validated());
            $barang = Barang::find($barangMasuk->barang_id);
            $stok = intval($barangMasuk->jumlah) + intval($barang->stok);
            $barang->update([
                'stok' => $stok,
            ]);
            DB::commit();

            return to_route('barang_masuk.index')->with('message', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }

    public function edit(BarangMasuk $barang_masuk)
    {
        return view('app.barang_masuk.form', [
            'data' => $barang_masuk,
            'barangs' => Barang::get(),
            'page_meta' => [
                'title' => 'Ubah Data Barang Masuk',
                'url' => route('barang_masuk.update', $barang_masuk),
                'method' => 'put',
                'back' => route('barang_masuk.index'),
            ],
        ]);
    }

    public function update(BarangMasukRequest $request, BarangMasuk $barang_masuk)
    {
        DB::beginTransaction();
        try {
            $barang = Barang::find($barang_masuk->barang_id);
            $stock_old = $barang->stok - $barang_masuk->jumlah;
            $barang_masuk->update($request->validated());
            $stok = intval($barang_masuk->jumlah) + intval($stock_old);
            $barang->update([
                'stok' => $stok,
            ]);

            DB::commit();

            return to_route('barang_masuk.index')->with('message', 'Data berhasil dirubah.');
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }

    public function destroy(BarangMasuk $barang_masuk)
    {
        DB::beginTransaction();
        try {
            $barang = Barang::find($barang_masuk->barang_id);
            $stok = intval($barang->stok) - intval($barang_masuk->jumlah);
            if ($stok < 0) {
                $stok = 0;
            }
            $barang->update([
                'stok' => $stok,
            ]);
            $barang_masuk->delete();
            DB::commit();

            return to_route('barang_masuk.index')->with('message', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }
}
