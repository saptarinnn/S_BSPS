<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('home._head')
</head>

<body>
    <main class="flex-shrink-0">

        <!-- Navigation-->
        @include('home._navigation')

        <!-- Header-->
        <header class="py-5 bg-dark">
            <div class="container px-4 py-5 my-5 px-lg-5">
                <div class="text-center text-white">
                    <h1 class="py-2 display-5 fw-bold">Sparepart Mobil</h1>
                    <p class="mb-0 fw-light text-white-50">Kumpulan Sparepart Mobil, silahkan masuk untuk
                        melakukan transaksi.</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    @forelse ($barangs as $barang)
                        <div class="mb-3 card">
                            <div class="row">
                                <div class="p-0 col-md-4">
                                    @if (Storage::get($barang->gambar))
                                        <img class="card-img img-fluid"
                                            style="max-height: 200px; height: 100%; background-position: center; object-fit: cover"
                                            src="{{ Storage::url($barang->gambar) }}" alt="">
                                    @else
                                        <img class="card-img img-fluid"
                                            style="max-height: 200px; height: 100%; background-position: center; object-fit: cover"
                                            src="{{ asset('img/No-Image-Placeholder.svg.png') }}" alt="">
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <span class="fw-semibold small"
                                            style="color: #bebebe; letter-spacing: 1.4px; font-size: 12px">{{ strtoupper($barang->kategori->nama) }}</span>
                                        <h5 class="card-title font-bolder">{{ ucwords($barang->nama) }}</h5>
                                        <p class="card-text text-truncate">{{ ucwords($barang->deskripsi) }}</p>
                                        <div class="gap-3 mb-3 d-flex align-items-center">
                                            <p class="card-text fw-bolder">Rp
                                                {{ \Illuminate\Support\Number::format($barang->harga, locale: 'id') }}
                                            </p>
                                            <small>Stock {{ $barang->stok }}</small>
                                        </div>
                                        <div class="gap-2 d-flex" data-barangid="{{ $barang->id }}"
                                            data-barangnama="{{ $barang->nama }}">
                                            <a class="btn btn-outline-dark btn-sm"
                                                href="{{ route('detail-sparepart', $barang->id) }}">Detail</a>
                                            @auth
                                                <button type="button" class="btn btn-sm btn-dark btn-tambahkan">Add to
                                                    cart</button>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="d-flex justify-content-center">
                            <p class="font-semibold text-secondary">Data sparepart tidak tersedia.</p>
                            <hr />
                        </div>
                    @endforelse
                    {{ $barangs->links() }}
                </div>
            </div>
        </section>

    </main>

    <script type="module">
        let products = [];
        let btnTambahkan = document.querySelectorAll('.btn-tambahkan');
        let cartCount = parseInt(document.querySelector('.cart-count').innerHTML);
        btnTambahkan.forEach(el => {
            el.addEventListener('click', function(el) {
                const barangId = this.parentElement.getAttribute('data-barangid');
                let data = new FormData();
                data.append("barangid", barangId);

                $.ajax({
                    url: `${window.origin}/sparepart`,
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
                            cartCount = isNaN(cartCount) ? 0 : cartCount;
                            cartCount++;
                            document.querySelector('.cart-count').innerHTML = cartCount;
                        } else {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 4000,
                                timerProgressBar: true,
                            });
                            Toast.fire({
                                icon: "error",
                                title: response.message,
                            });
                        }
                    },
                });

            });
        });
    </script>
</body>

</html>
