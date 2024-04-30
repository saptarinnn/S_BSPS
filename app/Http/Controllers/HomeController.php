<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Cart;
use App\Models\DetailTransaksi;
use App\Models\Pengaturan;
use App\Models\Transaksi;
use App\Traits\SendNotificationWithWhatsapp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    use SendNotificationWithWhatsapp;

    protected $pengatruan;

    public function __construct()
    {
        $this->pengatruan = Pengaturan::select(['id', 'logo', 'judul', 'deskripsi', 'gambar'])->first();
    }

    public function home()
    {
        $cart = 0;

        if (auth()->user()) {
            $carts = Cart::where('customer_id', auth()->user()->id)->get();
            foreach ($carts as $value) {
                $cart += $value->kuantitas;
            }
        }

        return view('home.index', [
            'data' => $this->pengatruan,
            'cart' => $cart,
        ]);
    }

    public function sparepart()
    {
        $cart = 0;
        if (auth()->user()) {
            $carts = Cart::where('customer_id', auth()->user()->id)->get();
            foreach ($carts as $value) {
                $cart += $value->kuantitas;
            }
        }

        return view('home.sparepart', [
            'data' => $this->pengatruan,
            'barangs' => Barang::where('stok', '>', 0)->paginate(8),
            'cart' => $cart,
        ]);
    }

    public function detailSparepart($id)
    {
        $cart = 0;
        $barang = Barang::findOrFail($id);

        if (auth()->user()) {
            $carts = Cart::where('customer_id', auth()->user()->id)->get();
            foreach ($carts as $value) {
                $cart += $value->kuantitas;
            }
        }

        return view('home.detail-sparepart', [
            'data' => $this->pengatruan,
            'barang' => $barang,
            'cart' => $cart,
        ]);
    }

    public function sparepartPost(Request $request)
    {
        $barang = Barang::find($request->barangid);
        $cart = Cart::where('barang_id', $request->barangid)->where('customer_id', auth()->user()->id)->first();

        if ($cart) {
            if ($barang->stok == $cart->kuantitas) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cart melebihi stock barang yang ada!',
                ]);
            }
        }

        DB::beginTransaction();
        try {
            if (! $cart) {
                Cart::create([
                    'customer_id' => auth()->user()->id,
                    'barang_id' => $request->barangid,
                    'kuantitas' => 1,
                    'total' => $barang->harga,
                ]);
            } else {
                $kuantitas = $cart->kuantitas + 1;
                $cart->update([
                    'kuantitas' => $kuantitas,
                    'total' => $barang->harga * $kuantitas,
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data produk berhasil disimpan!',
            ]);
        } catch (\Exception $e) {
            throw $e;
            DB::rollback();
        }
    }

    public function cart()
    {
        $cart = 0;
        $total = 0;

        $carts = Cart::where('customer_id', auth()->user()->id)->get();
        foreach ($carts as $value) {
            $cart += $value->kuantitas;
            $total += $value->total;
        }

        return view('home.cart-sparepart', [
            'data' => $this->pengatruan,
            'cart' => $cart,
            'total' => $total,
            'carts' => $carts,
        ]);
    }

    public function cartpost(Request $request)
    {
        $barang = Barang::find($request->barangid);
        $cart = Cart::where('barang_id', $request->barangid)->where('customer_id', auth()->user()->id)->first();
        $kuantitas = $cart->kuantitas;

        if ($request->value > $kuantitas) {
            if ($barang->stok == $cart->kuantitas) {
                return response()->json([
                    'success' => false,
                    'count' => $kuantitas,
                    'message' => 'Stok barang tidak cukup!',
                ]);
            }
        }

        DB::beginTransaction();
        try {
            if ($request->value > 0) {
                $cart->update([
                    'kuantitas' => $request->value,
                    'total' => $barang->harga * $request->value,
                ]);
            }
            DB::commit();

            $carts = Cart::where('customer_id', auth()->user()->id)->get();

            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Disimpan!',
                'data' => $cart,
                'value' => $kuantitas,
                'change' => $request->value,
                'barang' => $barang,
                'carts' => $carts->toArray(),
                'stock' => $barang->stok,
            ]);
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }

    public function cartdelete(Cart $cart)
    {
        DB::beginTransaction();
        try {
            $cart->delete();
            DB::commit();

            return back()->with('message', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            throw $e;
            DB::rollback();
        }
    }

    public function successBuying(Request $request, $id)
    {
        $validated = $request->validate([
            'tglTransaksi' => ['required', 'date'],
        ]);

        $carts = Cart::where('customer_id', $id)->get();
        $kodeUnik = Str::random('6');
        if ($carts->toArray() == null) {
            return to_route('home');
        }
        DB::beginTransaction();
        try {
            $transaksi = Transaksi::create([
                'customer_id' => auth()->user()->id,
                'kode_unik' => $kodeUnik,
                'tgl_transaksi' => $request->tglTransaksi,
                'status_transaksi' => '0',
                'keterangan' => 'pemesanan berhasil, silahkan datang pada tanggal pemesanan untuk melakukan pembayaran dan pengambilan barang.',
            ]);

            foreach ($carts as $cart) {
                DetailTransaksi::create([
                    'barang_id' => $cart->barang_id,
                    'transaksi_id' => $transaksi->id,
                    'jumlah_pembelian' => $cart->kuantitas,
                    'sub_total' => $cart->total,
                ]);

                $barang = Barang::find($cart->barang_id);
                $barang->update([
                    'stok' => $barang->stok - $cart->kuantitas,
                ]);

                $cart->delete();
            }

            DB::commit();

            $this->send($transaksi->customer->no_hp, 'Pemesanan berhasil, silahkan datang pada tanggal '.$transaksi->tgl_transaksi->format('d F Y').' untuk melakukan pembayaran dan pengambilan barang. Kode unik : '.$transaksi->kode_unik.', silahkan liatkan kode kepada admin');

            return view('home.success', [
                'data' => $validated,
                'transaksi' => $transaksi,
            ]);
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }
}
