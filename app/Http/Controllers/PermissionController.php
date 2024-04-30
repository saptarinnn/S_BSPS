<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function index()
    {
        return view('app.permission.index', [
            'datas' => Permission::get(['id', 'name']),
            'page_meta' => [
                'title' => 'Data Permission',
            ],
        ]);
    }

    public function create()
    {
        return view('app.permission.form', [
            'data' => new Permission(),
            'page_meta' => [
                'title' => 'Tambah Data Permission',
                'url' => route('permission.store'),
                'method' => 'post',
                'back' => route('permission.index'),
            ],
        ]);
    }

    public function store(PermissionRequest $request)
    {

        for ($i = 0; $i < count($request->listPermission); $i++) {
            if (Permission::whereName($request->name.' '.$request->listPermission[$i])->first()) {
                return to_route('permission.create')->with('error', 'Terdapat permission yang telah terdaftar.');
            }
        }

        DB::beginTransaction();
        try {
            for ($i = 0; $i < count($request->listPermission); $i++) {
                Permission::create(['name' => $request->name.' '.$request->listPermission[$i]]);
            }
            DB::commit();

            return to_route('permission.index')->with('message', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }

    public function destroy(Permission $permission)
    {
        DB::beginTransaction();
        try {
            $permission->delete();
            DB::commit();

            return to_route('permission.index')->with('message', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }
}
