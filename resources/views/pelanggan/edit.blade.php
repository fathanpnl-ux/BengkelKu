@extends('layouts.app')

@section('title', 'Edit Pelanggan')
@section('heading', 'Edit Data Pelanggan')

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

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 9px;
        color: #29434A;
    }

    .form-group input,
    .form-group textarea {
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

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #0F8790;
        box-shadow: 0 0 0 3px rgba(15, 135, 144, 0.10);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 105px;
    }

    .form-group input::placeholder,
    .form-group textarea::placeholder {
        color: #A5B0AA;
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
            <i class="fas fa-user-edit"></i>
        </div>
        <h3>Formulir Edit Pelanggan</h3>
    </div>

    <p class="form-description">
        Perbarui informasi pelanggan sesuai dengan data terbaru.
    </p>

    @if($errors->any())
        <div class="form-alert">
            <i class="fas fa-exclamation-circle"></i>
            Periksa kembali data yang dimasukkan. Pastikan semua kolom sudah benar.
        </div>
    @endif

    <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input
                type="text"
                name="nama_lengkap"
                placeholder="Masukkan nama lengkap pelanggan"
                value="{{ old('nama_lengkap', $pelanggan->nama_lengkap) }}"
                required
            >
            @error('nama_lengkap')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Nomor HP</label>
            <input
                type="text"
                name="no_hp"
                placeholder="Contoh: 081234567890"
                value="{{ old('no_hp', $pelanggan->no_hp) }}"
                required
            >
            @error('no_hp')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea
                name="alamat"
                placeholder="Masukkan alamat lengkap pelanggan"
                required
            >{{ old('alamat', $pelanggan->alamat) }}</textarea>
            @error('alamat')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Pekerjaan</label>
            <input
                type="text"
                name="pekerjaan"
                placeholder="Masukkan pekerjaan pelanggan"
                value="{{ old('pekerjaan', $pelanggan->pekerjaan) }}"
                required
            >
            @error('pekerjaan')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-save">
                <i class="fas fa-save"></i> Perbarui Data
            </button>

            <a href="{{ route('pelanggan.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

    </form>
</div>

@endsection