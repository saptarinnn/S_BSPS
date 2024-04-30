<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenggunaRequest;
use App\Models\Pengguna;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class PenggunaController extends Controller
{
    public function index()
    {
        return view('app.pengguna.index', [
            'datas' => Pengguna::get(['id', 'nama', 'no_hp', 'username', 'login_terakhir', 'aktif']),
            'page_meta' => [
                'title' => 'Data Pengguna',
            ],
        ]);
    }

    public function create()
    {
        return view('app.pengguna.form', [
            'data' => new Pengguna(),
            'roles' => Role::get(['id', 'name']),
            'page_meta' => [
                'title' => 'Tambah Data Pengguna',
                'url' => route('pengguna.store'),
                'method' => 'post',
                'back' => route('pengguna.index'),
            ],
        ]);
    }

    public function store(PenggunaRequest $request)
    {
        DB::beginTransaction();
        try {
            $pengguna = Pengguna::create($request->validated());
            $pengguna->assignRole($request->role);
            DB::commit();

            return to_route('pengguna.index')->with('message', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }

    public function edit(Pengguna $pengguna)
    {
        return view('app.pengguna.form', [
            'data' => $pengguna,
            'roles' => Role::get(['id', 'name']),
            'page_meta' => [
                'title' => 'Ubah Data Pengguna',
                'url' => route('pengguna.update', $pengguna->id),
                'method' => 'put',
                'back' => route('pengguna.index'),
            ],
        ]);
    }

    public function update(PenggunaRequest $request, Pengguna $pengguna)
    {
        DB::beginTransaction();
        try {
            $pengguna->update([
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'username' => $request->username,
                'aktif' => $request->aktif,
                'password' => $pengguna->password,
            ]);
            $pengguna->syncRoles($request->role);
            DB::commit();

            return to_route('pengguna.index')->with('message', 'Data berhasil dirubah.');
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }

    public function destroy(Pengguna $pengguna)
    {
        DB::beginTransaction();
        try {
            $pengguna->delete();
            DB::commit();

            return to_route('pengguna.index')->with('message', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }
}
