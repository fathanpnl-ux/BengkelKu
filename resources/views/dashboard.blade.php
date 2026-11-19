@extends('layouts.app')

@section('title', 'Dashboard')
@section('heading', 'Dashboard')

@section('content')

<style>
    .welcome {
        background: linear-gradient(120deg, #164E56, #0F8790);
        padding: 35px;
        border-radius: 18px;
        color: white;
        margin-bottom: 28px;
        position: relative;
        overflow: hidden;
    }

    .welcome::after {
        content: '\f21c';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        position: absolute;
        right: 40px;
        top: 15px;
        font-size: 105px;
        color: rgba(255,255,255,0.10);
    }

    .welcome h2 {
        font-size: 25px;
        margin-bottom: 12px;
        font-weight: 800;
    }

    .welcome p {
        font-size: 13px;
        color: #E3F2EF;
        line-height: 1.8;
        max-width: 620px;
    }

    .section-title {
        font-size: 17px;
        font-weight: 700;
        color: #164E56;
        margin-bottom: 18px;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
        gap: 18px;
    }

    .dashboard-card {
        background: #FFFFFF;
        padding: 24px;
        border-radius: 15px;
        border: 1px solid #EAE5D9;
        text-decoration: none;
        display: block;
        transition: all .25s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        border-color: #0F8790;
        box-shadow: 0 10px 25px rgba(22,78,86,0.10);
    }

    .card-icon {
        width: 48px;
        height: 48px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #E2F1EF;
        color: #0F8790;
        font-size: 20px;
        margin-bottom: 18px;
    }

    .dashboard-card h3 {
        font-size: 14px;
        color: #164E56;
        margin-bottom: 9px;
    }

    .dashboard-card p {
        font-size: 12px;
        color: #84948D;
        line-height: 1.7;
    }

    .card-link {
        display: inline-block;
        margin-top: 17px;
        color: #0F8790;
        font-size: 12px;
        font-weight: 700;
    }

    .info {
        margin-top: 27px;
        background: #F3DDB5;
        padding: 23px 25px;
        border-radius: 15px;
        border: 1px solid #EAD4AB;
    }

    .info .section-title {
        color: #164E56;
        margin-bottom: 10px;
    }

    .info p {
        color: #52686A;
        font-size: 13px;
        line-height: 1.8;
    }

    @media(max-width: 550px) {
        .welcome {
            padding: 25px;
        }

        .welcome::after {
            display: none;
        }
    }
</style>

<div class="welcome">
    <h2>Selamat Datang di BengkelKu!</h2>
    <p>
        Sistem Informasi Service Motor digunakan untuk mengelola
        data pelanggan, kendaraan, proses service, hingga pembayaran
        secara lebih mudah, praktis, dan terorganisir.
    </p>
</div>

<h3 class="section-title">
    <i class="fas fa-th-large"></i> Menu Pengelolaan
</h3>

<div class="dashboard-grid">

    <a href="{{ route('pelanggan.index') }}" class="dashboard-card">
        <div class="card-icon">
            <i class="fas fa-users"></i>
        </div>
        <h3>Data Pelanggan</h3>
        <p>Mengelola informasi pelanggan bengkel.</p>
        <span class="card-link">Buka Menu <i class="fas fa-arrow-right"></i></span>
    </a>

    <a href="{{ route('kendaraan.index') }}" class="dashboard-card">
        <div class="card-icon">
            <i class="fas fa-motorcycle"></i>
        </div>
        <h3>Data Kendaraan</h3>
        <p>Mengelola informasi kendaraan pelanggan.</p>
        <span class="card-link">Buka Menu <i class="fas fa-arrow-right"></i></span>
    </a>

    <a href="{{ route('daftar-service.index') }}" class="dashboard-card">
        <div class="card-icon">
            <i class="fas fa-clipboard-list"></i>
        </div>
        <h3>Daftar Service</h3>
        <p>Mencatat pendaftaran dan keluhan service kendaraan.</p>
        <span class="card-link">Buka Menu <i class="fas fa-arrow-right"></i></span>
    </a>

    <a href="{{ route('data-service.index') }}" class="dashboard-card">
        <div class="card-icon">
            <i class="fas fa-screwdriver-wrench"></i>
        </div>
        <h3>Data Service</h3>
        <p>Mengelola pekerjaan mekanik dan sparepart.</p>
        <span class="card-link">Buka Menu <i class="fas fa-arrow-right"></i></span>
    </a>

    <a href="{{ route('pembayaran-service.index') }}" class="dashboard-card">
        <div class="card-icon">
            <i class="fas fa-money-bill-wave"></i>
        </div>
        <h3>Pembayaran Service</h3>
        <p>Mencatat biaya dan jenis pembayaran service.</p>
        <span class="card-link">Buka Menu <i class="fas fa-arrow-right"></i></span>
    </a>

</div>

<div class="info">
    <h3 class="section-title">
        <i class="fas fa-circle-info"></i> Informasi Aplikasi
    </h3>
    <p>
        Aplikasi BengkelKu dibuat menggunakan framework Laravel
        dan database MySQL. Sistem menyediakan pengelolaan data
        secara terintegrasi, mulai dari pelanggan mendaftarkan
        kendaraan hingga proses pembayaran service selesai.
    </p>
</div>

@endsection