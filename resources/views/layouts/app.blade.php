<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kasir Santuy')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons"></script>
    <!-- Custom CSS -->
    <style>
        /* Sidebar styles */
        #sidebarMenu {
            height: 100vh; /* Full height sidebar */
            width: 250px; /* Sidebar width */
            background-color:rgb(27, 43, 58); /* Sidebar background color */
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1); /* Sidebar shadow */
            z-index: 1000;
            transition: all 0.3s ease; /* Smooth transition for sidebar */
        }

        .sidebar-header {
            text-align: center;
            padding: 15px;
            font-size: 1.5rem;
            font-weight: bold;
            color: #fff;
            border-bottom: 1px solid #34495e;
        }

        .sidebar-header i {
            margin-right: 10px;
        }

        .nav-item {
            margin-bottom: 10px;
        }

        .nav-box i {
            font-size: 20px; /* Ukuran ikon */
            margin-right: 15px; /* Jarak antara ikon dan teks */
        }

        .nav-link {
            color: #ecf0f1;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: #2980b9; /* Hover and active color */
            color: white;
        }

        .nav-box {
            display: flex;
            align-items: center;
        }

        .nav-box i {
            font-size: 20px; /* Ukuran ikon */
            margin-right: 15px; /* Jarak antara ikon dan teks */
        }

        .nav-text {
            font-size: 1.1rem;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
            padding: 10px;
        }

        .btn-light {
            background-color: #34495e;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-light:hover {
            background-color: #16a085; /* Hover color for logout button */
        }

        /* Main content styles */
        main {
            margin-left: 250px; /* Add margin for sidebar */
            padding: 20px;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            #sidebarMenu {
                width: 200px; /* Adjust sidebar width for smaller screens */
            }
            main {
                margin-left: 200px; /* Adjust content margin for smaller screens */
            }
        }

        @media (max-width: 576px) {
            #sidebarMenu {
                width: 100%; /* Sidebar becomes full width */
                position: relative;
            }
            main {
                margin-left: 0; /* Remove margin for small screens */
            }
        }

            /* Navbar dengan warna soft */
        .navbar-soft {
            background-color: #f0f8ff; /* Soft blue pastel (Alice Blue) */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Tambahkan bayangan */
        }

        .navbar-soft .navbar-brand,
        .navbar-soft .nav-link {
            color: #001f3f; /* Warna biru navy untuk teks */
        }

        .navbar-soft .nav-link:hover {
            color: #004080; /* Biru navy lebih terang saat hover */
        }

        /* Dropdown menu warna yang senada */
        .dropdown-menu {
            background-color: #f0f8ff; /* Sama dengan navbar */
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: #e0efff; /* Biru pastel lebih terang */
            color: #001f3f;
        }
    </style>
</head>
<body>
    <!-- Main Content -->
    <div id="content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-soft">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->nama }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Logout Form -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <!-- Sidebar -->
        <nav id="sidebarMenu" class="sidebar">
            <div class="sidebar-header">
                <h4><i data-feather="shopping-cart"></i> Kasir Santuy</h4>
            </div>

            <ul class="nav flex-column mt-4">
            <!-- Profile Link -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile.show') }}">
                    <div class="nav-box">
                        <i data-feather="user"></i> 
                        <span class="nav-text">Profil</span>
                    </div>
                </a>
            </li>
            <!-- Toko Link -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('toko.edit') ? 'active' : '' }}" href="{{ route('toko.edit') }}">
                    <div class="nav-box">
                        <i data-feather="globe"></i> 
                        <span class="nav-text">Toko</span>
                    </div>
                </a>
            </li>
            <!-- Dashboard Link -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <div class="nav-box">
                        <i data-feather="home"></i>
                        <span class="nav-text">Dashboard</span>
                    </div>
                </a>
            </li>
                <!-- Kelola Produk (Dropdown) -->
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between" data-bs-toggle="collapse" href="#kelolaProdukMenu" role="button" aria-expanded="false" aria-controls="kelolaProdukMenu" data-bs-auto-close="outside">
                        <div class="nav-box">
                            <i data-feather="package"></i>
                            <span class="nav-text">Kelola Produk</span>
                        </div>
                        <i data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="kelolaProdukMenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('produk.index') ? 'active' : '' }}" href="{{ route('produk.index') }}">
                                    <div class="nav-box">
                                        <i data-feather="box"></i>
                                        <span class="nav-text">Produk</span>
                                    </div>
                                </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kategori.index') ? 'active' : '' }}" href="{{ route('kategori.index') }}">
                            <div class="nav-box">
                                <i data-feather="grid"></i>
                                <span class="nav-text">Kategori</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('stok.index') ? 'active' : '' }}" href="{{ route('stok.index') }}">
                            <div class="nav-box">
                                <i data-feather="layers"></i>
                                <span class="nav-text">Manajemen Stok</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('diskon.index') ? 'active' : '' }}" href="{{ route('diskon.index') }}">
                            <div class="nav-box">
                                <i data-feather="percent"></i>
                                <span class="nav-text">Diskon</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- Data Staff Link -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('data_staff.index') ? 'active' : '' }}" href="{{ route('data_staff.index') }}">
                <div class="nav-box">
                    <i data-feather="users"></i>
                    <span class="nav-text">Data Staff</span>
                </div>
            </a>
        </li>
        <!-- Pelanggan Link -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('pelanggan.index') ? 'active' : '' }}" href="{{ route('pelanggan.index') }}">
                <div class="nav-box">
                    <i class="bi bi-people-fill"></i>
                    <span class="nav-text">Pelanggan</span>
                </div>
            </a>
        </li>
        <!-- Transaksi Link -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('transaksi.index') ? 'active' : '' }}" href="{{ route('transaksi.index') }}">
                <div class="nav-box">
                    <i data-feather="file-text"></i>
                    <span class="nav-text">Transaksi</span>
                </div>
            </a>
        </li>
        <!-- Laporan Link -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('laporan.index') ? 'active' : '' }}" href="{{ route('laporan.index') }}">
                <div class="nav-box">
                    <i data-feather="bar-chart"></i>
                    <span class="nav-text">Laporan</span>
                </div>
            </a>
        </li>
    </ul>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-light">
                <i data-feather="log-out"></i> Logout
            </button>
        </form>
    </div>
</nav>

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>
    </div>

    <!-- Feather Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        feather.replace();
    </script>
</body>
</html>
