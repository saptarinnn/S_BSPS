<header class="mb-5">
    <div class="header-top">
        <div class="container">
            <div class="logo text-logo" style="font-size: 1.3rem; font-weight: 500; font-style: italic">
                <a href="{{ route('home') }}" style="color: #25426F">
                    {{ $data->logo }}
                </a>
            </div>
            <div class="header-top-right">
                <div class="dropdown">
                    <a href="#" id="topbarUserDropdown"
                        class="user-dropdown d-flex align-items-center dropend dropdown-toggle "
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="text">
                            <h6 class="text-sm user-dropdown-name">{{ ucwords(auth()->user()->nama) }}</h6>
                            {{-- <p class="text-xs user-dropdown-status text-muted">{{ ucwords(auth()->user()->username) }}
                            </p> --}}
                            <p class="text-xs user-dropdown-status text-muted">
                                {{ ucwords(str_replace(['["', '"]'], '', auth()->user()->getRoleNames())) }}
                            </p>
                        </div>
                    </a>
                    <ul class="mt-2 text-sm shadow-lg dropdown-menu dropdown-menu-end" style="border-radius: 10px;">
                        <li><a class="text-sm dropdown-item fw-medium" href="{{ route('profile.edit') }}">Profil
                                Saya</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="text-sm dropdown-item fw-medium text-danger">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>

                <!-- Burger button responsive -->
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </div>
        </div>
    </div>
    <nav class="main-navbar">
        <div class="container">
            <ul>
                {{-- Dashboard --}}
                @can('dashboard')
                    <li class="menu-item ">
                        <a href="{{ route('dashboard') }}" class='text-sm menu-link'>
                            <span><i class="bi bi-grid-fill"></i> Dashboard</span>
                        </a>
                    </li>
                @endcan

                {{-- Pengguna --}}
                @canany(['permission index', 'role index', 'pengguna index'])
                    <li class="menu-item active has-sub">
                        <a href="#" class='text-sm menu-link'>
                            <span><i class="bi bi-people-fill"></i> Pengguna</span>
                        </a>
                        <div class="mt-2 submenu">
                            <div class="submenu-group-wrapper">
                                <ul class="submenu-group">
                                    @can('permission index')
                                        <li class="submenu-item ">
                                            <a href="{{ route('permission.index') }}"
                                                class='text-sm submenu-link'>Permission</a>
                                        </li>
                                    @endcan

                                    @can('role index')
                                        <li class="submenu-item ">
                                            <a href="{{ route('role.index') }}" class='text-sm submenu-link'>Role</a>
                                        </li>
                                    @endcan

                                    @can('pengguna index')
                                        <li class="submenu-item ">
                                            <a href="{{ route('pengguna.index') }}" class='text-sm submenu-link'>Pengguna</a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </div>
                    </li>
                @endcanany

                {{-- Data --}}
                @canany(['kategori index', 'barang index', 'pemesanan index', 'pembelian index'])
                    <li class="menu-item active has-sub">
                        <a href="#" class='text-sm menu-link'>
                            <span><i class="bi bi-collection-fill"></i> Data</span>
                        </a>
                        <div class="mt-2 submenu">
                            <div class="submenu-group-wrapper">
                                <ul class="submenu-group">
                                    @can('kategori index')
                                        <li class="submenu-item ">
                                            <a href="{{ route('kategori.index') }}" class='text-sm submenu-link'>Kategori</a>
                                        </li>
                                    @endcan

                                    @can('barang index')
                                        <li class="submenu-item ">
                                            <a href="{{ route('barang.index') }}" class='text-sm submenu-link'>Barang</a>
                                        </li>
                                    @endcan

                                    @can('pemesanan index')
                                        <li class="submenu-item ">
                                            <a href="{{ route('pemesanan.index') }}" class='text-sm submenu-link'>Pemesanan</a>
                                        </li>
                                    @endcan

                                    @can('pembelian index')
                                        <li class="submenu-item ">
                                            <a href="{{ route('pembelian.index') }}" class='text-sm submenu-link'>Pembelian</a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </div>
                    </li>
                @endcanany

                {{-- Transaksi --}}
                @canany(['barang masuk index', 'penjualan index', 'servis index'])
                    <li class="menu-item active has-sub">
                        <a href="#" class='text-sm menu-link'>
                            <span><i class="bi bi-cart-fill"></i> Transaksi</span>
                        </a>
                        <div class="mt-2 submenu">
                            <div class="submenu-group-wrapper">
                                <ul class="submenu-group">
                                    @can('barang masuk index')
                                        <li class="submenu-item ">
                                            <a href="{{ route('barang_masuk.index') }}" class='text-sm submenu-link'>Barang
                                                Masuk</a>
                                        </li>
                                    @endcan

                                    @can('penjualan index')
                                        <li class="submenu-item ">
                                            <a href="{{ route('penjualan.index') }}" class='text-sm submenu-link'>Penjualan</a>
                                        </li>
                                    @endcan

                                    @can('servis index')
                                        <li class="submenu-item ">
                                            <a href="{{ route('servis.index') }}" class='text-sm submenu-link'>Service</a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </div>
                    </li>
                @endcanany

                {{-- Pengaturan --}}
                @can('pengaturan index')
                    <li class="menu-item ">
                        <a href="{{ route('pengaturan.index') }}" class='text-sm menu-link'>
                            <span><i class="bi bi-gear-fill"></i> Pengaturan</span>
                        </a>
                    </li>
                @endcan

                {{-- Laporan --}}
                @canany(['laporan penjualan index', 'laporan barangmasuk index'])
                    <li class="menu-item active has-sub">
                        <a href="#" class='text-sm menu-link'>
                            <span><i class="bi bi-printer-fill"></i> Laporan</span>
                        </a>
                        <div class="mt-2 submenu">
                            <div class="submenu-group-wrapper">
                                <ul class="submenu-group">
                                    @can('laporan penjualan index')
                                        <li class="submenu-item ">
                                            <a href="{{ route('laporan-penjualan') }}"
                                                class='text-sm submenu-link'>Penjualan</a>
                                        </li>
                                    @endcan
                                    @can('laporan barangmasuk index')
                                        <li class="submenu-item ">
                                            <a href="{{ route('laporan-barangmasuk') }}" class='text-sm submenu-link'>Barang
                                                Masuk</a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </div>
                    </li>
                @endcanany

            </ul>
        </div>
    </nav>

</header>
