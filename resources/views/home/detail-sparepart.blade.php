<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('home._head')
</head>

<body>
    <main class="flex-shrink-0">

        <!-- Navigation-->
        @include('home._navigation')

        <!-- Product section-->
        <section class="py-5 mt-5">
            <div class="container px-4 my-5 px-lg-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6">
                        @if (Storage::get($barang->gambar))
                            <img class="mb-5 rounded card-img-top mb-md-0" style="height: 500px; object-fit: cover"
                                src="{{ Storage::url($barang->gambar) }}" alt="..." />
                        @else
                            <img class="mb-5 rounded card-img-top mb-md-0" style="height: 500px; object-fit: cover"
                                src="{{ asset('img/No-Image-Placeholder.svg.png') }}" alt="..." />
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="mb-1 small">{{ ucwords($barang->kategori->nama) }}</div>
                        <h1 class="display-5 fw-bolder">{{ ucwords($barang->nama) }}</h1>
                        <div class="mb-5 fs-5">
                            {{-- <span class="text-decoration-line-through">$45.00</span> --}}
                            <span>Rp {{ \Illuminate\Support\Number::format($barang->harga, locale: 'id') }}</span>
                        </div>
                        <p class="text-justify small fw-medium" style="line-height: 24px">
                            {{ ucwords($barang->deskripsi) }}</p>

                        <div class="gap-2 d-flex" data-barangid="{{ $barang->id }}"
                            data-barangnama="{{ $barang->nama }}">
                            {{-- <input class="text-center form-control me-3" id="inputQuantity" type="num"
                                    value="1" style="max-width: 3rem" /> --}}
                            @auth
                                <button class="flex-shrink-0 btn btn-dark btn-tambahkan" type="button">
                                    <i class="bi-cart-fill me-1"></i>
                                    Add to cart
                                </button>
                            @endauth
                            <a href="{{ route('sparepart') }}" class="btn btn-outline-dark">Kembali</a>
                        </div>
                    </div>
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
