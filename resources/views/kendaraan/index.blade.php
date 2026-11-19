@extends('layouts.app')

@section('title', 'Data Kendaraan')
@section('heading', 'Data Kendaraan')

@section('content')

<style>
    .vehicle-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
        gap: 12px;
        flex-wrap: wrap;
    }

    .vehicle-page-header h3 {
        color: #164E56;
        font-size: 19px;
        margin: 0;
    }

    .vehicle-page-header p {
        color: #84948D;
        font-size: 13px;
        margin-top: 7px;
    }

    .btn-add-vehicle {
        background: #0F8790;
        color: white;
        text-decoration: none;
        padding: 12px 18px;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 600;
        transition: 0.2s;
    }

    .btn-add-vehicle:hover {
        background: #116B72;
    }

    .vehicle-table-card {
        background: #FFFFFF;
        padding: 22px;
        border-radius: 15px;
        border: 1px solid #EAE5D9;
        box-shadow: 0 4px 18px rgba(22, 78, 86, 0.06);
        overflow-x: auto;
    }

    .vehicle-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 950px;
    }

    .vehicle-table th {
        background: #EAF3F1;
        color: #164E56;
        font-size: 12px;
        font-weight: 700;
        text-align: left;
        padding: 15px 12px;
        white-space: nowrap;
    }

    .vehicle-table th:first-child {
        border-radius: 8px 0 0 8px;
    }

    .vehicle-table th:last-child {
        border-radius: 0 8px 8px 0;
    }

    .vehicle-table td {
        padding: 16px 12px;
        border-bottom: 1px solid #F0EDE5;
        font-size: 12px;
        color: #52686A;
    }

    .vehicle-table tbody tr {
        transition: 0.2s;
    }

    .vehicle-table tbody tr:hover {
        background: #FAF8F3;
    }

    .vehicle-table tbody tr:last-child td {
        border-bottom: none;
    }

    .badge-vehicle-id {
        display: inline-block;
        background: #E2F1EF;
        color: #0F8790;
        padding: 6px 10px;
        border-radius: 7px;
        font-weight: 700;
    }

    .badge-vehicle-type {
        display: inline-block;
        background: #F3DDB5;
        color: #765B2C;
        padding: 6px 10px;
        border-radius: 7px;
        font-weight: 600;
    }

    .btn-vehicle-edit,
    .btn-vehicle-delete {
        border: none;
        padding: 8px 11px;
        border-radius: 7px;
        font-size: 11px;
        cursor: pointer;
        text-decoration: none;
        font-weight: 600;
        transition: 0.2s;
        white-space: nowrap;
    }

    .btn-vehicle-edit {
        background: #FFF2D9;
        color: #A56B00;
    }

    .btn-vehicle-edit:hover {
        background: #F3DDB5;
    }

    .btn-vehicle-delete {
        background: #FDECEC;
        color: #D9534F;
    }

    .btn-vehicle-delete:hover {
        background: #F8D5D4;
    }

    .vehicle-action-group {
        display: flex;
        gap: 7px;
        align-items: center;
    }

    .vehicle-action-group form {
        display: inline;
        margin: 0;
    }

    .vehicle-empty {
        text-align: center;
        padding: 45px 20px !important;
        color: #84948D !important;
    }

    .vehicle-empty i {
        display: block;
        font-size: 35px;
        color: #0F8790;
        margin-bottom: 13px;
    }

    .vehicle-empty p {
        margin: 5px 0;
    }

    .vehicle-alert-success {
        background: #E7F5EC;
        color: #27845D;
        padding: 13px 16px;
        border-radius: 9px;
        margin-bottom: 18px;
        font-size: 13px;
        border: 1px solid #D2EBDD;
    }

    @media (max-width: 600px) {
        .vehicle-page-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .btn-add-vehicle {
            display: inline-block;
        }

        .vehicle-table-card {
            padding: 14px;
        }
    }
</style>

<div class="vehicle-page-header">
    <div>
        <h3>Daftar Kendaraan</h3>
        <p>Kelola informasi kendaraan milik pelanggan bengkel.</p>
    </div>

    <a href="{{ route('kendaraan.create') }}" class="btn-add-vehicle">
        <i class="fas fa-plus"></i> Tambah Kendaraan
    </a>
</div>

@if(session('success'))
    <div class="vehicle-alert-success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
@endif

<div class="vehicle-table-card">
    <table class="vehicle-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nomor Plat</th>
                <th>Jenis Motor</th>
                <th>Nomor STNK</th>
                <th>Tahun</th>
                <th>Nama Pemilik</th>
                <th>Warna</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($kendaraans as $kendaraan)
                <tr>
                    <td>
                        <span class="badge-vehicle-id">
                            {{ $kendaraan->id }}
                        </span>
                    </td>

                    <td>{{ $kendaraan->no_plat }}</td>

                    <td>
                        <span class="badge-vehicle-type">
                            {{ $kendaraan->jenis_kendaraan }}
                        </span>
                    </td>

                    <td>{{ $kendaraan->no_stnk }}</td>
                    <td>{{ $kendaraan->tahun_pembuatan }}</td>
                    <td>{{ $kendaraan->nama_pemilik }}</td>
                    <td>{{ $kendaraan->warna_kendaraan }}</td>

                    <td>
                        <div class="vehicle-action-group">
                            <a href="{{ route('kendaraan.edit', $kendaraan->id) }}"
                               class="btn-vehicle-edit">
                                <i class="fas fa-pen"></i> Edit
                            </a>

                            <form action="{{ route('kendaraan.destroy', $kendaraan->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus kendaraan ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn-vehicle-delete">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="vehicle-empty">
                        <i class="fas fa-motorcycle"></i>
                        <p><strong>Belum Ada Data Kendaraan</strong></p>
                        <p>Silakan tambahkan kendaraan terlebih dahulu.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection