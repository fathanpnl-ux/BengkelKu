@extends('layouts.app')

@section('title', 'Edit Data Service')
@section('heading', 'Edit Data Service')

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
        min-height: 90px;
    }

    .form-group select {
        cursor: pointer;
    }

    .readonly {
        background: #EAF3F1 !important;
        color: #164E56 !important;
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
        <h3>Formulir Edit Data Service</h3>
    </div>

    <p class="form-description">
        Perbarui informasi pengerjaan service kendaraan pelanggan.
    </p>

    @if($errors->any())
        <div class="form-alert">
            <i class="fas fa-exclamation-circle"></i>
            Periksa kembali data yang dimasukkan.
        </div>
    @endif

    <form action="{{ route('data-service.update', $dataService->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>ID Service</label>

            <select name="daftar_service_id" id="daftar_service_id" required>
                <option value="">-- Pilih ID Service --</option>

                @foreach ($daftarServices as $service)
                    <option
                        value="{{ $service->id }}"
                        data-keluhan="{{ $service->keluhan_kendaraan }}"
                        {{ old('daftar_service_id', $dataService->daftar_service_id) == $service->id ? 'selected' : '' }}
                    >
                        {{ $service->id }} -
                        {{ $service->kendaraan->no_plat }} -
                        {{ $service->pelanggan->nama_lengkap }}
                    </option>
                @endforeach
            </select>

            @error('daftar_service_id')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Keluhan Kendaraan</label>

            <textarea
                id="keluhan_kendaraan"
                class="readonly"
                rows="4"
                placeholder="Keluhan kendaraan akan muncul otomatis"
                readonly
            ></textarea>
        </div>

        <div class="form-group">
            <label>Estimasi Service</label>

            <textarea
                name="estimasi_service"
                rows="3"
                placeholder="Masukkan estimasi pengerjaan service"
                required
            >{{ old('estimasi_service', $dataService->estimasi_service) }}</textarea>

            @error('estimasi_service')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Nama Mekanik</label>

            <input
                type="text"
                name="nama_mekanik"
                value="{{ old('nama_mekanik', $dataService->nama_mekanik) }}"
                placeholder="Masukkan nama mekanik"
                required
            >

            @error('nama_mekanik')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Sparepart Pengganti</label>

            <textarea
                name="sparepart_pengganti"
                rows="3"
                placeholder="Masukkan sparepart yang diganti (opsional)"
            >{{ old('sparepart_pengganti', $dataService->sparepart_pengganti) }}</textarea>

            @error('sparepart_pengganti')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-save">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>

            <a href="{{ route('data-service.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

    </form>
</div>

<script>
    const pilihanService = document.getElementById('daftar_service_id');
    const kolomKeluhan = document.getElementById('keluhan_kendaraan');

    function tampilkanKeluhan() {
        const pilihan = pilihanService.options[pilihanService.selectedIndex];

        kolomKeluhan.value = pilihan.dataset.keluhan || '';
    }

    pilihanService.addEventListener('change', tampilkanKeluhan);

    tampilkanKeluhan();
</script>

@endsection