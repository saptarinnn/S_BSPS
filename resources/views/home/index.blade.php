<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('home._head')
</head>

<body class="d-flex flex-column justify-content-center align-items-center bg-dark" style="min-height: 100vh">
    <main class="flex-shrink-0">
        <!-- Navigation-->
        @include('home._navigation')

        <!-- Header-->
        <header class="py-5 bg-dark">
            <div class="container px-5">
                <div class="row gx-5 align-items-center justify-content-center">
                    <div class="col-lg-8 col-xl-7 col-xxl-6">
                        <div class="my-5 text-center text-xl-start">
                            <small class="text-sm text-primary fw-semibold">Landing
                                Page</small>
                            <h1 class="mt-3 text-white display-6 fw-bolder">{{ $data->judul }}</h1>
                            <p class="mt-4 text-white-50 small">{{ $data->deskripsi }}</p>
                            <div class="gap-1 mt-4 d-grid d-sm-flex justify-content-sm-center justify-content-xl-start">
                                @can('landing booking index')
                                    <a class="px-3 btn-sm btn btn-primary me-sm-3"
                                        href="{{ route('pemesanan.index') }}">Booking
                                        Service</a>
                                @endcan
                                @can('landing sparepart index')
                                    <a class="px-3 btn-sm btn btn-outline-light" href="{{ route('sparepart') }}">Cari
                                        Sparepart</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="text-center col-xl-5 col-xxl-6 d-none d-xl-block">
                        <img class="my-5 img-fluid rounded-3" src="{{ Storage::url($data->gambar) }}" alt="..." />
                    </div>
                </div>
            </div>
        </header>
    </main>

</body>

</html>
