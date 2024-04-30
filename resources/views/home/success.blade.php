<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('home._head')
</head>

<body class="d-flex flex-column justify-content-center align-items-center bg-dark" style="min-height: 100vh">
    <main class="flex-shrink-0">
        <!-- Header-->
        <header class="py-5 bg-dark">
            <div class="container px-5">
                <div class="row gx-5 align-items-center justify-content-center">
                    <div class="col-12">
                        <div class="text-center text-light">
                            <img class="img-error" src="{{ asset('img/order-confirmed-1-76.svg') }}"
                                alt="Order Confirmed" width="250">
                            <h1 class="mb-5">Pemesanan Berhasil.</h1>
                            <h5 class="fw-normal">Kode Pemesanan anda adalah <strong
                                    class="fw-bolder">{{ $transaksi->kode_unik }}</strong></h5>
                            <p class="text-secondary">Silahkan datang ke toko dengan menunjuukan kode
                                pemesanan
                                <br />
                                untuk membayar dan
                                mengambil barang yang telah dipesan.
                            </p>
                            <p class="mt-5">Tanggal Pengambilan Barang :
                                {{ date('d F Y', strtotime($data['tglTransaksi'])) }}</p>
                            <a href="{{ route('home') }}" class="btn btn-success">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </main>

</body>

</html>
