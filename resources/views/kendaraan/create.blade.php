@extends('layouts.app')

@section('title', 'Tambah Kendaraan')
@section('heading', 'Tambah Kendaraan')

@section('content')

<style>
    .form-card {
        background: #FFFFFF;
        padding: 30px;
        border-radius: 16px;
        max-width: 850px;
        border: 1px solid #EAE5D9;
        box-shadow: 0 4px 18px rgba(22, 78, 86, 0.06);
    }

    .form-header {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 8px;
    }

    .form-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        background: #E2F1EF;
        color: #0F8790;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
    }

    .form-card h3 {
        color: #164E56;
        font-size: 19px;
        margin: 0;
    }

    .form-description {
        color: #84948D;
        font-size: 13px;
        margin: 8px 0 28px;
    }

    .form-group {
        margin-bottom: 21px;
    }

    .form-group > label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 9px;
        color: #29434A;
    }

    .form-group input[type="text"],
    .form-group input[type="number"] {
        width: 100%;
        padding: 13px 15px;
        border: 1px solid #EAE5D9;
        border-radius: 9px;
        font-family: inherit;
        font-size: 13px;
        color: #29434A;
        background: #FFFEFC;
        outline: none;
        box-sizing: border-box;
        transition: 0.2s;
    }

    .form-group input:focus {
        border-color: #0F8790;
        box-shadow: 0 0 0 3px rgba(15, 135, 144, 0.10);
    }

    .form-group input::placeholder {
        color: #A5B0AA;
    }

    .radio-group {
        display: flex;
        gap: 13px;
        flex-wrap: wrap;
    }

    .radio-option {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 12px 17px;
        border: 1px solid #EAE5D9;
        border-radius: 9px;
        background: #FFFEFC;
        font-size: 13px;
        color: #52686A;
        cursor: pointer;
        transition: 0.2s;
    }

    .radio-option:hover {
        border-color: #0F8790;
        background: #F2F9F8;
    }

    .radio-option input {
        accent-color: #0F8790;
        width: 16px;
        height: 16px;
        cursor: pointer;
    }

    .error {
        color: #D9534F;
        font-size: 11px;
        margin-top: 6px;
    }

    .form-alert {
        background: #FDECEC;
        color: #B83D3A;
        padding: 13px 15px;
        border-radius: 9px;
        margin-bottom: 22px;
        font-size: 12px;
    }

    .form-actions {
        display: flex;
        gap: 11px;
        margin-top: 28px;
        padding-top: 22px;
        border-top: 1px solid #EAE5D9;
    }

    .btn-save {
        background: #0F8790;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 9px;
        cursor: pointer;
        font-weight: 600;
        font-size: 12px;
        transition: 0.2s;
    }

    .btn-save:hover {
        background: #116B72;
    }

    .btn-back {
        background: #F3DDB5;
        color: #765B2C;
        padding: 12px 20px;
        border-radius: 9px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 600;
        transition: 0.2s;
    }

    .btn-back:hover {
        background: #EBD09F;
    }

    @media (max-width: 600px) {
        .form-card {
            padding: 20px;
        }

        .form-actions {
            flex-direction: column;
        }

        .form-actions button,
        .form-actions a {
            text-align: center;
        }
    }
</style>

<div class="form-card">

    <div class="form-header">
        <div class="form-icon">
            <i class="fas fa-motorcycle"></i>
        </div>
        <h3>Formulir Kendaraan</h3>
    </div>

    <p class="form-description">
        Lengkapi informasi kendaraan yang akan didaftarkan ke BengkelKu.
    </p>

    @if($errors->any())
        <div class="form-alert">
            <i class="fas fa-exclamation-circle"></i>
            Periksa kembali data yang dimasukkan. Pastikan semua kolom sudah benar.
        </div>
    @endif

    <form action="{{ route('kendaraan.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Nomor Plat Kendaraan</label>
            <input
                type="text"
                name="no_plat"
                value="{{ old('no_plat') }}"
                placeholder="Contoh: BK 1234 ABC"
                required
            >
            @error('no_plat')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Jenis Motor</label>

            <div class="radio-group">
                <label class="radio-option">
                    <input
                        type="radio"
                        name="jenis_kendaraan"
                        value="Matic"
                        {{ old('jenis_kendaraan') == 'Matic' ? 'checked' : '' }}
                        required
                    >
                    <i class="fas fa-motorcycle"></i>
                    Matic
                </label>

                <label class="radio-option">
                    <input
                        type="radio"
                        name="jenis_kendaraan"
                        value="Manual"
                        {{ old('jenis_kendaraan') == 'Manual' ? 'checked' : '' }}
                    >
                    <i class="fas fa-motorcycle"></i>
                    Manual Transmisi
                </label>
            </div>

            @error('jenis_kendaraan')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Nomor STNK</label>
            <input
                type="text"
                name="no_stnk"
                value="{{ old('no_stnk') }}"
                placeholder="Masukkan nomor STNK"
                required
            >
            @error('no_stnk')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Tahun Pembuatan</label>
            <input
                type="number"
                name="tahun_pembuatan"
                value="{{ old('tahun_pembuatan') }}"
                placeholder="Contoh: 2022"
                min="1900"
                max="{{ date('Y') }}"
                required
            >
            @error('tahun_pembuatan')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Nama Pemilik</label>
            <input
                type="text"
                name="nama_pemilik"
                value="{{ old('nama_pemilik') }}"
                placeholder="Masukkan nama pemilik kendaraan"
                required
            >
            @error('nama_pemilik')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Warna Kendaraan</label>
            <input
                type="text"
                name="warna_kendaraan"
                value="{{ old('warna_kendaraan') }}"
                placeholder="Contoh: Hitam"
                required
            >
            @error('warna_kendaraan')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-save">
                <i class="fas fa-save"></i> Simpan Data
            </button>

            <a href="{{ route('kendaraan.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

    </form>
</div>

@endsection