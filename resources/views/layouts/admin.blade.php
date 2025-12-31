<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg,#dff5ee,#e9ecff);
            overflow-x: hidden;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 260px;
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(12px);
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,.08);
            transition: transform .3s ease;
        }

        .sidebar h4 {
            color: #1dbf73;
            font-weight: 700;
            margin-bottom: 25px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-radius: 12px;
            margin-bottom: 10px;
            font-weight: 500;
            color: #333;
            transition: .3s;
            text-decoration: none;
        }

        .sidebar a i {
            margin-right: 12px;
            font-size: 18px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #1dbf73;
            color: #fff;
        }

        /* ===== CONTENT ===== */
        .content {
            flex: 1;
            padding: 20px;
        }

        /* ===== TOPBAR ===== */
        .topbar {
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(12px);
            border-radius: 16px;
            padding: 14px 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 10px 30px rgba(0,0,0,.08);
            margin-bottom: 20px;
        }

        .hamburger {
            font-size: 22px;
            cursor: pointer;
            display: none;
        }

        /* ===== MOBILE ===== */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100%;
                transform: translateX(-100%);
                z-index: 1000;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .hamburger {
                display: block;
            }
        }

        .overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.4);
            z-index: 900;
        }

        .overlay.show {
            display: block;
        }
    </style>

    @stack('styles')
</head>
<body>

<div class="admin-wrapper">

    {{-- SIDEBAR --}}
    <div class="sidebar" id="sidebar">
        <h4>Markaz Dimsum</h4>

        {{-- DASHBOARD --}}
        <a href="{{ route('admin.dashboard') }}"
           class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        {{-- PRODUK (LIST) --}}
        <a href="{{ route('admin.products.index') }}"
           class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Produk
        </a>

        {{-- TRANSAKSI --}}
        <a href="#">
            <i class="bi bi-receipt"></i> Transaksi
        </a>

        {{-- KASIR --}}
        <a href="#">
            <i class="bi bi-people"></i> Kasir
        </a>

        <form method="POST" action="{{ route('admin.logout') }}" class="mt-4">
            @csrf
            <button class="btn btn-danger btn-sm w-100 rounded-pill">
                Logout
            </button>
        </form>
    </div>

    {{-- OVERLAY --}}
    <div class="overlay" id="overlay"></div>

    {{-- CONTENT --}}
    <div class="content">
        <div class="topbar">
            <div class="d-flex align-items-center">
                <i class="bi bi-list hamburger mr-3" id="hamburger"></i>
                <strong>@yield('title')</strong>
            </div>
            <span class="text-muted">Admin</span>
        </div>

        @yield('content')
    </div>

</div>

<script>
    const hamburger = document.getElementById('hamburger');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    hamburger.addEventListener('click', () => {
        sidebar.classList.add('show');
        overlay.classList.add('show');
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
    });
</script>

</body>
</html>
