<?php

use App\Http\Controllers;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [Controllers\HomeController::class, 'home'])->name('home');

/* Sparepart Process PO */
Route::get('sparepart', [Controllers\HomeController::class, 'sparepart'])->name('sparepart')->middleware('per:landing sparepart index');
Route::get('sparepart/{sparepart}', [Controllers\HomeController::class, 'detailSparepart'])->name('detail-sparepart')->middleware('per:landing sparepart index');
Route::post('sparepart', [Controllers\HomeController::class, 'sparepartPost'])->name('sparepart.post')->middleware('per:landing sparepart index');
Route::get('sparepart-detail', [Controllers\HomeController::class, 'cart'])->name('sparepart.cart')->middleware('per:landing sparepart index');
Route::post('sparepart-detail', [Controllers\HomeController::class, 'cartpost'])->name('sparepart.cartpost')->middleware('per:landing sparepart index');
Route::delete('sparepart-delete/{cart}', [Controllers\HomeController::class, 'cartdelete'])->name('sparepart.cartdelete')->middleware('per:landing sparepart index');
Route::post('success-buying/{id}', [Controllers\HomeController::class, 'successBuying'])->name('success.buying')->middleware('per:landing sparepart index');

Route::middleware('auth', 'active')->group(function () {
    /* Dashboard */
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('per:dashboard');

    /* Permission */
    Route::get('permission', [Controllers\PermissionController::class, 'index'])->name('permission.index')->middleware('per:permission index');
    Route::get('permission/create', [Controllers\PermissionController::class, 'create'])->name('permission.create')->middleware('per:permission create');
    Route::post('permission', [Controllers\PermissionController::class, 'store'])->name('permission.store')->middleware('per:permission create');
    Route::delete('permission/{permission}', [Controllers\PermissionController::class, 'destroy'])->name('permission.destroy')->middleware('per:permission destroy');

    /* Role */
    Route::get('role', [Controllers\RoleController::class, 'index'])->name('role.index')->middleware('per:role index');
    Route::get('role/create', [Controllers\RoleController::class, 'create'])->name('role.create')->middleware('per:role create');
    Route::post('role', [Controllers\RoleController::class, 'store'])->name('role.store')->middleware('per:role create');
    Route::get('role/{role}', [Controllers\RoleController::class, 'show'])->name('role.show')->middleware('per:role index');
    Route::get('role/{role}/edit', [Controllers\RoleController::class, 'edit'])->name('role.edit')->middleware('per:role update');
    Route::put('role/{role}', [Controllers\RoleController::class, 'update'])->name('role.update')->middleware('per:role update');
    Route::delete('role/{role}', [Controllers\RoleController::class, 'destroy'])->name('role.destroy')->middleware('per:role destroy');

    /* Pengguna */
    Route::get('pengguna', [Controllers\PenggunaController::class, 'index'])->name('pengguna.index')->middleware('per:pengguna index');
    Route::get('pengguna/create', [Controllers\PenggunaController::class, 'create'])->name('pengguna.create')->middleware('per:pengguna create');
    Route::post('pengguna', [Controllers\PenggunaController::class, 'store'])->name('pengguna.store')->middleware('per:pengguna create');
    Route::get('pengguna/{pengguna}/edit', [Controllers\PenggunaController::class, 'edit'])->name('pengguna.edit')->middleware('per:pengguna update');
    Route::put('pengguna/{pengguna}', [Controllers\PenggunaController::class, 'update'])->name('pengguna.update')->middleware('per:pengguna update');
    Route::delete('pengguna/{pengguna}', [Controllers\PenggunaController::class, 'destroy'])->name('pengguna.destroy')->middleware('per:pengguna destroy');

    /* Kategori */
    Route::get('kategori', [Controllers\KategoriController::class, 'index'])->name('kategori.index')->middleware('per:kategori index');
    Route::get('kategori/create', [Controllers\KategoriController::class, 'create'])->name('kategori.create')->middleware('per:kategori create');
    Route::post('kategori', [Controllers\KategoriController::class, 'store'])->name('kategori.store')->middleware('per:kategori create');
    Route::get('kategori/{kategori}/edit', [Controllers\KategoriController::class, 'edit'])->name('kategori.edit')->middleware('per:kategori update');
    Route::put('kategori/{kategori}', [Controllers\KategoriController::class, 'update'])->name('kategori.update')->middleware('per:kategori update');
    Route::delete('kategori/{kategori}', [Controllers\KategoriController::class, 'destroy'])->name('kategori.destroy')->middleware('per:kategori destroy');

    /* Barang */
    Route::get('barang', [Controllers\BarangController::class, 'index'])->name('barang.index')->middleware('per:barang index');
    Route::get('barang/create', [Controllers\BarangController::class, 'create'])->name('barang.create')->middleware('per:barang create');
    Route::post('barang', [Controllers\BarangController::class, 'store'])->name('barang.store')->middleware('per:barang create');
    Route::get('barang/{barang}', [Controllers\BarangController::class, 'show'])->name('barang.show')->middleware('per:barang index');
    Route::get('barang/{barang}/edit', [Controllers\BarangController::class, 'edit'])->name('barang.edit')->middleware('per:barang update');
    Route::put('barang/{barang}', [Controllers\BarangController::class, 'update'])->name('barang.update')->middleware('per:barang update');
    Route::delete('barang/{barang}', [Controllers\BarangController::class, 'destroy'])->name('barang.destroy')->middleware('per:barang destroy');

    /* Pemesanan */
    Route::get('pemesanan', [Controllers\PemesananController::class, 'index'])->name('pemesanan.index')->middleware('per:pemesanan index');
    Route::get('pemesanan/create', [Controllers\PemesananController::class, 'create'])->name('pemesanan.create')->middleware('per:pemesanan create');
    Route::post('pemesanan', [Controllers\PemesananController::class, 'store'])->name('pemesanan.store')->middleware('per:pemesanan create');
    Route::get('pemesanan/{pemesanan}', [Controllers\PemesananController::class, 'show'])->name('pemesanan.show')->middleware('per:pemesanan index');
    Route::get('pemesanan/{pemesanan}/edit', [Controllers\PemesananController::class, 'edit'])->name('pemesanan.edit')->middleware('per:pemesanan update');
    Route::put('pemesanan/{pemesanan}', [Controllers\PemesananController::class, 'update'])->name('pemesanan.update')->middleware('per:pemesanan update');
    Route::delete('pemesanan/{pemesanan}', [Controllers\PemesananController::class, 'destroy'])->name('pemesanan.destroy')->middleware('per:pemesanan destroy');

    /* Pembelian */
    Route::get('pembelian', [Controllers\PembelianController::class, 'index'])->name('pembelian.index')->middleware('per:pembelian index');
    Route::get('pembelian/{pembelian}', [Controllers\PembelianController::class, 'show'])->name('pembelian.show')->middleware('per:pembelian index');
    Route::put('pembelian/{pembelian}', [Controllers\PembelianController::class, 'update'])->name('pembelian.update')->middleware('per:pembelian update');
    Route::delete('pembelian/{pembelian}', [Controllers\PembelianController::class, 'destroy'])->name('pembelian.destroy')->middleware('per:pembelian destroy');

    /* KonfirmasiPemesanan */
    Route::get('konfirmasi_pemesanan/{konfirmasi_pemesanan}/edit', [Controllers\KonfirmasiPemesananController::class, 'edit'])->name('konfirmasi_pemesanan.edit')->middleware('per:konfirmasi pemesanan update');
    Route::put('konfirmasi_pemesanan/{konfirmasi_pemesanan}', [Controllers\KonfirmasiPemesananController::class, 'update'])->name('konfirmasi_pemesanan.update')->middleware('per:konfirmasi pemesanan update');
    Route::delete('konfirmasi_pemesanan/{konfirmasi_pemesanan}', [Controllers\KonfirmasiPemesananController::class, 'destroy'])->name('konfirmasi_pemesanan.destroy')->middleware('per:konfirmasi pemesanan destroy');

    /* Servis */
    Route::get('servis', [Controllers\ServisController::class, 'index'])->name('servis.index')->middleware('per:servis index');
    Route::get('servis/{servis}', [Controllers\ServisController::class, 'show'])->name('servis.show')->middleware('per:servis index');
    Route::put('servis/{servis}', [Controllers\ServisController::class, 'update'])->name('servis.update')->middleware('per:servis update');
    Route::put('servis/finish/{servis}', [Controllers\ServisController::class, 'finish'])->name('servis.finish')->middleware('per:servis finish');
    Route::delete('servis/{servis}', [Controllers\ServisController::class, 'destroy'])->name('servis.destroy')->middleware('per:servis destroy');

    /* BarangMasuk */
    Route::get('barang_masuk', [Controllers\BarangMasukController::class, 'index'])->name('barang_masuk.index')->middleware('per:barang masuk index');
    Route::get('barang_masuk/create', [Controllers\BarangMasukController::class, 'create'])->name('barang_masuk.create')->middleware('per:barang masuk create');
    Route::post('barang_masuk', [Controllers\BarangMasukController::class, 'store'])->name('barang_masuk.store')->middleware('per:barang masuk create');
    Route::get('barang_masuk/{barang_masuk}/edit', [Controllers\BarangMasukController::class, 'edit'])->name('barang_masuk.edit')->middleware('per:barang masuk update');
    Route::put('barang_masuk/{barang_masuk}', [Controllers\BarangMasukController::class, 'update'])->name('barang_masuk.update')->middleware('per:barang masuk update');
    Route::delete('barang_masuk/{barang_masuk}', [Controllers\BarangMasukController::class, 'destroy'])->name('barang_masuk.destroy')->middleware('per:barang masuk destroy');

    /* Penjualan */
    Route::get('penjualan', [Controllers\PenjualanController::class, 'index'])->name('penjualan.index')->middleware('per:penjualan index');
    Route::get('penjualan/{penjualan}', [Controllers\PenjualanController::class, 'show'])->name('penjualan.show')->middleware('per:penjualan index');

    /* Pengaturan */
    Route::get('pengaturan', [Controllers\PengaturanController::class, 'index'])->name('pengaturan.index')->middleware('per:pengaturan index');
    Route::put('pengaturan/{pengaturan}', [Controllers\PengaturanController::class, 'update'])->name('pengaturan.update')->middleware('per:pengaturan update');

    /* Laporan Penjualan */
    Route::get('laporan-penjualan', [Controllers\LaporanController::class, 'penjualanIndex'])->name('laporan-penjualan')->middleware('per:laporan penjualan index');
    Route::post('laporan-penjualan', [Controllers\LaporanController::class, 'penjualanPost'])->name('laporan-penjualan')->middleware('per:laporan penjualan index');

    /* Laporan Penjualan */
    Route::get('laporan-barangmasuk', [Controllers\LaporanController::class, 'barangmasukIndex'])->name('laporan-barangmasuk')->middleware('per:laporan barangmasuk index');
    Route::post('laporan-barangmasuk', [Controllers\LaporanController::class, 'barangmasukPost'])->name('laporan-barangmasuk')->middleware('per:laporan barangmasuk index');
});

require __DIR__.'/auth.php';
