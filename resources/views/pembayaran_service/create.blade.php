@extends('layouts.app')

@section('title', 'Tambah Pembayaran Service')
@section('heading', 'Tambah Pembayaran Service')

@section('content')

<style>
    .form-card {
        background: #FFFFFF;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 4px 18px rgba(22, 78, 86, 0.06);
        max-width: 850px;
        border: 1px solid #EAE5D9;
    }

    .form-description {
        color: #84948D;
        font-size: 14px;
        margin-top: -8px;
        margin-bottom: 28px;
    }

    .form-group {
        margin-bottom: 22px;
    }

    .form-group label {
        display: block;
        color: #29434A;
        font-weight: 600;
        margin-bottom: 9px;
        font-size: 14px;
    }

    .form-group input:not([type="radio"]),
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #EAE5D9;
        border-radius: 9px;
        background: #FAF8F3;
        color: #29434A;
        font-size: 14px;
        outline: none;
        transition: 0.2s;
        box-sizing: border-box;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #0F8790;
        box-shadow: 0 0 0 3px rgba(15, 135, 144, 0.10);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 100px;
    }

    .radio-options {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .radio-card {
        display: flex !important;
        align-items: center;
        gap: 9px;
        padding: 12px 18px;
        border: 1px solid #EAE5D9;
        border-radius: 9px;
        background: #FAF8F3;
        cursor: pointer;
        font-weight: 500 !important;
        margin-bottom: 0 !important;
        transition: 0.2s;
    }

    .radio-card:has(input:checked) {
        border-color: #0F8790;
        background: #EAF5F3;
        color: #164E56;
    }

    .radio-card input {
        accent-color: #0F8790;
    }

    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 28px;
        flex-wrap: wrap;
    }

    .btn-save {
        background: #0F8790;
        color: white;
        border: none;
        padding: 11px 20px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        transition: 0.2s;
    }

    .btn-save:hover {
        background: #116B72;
        color: white;
    }

    .btn-back {
        background: #F3DDB5;
        color: #654D27;
        padding: 11px 20px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: 0.2s;
    }

    .btn-back:hover {
        background: #EBD09F;
        color: #654D27;
    }

    .form-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        background: #EAF5F3;
        color: #0F8790;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-bottom: 15px;
    }

    .error-message {
        color: #D9534F;
        font-size: 12px;
        margin-top: 6px;
    }

    .required-note {
        color: #84948D;
        font-size: 12px;
        margin-top: 5px;
    }
</style>

<div class="form-card">

    <div class="form-icon">
        <i class="fas fa-money-bill-wave"></i>
    </div>

    <h2 style="color: #164E56; margin-bottom: 12px;">
        Tambah Pembayaran Service
    </h2>

    <p class="form-description">
        Lengkapi informasi pembayaran untuk transaksi service kendaraan.
    </p>

    <form action="{{ route('pembayaran-service.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>ID Service <span style="color: #D9534F;">*</span></label>

            <select name="daftar_service_id" required>
                <option value="">-- Pilih ID Service --</option>

                @foreach ($dataServices as $data)
                    <option
                        value="{{ $data->daftar_service_id }}"
                        {{ old('daftar_service_id') == $data->daftar_service_id ? 'selected' : '' }}
                    >
                        Service {{ $data->daftar_service_id }}
                        - {{ $data->daftarService->kendaraan->no_plat }}
                        - {{ $data->daftarService->pelanggan->nama_lengkap }}
                    </option>
                @endforeach
            </select>

            @error('daftar_service_id')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Jumlah Biaya (Rp) <span style="color: #D9534F;">*</span></label>

            <input
                type="number"
                name="jumlah_biaya"
                min="0"
                step="0.01"
                value="{{ old('jumlah_biaya') }}"
                placeholder="Contoh: 150000"
                required
            >

            @error('jumlah_biaya')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Jenis Pembayaran</label>

            <div class="radio-options">
                <label class="radio-card">
                    <input
                        type="radio"
                        name="jenis_pembayaran"
                        value="Cash"
                        {{ old('jenis_pembayaran') == 'Cash' ? 'checked' : '' }}
                    >
                    <i class="fas fa-money-bill-wave"></i>
                    Cash
                </label>

                <label class="radio-card">
                    <input
                        type="radio"
                        name="jenis_pembayaran"
                        value="Non Tunai"
                        {{ old('jenis_pembayaran') == 'Non Tunai' ? 'checked' : '' }}
                    >
                    <i class="fas fa-credit-card"></i>
                    Non Tunai
                </label>
            </div>

            @error('jenis_pembayaran')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Keterangan</label>

            <textarea
                name="keterangan"
                rows="4"
                placeholder="Masukkan keterangan pembayaran (opsional)"
            >{{ old('keterangan') }}</textarea>

            @error('keterangan')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-save">
                <i class="fas fa-save"></i> Simpan Pembayaran
            </button>

            <a href="{{ route('pembayaran-service.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

    </form>
</div>

@endsection