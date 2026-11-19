@extends('layouts.app')

@section('title', 'Tambah Pelanggan')
@section('heading', 'Tambah Pelanggan')

@section('content')

<style>
    .form-card {
        background: #FFFFFF;
        padding: 30px;
        border-radius: 16px;
        border: 1px solid #EAE5D9;
        box-shadow: 0 4px 15px rgba(22,78,86,0.05);
        max-width: 850px;
    }

    .form-header {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 10px;
    }

    .form-icon {
        width: 48px;
        height: 48px;
        background: #E2F1EF;
        color: #0F8790;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 20px;
    }

    .form-header h3 {
        color: #164E56;
        font-size: 17px;
        font-weight: 700;
    }

    .form-description {
        color: #84948D;
        font-size: 12px;
        line-height: 1.7;
        margin-bottom: 27px;
    }

    .form-group {
        margin-bottom: 21px;
    }

    .form-group label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 9px;
        color: #29434A;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #EAE5D9;
        border-radius: 9px;
        font-family: inherit;
        font-size: 12px;
        color: #29434A;
        background: #FFFFFF;
        outline: none;
        transition: .2s;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #0F8790;
        box-shadow: 0 0 0 3px rgba(15,135,144,0.10);
    }

    .form-group input::placeholder,
    .form-group textarea::placeholder {
        color: #A6B0AB;
    }

    .form-group textarea {
        resize: vertical;
        min-height: 105px;
    }

    .error {
        color: #D9534F;
        font-size: 11px;
        margin-top: 7px;
    }

    .error-box {
        background: #FDECEC;
        color: #C03939;
        padding: 13px 15px;
        border: 1px solid #F5D0D0;
        border-radius: 9px;
        margin-bottom: 22px;
        font-size: 12px;
    }

    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 27px;
        padding-top: 22px;
        border-top: 1px solid #EAE5D9;
        flex-wrap: wrap;
    }

    .btn-save {
        background: #0F8790;
        color: white;
        border: none;
        padding: 12px 21px;
        border-radius: 9px;
        cursor: pointer;
        font-weight: 600;
        font-size: 12px;
        font-family: inherit;
        transition: .2s;
    }

    .btn-save:hover {
        background: #116B72;
    }

    .btn-back {
        background: #F3DDB5;
        color: #164E56;
        padding: 12px 21px;
        border-radius: 9px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 600;
        transition: .2s;
    }

    .btn-back:hover {
        background: #EAD1A5;
    }

    @media(max-width: 550px) {
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
            <i class="fas fa-user-plus"></i>
        </div>

        <h3>Formulir Pelanggan</h3>
    </div>

    <p class="form-description">
        Silakan lengkapi informasi pelanggan di bawah ini.
        Pastikan data yang dimasukkan sudah benar.
    </p>

    @if($errors->any())
        <div class="error-box">
            <i class="fas fa-circle-exclamation"></i>
            Periksa kembali data yang dimasukkan.
            Pastikan semua kolom wajib sudah diisi dengan benar.
        </div>
    @endif

    <form action="{{ route('pelanggan.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text"
                   name="nama_lengkap"
                   value="{{ old('nama_lengkap') }}"
                   placeholder="Masukkan nama lengkap pelanggan"
                   required>

            @error('nama_lengkap')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Nomor HP</label>
            <input type="text"
                   name="no_hp"
                   value="{{ old('no_hp') }}"
                   placeholder="Contoh: 081234567890"
                   required>

            @error('no_hp')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat"
                      placeholder="Masukkan alamat lengkap pelanggan"
                      required>{{ old('alamat') }}</textarea>

            @error('alamat')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Pekerjaan</label>
            <input type="text"
                   name="pekerjaan"
                   value="{{ old('pekerjaan') }}"
                   placeholder="Contoh: Mahasiswa"
                   required>

            @error('pekerjaan')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-save">
                <i class="fas fa-save"></i> Simpan Data
            </button>

            <a href="{{ route('pelanggan.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

    </form>
</div>

@endsection