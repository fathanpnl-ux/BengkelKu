@extends('layouts.app')

@section('title', 'Edit Daftar Service')
@section('heading', 'Edit Daftar Service')

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
        line-height: 1.6;
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
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 13px 15px;
        border: 1px solid #EAE5D9;
        border-radius: 9px;
        font-family: inherit;
        font-size: 13px;
        color: #29434A;
        outline: none;
        background: #FFFEFC;
        box-sizing: border-box;
        transition: 0.2s;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #0F8790;
        box-shadow: 0 0 0 3px rgba(15, 135, 144, 0.10);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 110px;
    }

    .form-group select {
        cursor: pointer;
    }

    .readonly {
        background: #EAF3F1 !important;
        color: #164E56 !important;
        font-weight: 600;
        cursor: not-allowed;
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
            <i class="fas fa-edit"></i>
        </div>
        <h3>Formulir Edit Daftar Service</h3>
    </div>

    <p class="form-description">
        Perbarui informasi kendaraan, pelanggan, keluhan, atau tanggal service.
    </p>

    @if($errors->any())
        <div class="form-alert">
            <i class="fas fa-exclamation-circle"></i>
            Periksa kembali data yang dimasukkan.
        </div>
    @endif

    <form action="{{ route('daftar-service.update', $daftarService->id) }}"
          method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nomor Plat Kendaraan</label>

            <select name="kendaraan_id" id="kendaraan_id" required>
                <option value="">-- Pilih Kendaraan --</option>

                @foreach ($kendaraans as $kendaraan)
                    <option value="{{ $kendaraan->id }}"
                        {{ old('kendaraan_id', $daftarService->kendaraan_id) == $kendaraan->id ? 'selected' : '' }}>
                        {{ $kendaraan->no_plat }} - {{ $kendaraan->nama_pemilik }}
                    </option>
                @endforeach
            </select>

            @error('kendaraan_id')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>ID Pelanggan</label>

            <select name="pelanggan_id" id="pelanggan_id" required>
                <option value="">-- Pilih Pelanggan --</option>

                @foreach ($pelanggans as $pelanggan)
                    <option
                        value="{{ $pelanggan->id }}"
                        data-nama="{{ $pelanggan->nama_lengkap }}"
                        {{ old('pelanggan_id', $daftarService->pelanggan_id) == $pelanggan->id ? 'selected' : '' }}>
                        {{ $pelanggan->id }} - {{ $pelanggan->nama_lengkap }}
                    </option>
                @endforeach
            </select>

            @error('pelanggan_id')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Nama Pelanggan</label>

            <input
                type="text"
                id="nama_pelanggan"
                class="readonly"
                value="{{ old('pelanggan_id') ? '' : $daftarService->pelanggan->nama_lengkap }}"
                placeholder="Nama pelanggan akan muncul otomatis"
                readonly
            >
        </div>

        <div class="form-group">
            <label>Keluhan Kendaraan</label>

            <textarea
                name="keluhan_kendaraan"
                placeholder="Masukkan keluhan kendaraan"
                required>{{ old('keluhan_kendaraan', $daftarService->keluhan_kendaraan) }}</textarea>

            @error('keluhan_kendaraan')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Tanggal Service</label>

            <input
                type="date"
                name="tanggal_servis"
                value="{{ old('tanggal_servis', \Carbon\Carbon::parse($daftarService->tanggal_servis)->format('Y-m-d')) }}"
                required
            >

            @error('tanggal_servis')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-save">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>

            <a href="{{ route('daftar-service.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

    </form>
</div>

<script>
    const pelangganSelect = document.getElementById('pelanggan_id');
    const namaPelanggan = document.getElementById('nama_pelanggan');

    function tampilkanNamaPelanggan() {
        const pilihan = pelangganSelect.options[pelangganSelect.selectedIndex];

        namaPelanggan.value = pilihan.dataset.nama || '';
    }

    pelangganSelect.addEventListener('change', tampilkanNamaPelanggan);

    tampilkanNamaPelanggan();
</script>

@endsection