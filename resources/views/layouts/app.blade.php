<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard') - BengkelKu</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --sidebar: #164E56;
            --sidebar-hover: #21636B;
            --primary: #0F8790;
            --primary-hover: #116B72;
            --cream: #FAF8F3;
            --cream-accent: #F3DDB5;
            --white: #FFFFFF;
            --text: #29434A;
            --muted: #84948D;
            --border: #EAE5D9;
            --danger: #D9534F;
            --warning: #D69B42;
            --success: #27845D;
            --shadow: 0 4px 15px rgba(22, 78, 86, 0.06);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--cream);
            color: var(--text);
        }

        /* SIDEBAR */

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 255px;
            height: 100vh;
            background: var(--sidebar);
            padding: 28px 18px;
            color: var(--white);
            overflow-y: auto;
            z-index: 100;
        }

        .brand {
            font-size: 23px;
            font-weight: 800;
            margin-bottom: 7px;
            letter-spacing: -0.8px;
        }

        .brand span {
            color: var(--cream-accent);
        }

        .subtitle {
            font-size: 10px;
            color: #B9D1D0;
            letter-spacing: 1px;
            margin-bottom: 38px;
        }

        .menu-title {
            font-size: 10px;
            font-weight: 700;
            color: #A7C4C3;
            margin: 23px 12px 12px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px 14px;
            margin-bottom: 7px;
            color: #D9E8E6;
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
            border-radius: 9px;
            transition: .2s;
        }

        .menu a:hover {
            background: var(--sidebar-hover);
            color: var(--white);
        }

        .menu a.active {
            background: var(--primary);
            color: var(--white);
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        }

        .menu i {
            width: 19px;
            text-align: center;
            font-size: 15px;
        }

        /* MAIN CONTENT */

        .main {
            margin-left: 255px;
            padding: 30px 35px;
            min-height: 100vh;
        }

        /* HEADER */

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            gap: 15px;
        }

        .topbar h2 {
            font-size: 22px;
            font-weight: 800;
            color: var(--sidebar);
        }

        .topbar p {
            font-size: 12px;
            color: var(--muted);
            margin-top: 6px;
        }

        .admin {
            background: var(--white);
            padding: 11px 17px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
            color: var(--sidebar);
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            white-space: nowrap;
        }

        .admin i {
            color: var(--primary);
            margin-right: 6px;
        }

        .content {
            width: 100%;
        }

        /* CARD DAN FORM UMUM */

        .content-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 23px;
            box-shadow: var(--shadow);
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 11px 13px;
            border: 1px solid var(--border);
            border-radius: 9px;
            background: var(--white);
            color: var(--text);
            font-family: inherit;
            font-size: 12px;
            outline: none;
            transition: .2s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(15,135,144,0.10);
        }

        /* TOMBOL */

        .btn-primary {
            background: var(--primary);
            color: var(--white);
            border: none;
            padding: 11px 18px;
            border-radius: 9px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: .2s;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
        }

        .btn-warning {
            background: var(--warning);
            color: var(--white);
        }

        .btn-danger {
            background: var(--danger);
            color: var(--white);
        }

        /* TABEL */

        table {
            width: 100%;
            border-collapse: collapse;
            background: var(--white);
        }

        table th {
            background: #EAF3F1;
            color: var(--sidebar);
            font-size: 12px;
            font-weight: 700;
            padding: 14px;
            text-align: left;
        }

        table td {
            padding: 14px;
            border-bottom: 1px solid var(--border);
            font-size: 12px;
            color: var(--text);
        }

        table tr:hover td {
            background: #FCFBF8;
        }

        /* RESPONSIVE */

        @media(max-width: 800px) {
            .sidebar {
                width: 75px;
                padding: 20px 10px;
            }

            .brand {
                font-size: 12px;
            }

            .subtitle,
            .menu-title,
            .menu a span {
                display: none;
            }

            .menu a {
                justify-content: center;
                padding: 14px 8px;
            }

            .menu i {
                font-size: 17px;
            }

            .main {
                margin-left: 75px;
                padding: 22px 17px;
            }
        }

        @media(max-width: 500px) {
            .topbar {
                align-items: flex-start;
            }

            .topbar h2 {
                font-size: 18px;
            }

            .admin {
                font-size: 10px;
                padding: 9px;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="brand">
            Bengkel<span>Ku.</span>
        </div>

        <div class="subtitle">
            SISTEM INFORMASI SERVICE MOTOR
        </div>

        <nav class="menu">

            <div class="menu-title">Menu Utama</div>

            <a href="{{ url('/') }}"
               class="{{ request()->is('/') ? 'active' : '' }}">
                <i class="fas fa-house"></i>
                <span>Dashboard</span>
            </a>

            <div class="menu-title">Data Master</div>

            <a href="{{ route('pelanggan.index') }}"
               class="{{ request()->routeIs('pelanggan.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Data Pelanggan</span>
            </a>

            <a href="{{ route('kendaraan.index') }}"
               class="{{ request()->routeIs('kendaraan.*') ? 'active' : '' }}">
                <i class="fas fa-motorcycle"></i>
                <span>Data Kendaraan</span>
            </a>

            <div class="menu-title">Transaksi Service</div>

            <a href="{{ route('daftar-service.index') }}"
               class="{{ request()->routeIs('daftar-service.*') ? 'active' : '' }}">
                <i class="fas fa-clipboard-list"></i>
                <span>Daftar Service</span>
            </a>

            <a href="{{ route('data-service.index') }}"
               class="{{ request()->routeIs('data-service.*') ? 'active' : '' }}">
                <i class="fas fa-screwdriver-wrench"></i>
                <span>Data Service</span>
            </a>

            <a href="{{ route('pembayaran-service.index') }}"
               class="{{ request()->routeIs('pembayaran-service.*') ? 'active' : '' }}">
                <i class="fas fa-money-bill-wave"></i>
                <span>Pembayaran Service</span>
            </a>

        </nav>
    </aside>

    <!-- MAIN -->
    <main class="main">

        <header class="topbar">

            <div>
                <h2>@yield('heading', 'Dashboard')</h2>
                <p>Sistem Informasi Pengelolaan Service Motor</p>
            </div>

            <div class="admin">
                <i class="fas fa-user-circle"></i>
                Administrator
            </div>

        </header>

        <section class="content">
            @yield('content')
        </section>

    </main>

</body>
</html>