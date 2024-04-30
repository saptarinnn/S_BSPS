<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use App\Models\Pengguna;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $per = [
            'dashboard',
            'permission index', 'permission create', 'permission destroy',
            'role index', 'role create', 'role update', 'role destroy',
            'pengguna index', 'pengguna create', 'pengguna update', 'pengguna destroy',
            'kategori index', 'kategori create', 'kategori update', 'kategori destroy',
            'barang index', 'barang create', 'barang update', 'barang destroy',
            'pemesanan index', 'pemesanan create', 'pemesanan update', 'pemesanan destroy',
            'pembelian index', 'pembelian update', 'pembelian destroy',
            'konfirmasi pemesanan update', 'konfirmasi pemesanan destroy',
            'servis index', 'servis update', 'servis destroy', 'servis finish',
            'barang masuk index', 'barang masuk create', 'barang masuk update', 'barang masuk destroy',
            'penjualan index',
            'pengaturan index', 'pengaturan update',
            'laporan penjualan index',
            'laporan barangmasuk index',
        ];
        for ($i = 0; $i < count($per); $i++) {
            Permission::create([
                'name' => $per[$i],
            ]);
        }
        $role = Role::create(['name' => 'admin service']);
        $role = Role::create(['name' => 'admin sperpart']);
        $role = Role::create(['name' => 'branch manager']);
        $role = Role::create(['name' => 'customer']);
        $role = Role::create(['name' => 'mekanik']);
        $role = Role::create(['name' => 'superadmin']);
        $role->syncPermissions(Permission::all());
        $data = Pengguna::create([
            'nama' => 'superadmin',
            'no_hp' => '01',
            'username' => 'admin',
            'password' => bcrypt('qweasd123#'),
            'login_terakhir' => now(),
            'aktif' => '1',
        ]);
        $data->assignRole('superadmin');
        $customer = Pengguna::create([
            'nama' => 'customer',
            'no_hp' => '02',
            'username' => 'customer',
            'password' => bcrypt('qweasd123#'),
            'login_terakhir' => now(),
            'aktif' => '1',
        ]);
        $customer->assignRole('customer');
        $mekanik = Pengguna::create([
            'nama' => 'mekanik',
            'no_hp' => '03',
            'username' => 'mekanik',
            'password' => bcrypt('qweasd123#'),
            'login_terakhir' => now(),
            'aktif' => '1',
        ]);
        $mekanik->assignRole('mekanik');

        Pengaturan::create([
            'logo' => 'B S P S Mobil',
            'judul' => 'Booking Service dan Penjualan Sparepart Mobil',
            'deskripsi' => 'Booking Service dan Penjualan Sparepart Mobil merupakan sebuah website yang dibangun untuk melakukan booking service pada ..., selain melakukan booking service dapat pula melakukan pembelian sparepart mobil berbagai macam brand.',
            'gambar' => null,
        ]);
    }
}
