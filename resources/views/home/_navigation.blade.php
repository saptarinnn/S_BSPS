<nav class="py-3 navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
    <div class="container px-5">

        <div class="logo text-logo" style="font-size: 1.6rem; font-weight: 500; font-style: italic">
            <a href="{{ route('home') }}" class="text-light nav-link">{{ $data->logo }}</a>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @auth
                <ul class="mb-2 navbar-nav ms-auto mb-lg-0">
                    <li class="mx-1 nav-item"><a class="nav-link"
                            href="{{ route('dashboard') }}">{{ ucwords(auth()->user()->nama) }}</a></li>
                    @can('landing sparepart index')
                        <li class="mx-1 nav-item">
                            <div class="d-flex">
                                <a href="{{ route('sparepart.cart') }}" class="btn btn-outline-light">
                                    Cart
                                    <span
                                        class="badge bg-light text-dark ms-1 rounded-pill cart-count">{{ $cart }}</span>
                                </a>
                            </div>
                        </li>
                    @endcan
                </ul>
            @else
                <ul class="mb-2 navbar-nav ms-auto mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                </ul>
            @endauth
        </div>
    </div>
</nav>
