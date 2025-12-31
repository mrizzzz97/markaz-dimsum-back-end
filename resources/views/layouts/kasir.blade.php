<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard Kasir')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #e8f7f3, #eef4ff);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: #ffffff;
            border-right: 1px solid #eee;
            padding: 20px;
            transition: all .3s ease;
        }

        .sidebar h4 {
            font-weight: 700;
            color: #20c997;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            margin-bottom: 8px;
            color: #333;
            text-decoration: none;
            border-radius: 10px;
            transition: all .2s ease;
            font-weight: 500;
        }

        .sidebar a:hover {
            background: #e6f7f1;
            color: #20c997;
        }

        .sidebar a.active {
            background: #20c997;
            color: #fff;
        }

        /* ===== CONTENT ===== */
        .content {
            padding: 25px;
            width: 100%;
        }

        .topbar {
            background: #fff;
            padding: 14px 20px;
            border-radius: 14px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 8px 20px rgba(0,0,0,.05);
        }

        .card-soft {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }

        /* ===== MOBILE ===== */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -260px;
                top: 0;
                z-index: 1000;
            }

            .sidebar.show {
                left: 0;
            }

            .content {
                padding: 15px;
            }

            .mobile-toggle {
                display: inline-block;
            }
        }

        @media (min-width: 769px) {
            .mobile-toggle {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="d-flex">

    {{-- SIDEBAR --}}
    <div class="sidebar" id="sidebar">
        <h4>Markaz Dimsum</h4>

        <a href="{{ route('kasir.dashboard') }}"
           class="{{ request()->routeIs('kasir.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i>
            Dashboard
        </a>

        <a href="{{ route('kasir.transaksi.index') }}"
           class="{{ request()->routeIs('kasir.transaksi.*') ? 'active' : '' }}">
            <i class="bi bi-receipt"></i>
            Transaksi
        </a>

        <form action="{{ route('logout') }}" method="POST" class="mt-4">
            @csrf
            <button class="btn btn-danger w-100 rounded-pill">
                Logout
            </button>
        </form>
    </div>

    {{-- CONTENT --}}
    <div class="content flex-fill">

        <div class="topbar">
            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-outline-success mobile-toggle"
                        onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>

                <strong>@yield('title')</strong>
            </div>

            <small class="text-muted">
                Kasir :
                <strong>{{ auth()->user()->name ?? 'Kasir' }}</strong>
            </small>
        </div>

        @yield('content')

    </div>
</div>

{{-- JS --}}
<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('show');
    }
</script>

</body>
</html>
