<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        return view('app.role.index', [
            'datas' => Role::get(['id', 'name']),
            'page_meta' => [
                'title' => 'Data Role',
            ],
        ]);
    }

    public function create()
    {
        return view('app.role.form', [
            'data' => new Role(),
            'permissions' => Permission::orderBy('name')->get(),
            'page_meta' => [
                'title' => 'Tambah Data Role',
                'url' => route('role.store'),
                'method' => 'post',
                'back' => route('role.index'),
            ],
        ]);
    }

    public function store(RoleRequest $request)
    {
        DB::beginTransaction();
        try {
            $role = Role::create(['name' => $request->name]);
            $role->syncPermissions($request->permission);
            DB::commit();

            return to_route('role.index')->with('message', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }

    public function show(Role $role)
    {
        return view('app.role.show', [
            'data' => $role,
            'page_meta' => [
                'title' => 'Detail Data Role',
                'back' => route('role.index'),
            ],
        ]);
    }

    public function edit(Role $role)
    {
        return view('app.role.form', [
            'data' => $role,
            'permissions' => Permission::orderBy('name')->get()->toArray(),
            'role_name' => $role->permissions->pluck('name')->toArray(),
            'page_meta' => [
                'title' => 'Ubah Data Role',
                'url' => route('role.update', $role->id),
                'method' => 'put',
                'back' => route('role.index'),
            ],
        ]);
    }

    public function update(RoleRequest $request, Role $role)
    {
        DB::beginTransaction();
        try {
            $role->update(['name' => $request->name]);
            $role->syncPermissions($request->permission);
            DB::commit();

            return to_route('role.index')->with('message', 'Data berhasil dirubah.');
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }

    public function destroy(Role $role)
    {
        DB::beginTransaction();
        try {
            $role->delete();
            DB::commit();

            return to_route('role.index')->with('message', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }
}
