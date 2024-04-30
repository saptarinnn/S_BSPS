<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('home._head')
</head>

<body>
    <main class="flex-shrink-0">

        <!-- Navigation-->
        @include('home._navigation')


        <section style="background-color: #eee; min-height: 100vh">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-10">

                        <div class="pt-5 mt-5 mb-4 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-medium text-secondary">Shopping Cart</h5>
                            <a href="{{ route('sparepart') }}">Kembali belanja</a>
                        </div>

                        @forelse ($carts as $cart)
                            <div class="mb-2 card rounded-3 cart-product">
                                <div class="p-3 card-body">
                                    <div class="row d-flex justify-content-between align-items-center">
                                        <div class="col-lg-3 col-12">
                                            @if (Storage::get($cart->barang->gambar))
                                                <img class="card-img img-fluid"
                                                    style="height: 150px; background-position: center; object-fit: cover"
                                                    src="{{ Storage::url($cart->barang->gambar) }}" alt="">
                                            @else
                                                <img class="card-img img-fluid"
                                                    style="height: 150px; background-position: center; object-fit: cover"
                                                    src="{{ asset('img/No-Image-Placeholder.svg.png') }}"
                                                    alt="">
                                            @endif
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <p class="mb-0 fw-semibold">{{ ucwords($cart->barang->nama) }}</p>
                                            <small class="text-muted">
                                                {{ ucwords($cart->barang->kategori->nama) }}</small>

                                            <div class="gap-2 d-flex align-items-center">
                                                <input min="1" name="quantity" value="{{ $cart->kuantitas }}"
                                                    data-barangid="{{ $cart->barang_id }}" type="number"
                                                    class="mt-3 mb-3 form-control form-control-sm form1"
                                                    style="width: 70px !important" />
                                                <small class="fw-semibold">Stock:
                                                    <span id="stokBarang">{{ $cart->barang->stok }}</span>
                                                </small>
                                            </div>

                                            <h6 class="mb-0">Rp
                                                {{ \Illuminate\Support\Number::format($cart->barang->harga, locale: 'id') }}
                                            </h6>
                                        </div>
                                        <div
                                            class="gap-2 col-lg-3 col-12 d-flex justify-content-end align-items-center">
                                            <h6 class="mb-0">Rp
                                                <span
                                                    class="total">{{ \Illuminate\Support\Number::format($cart->total, locale: 'id') }}</span>
                                            </h6>
                                            <span>|</span>
                                            <form action="{{ route('sparepart.cartdelete', $cart->id) }}"
                                                method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger btn-delete">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="bi bi-trash-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center fw-semibold small text-muted">Kantong Belanja Kosong, <a
                                    href="{{ route('sparepart') }}">silahkan belanja.</a></p>
                            <hr />
                        @endforelse

                        @if (count($carts) > 0)
                            <div class="mb-2 card">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <h6 class="p-0 m-0 fw-bold">Total Belanja</h6>
                                    <div class="fw-bolder">Rp
                                        <span
                                            id="totalPrice">{{ \Illuminate\Support\Number::format($total, locale: 'id') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('success.buying', auth()->user()->id) }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-8 col-12">
                                                <label class="col-form-label" for="first-name">Tgl. Pembayaran dan
                                                    Pengambilan Barang</label>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <input type="date" id="tglTransaksi"
                                                    class="@error('tglTransaksi') is-invalid @enderror  form-control text-sm"
                                                    name="tglTransaksi" value="{{ old('tglTransaksi') }}" required />
                                                @error('tglTransaksi')
                                                    <small class="mt-1 text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mt-3 d-grid">
                                            <button class="btn btn-dark btn-sm" type="submit">Konfirmasi
                                                Pemesanan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </section>
    </main>

    <script type="module">
        $('.form1').each(function(i, obj) {
            $(this).change(function(e) {
                e.preventDefault();
                let data = new FormData();
                data.append("barangid", $(this).data('barangid'));
                data.append("value", $(this).val());

                $.ajax({
                    url: `${window.origin}/sparepart-detail`,
                    type: "POST",
                    data: data,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            if (response.change > 0) {
                                let result = 0;
                                let carts = response.carts; // get carts data from database
                                let cartCount = parseInt(document.querySelector('.cart-count')
                                    .innerHTML); // get data cart count
                                let cartCountNew = (cartCount - parseInt(response.value)) +
                                    parseInt(response
                                        .change); // cart count new after change input
                                document.querySelector('.cart-count').innerHTML =
                                    cartCountNew; // set new cart count
                                $('.total').eq(i).html(new Intl.NumberFormat('en-DE')
                                    .format(response.data.total)
                                ); // set price total from product

                                carts.forEach(element => {
                                    result += element
                                        .total; // set all total price product
                                });

                                $('#totalPrice').html(new Intl.NumberFormat('en-DE')
                                    .format(result)); // set all total price product
                                $('#stokBarang').html(response.stock); // update stock
                            } else {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 4000,
                                    timerProgressBar: true,
                                });
                                Toast.fire({
                                    icon: "warning",
                                    title: "Wajib memasukkan kuantitas minimal 1",
                                });
                                $('.form1').eq(i).val(response.value);
                            }
                        } else {
                            const Toast1 = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 4000,
                                timerProgressBar: true,
                            });
                            Toast1.fire({
                                icon: "warning",
                                title: "Input melebihi stok barang",
                            });
                            $('.form1').eq(i).val(response.count);
                        }
                    },
                });
            });
        });
    </script>

    <x-app.alert.confirm />

    @if (session('message'))
        <x-app.alert.success />
    @endif
</body>

</html>
