@extends('layouts.app')

@section('title', 'Daftar Service')
@section('heading', 'Daftar Service')

@section('content')

<style>
    .service-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
        gap: 12px;
        flex-wrap: wrap;
    }

    .service-page-header h3 {
        color: #164E56;
        font-size: 19px;
        margin: 0;
    }

    .service-page-header p {
        color: #84948D;
        font-size: 13px;
        margin-top: 7px;
    }

    .btn-add-service {
        background: #0F8790;
        color: white;
        text-decoration: none;
        padding: 12px 18px;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 600;
        transition: 0.2s;
    }

    .btn-add-service:hover {
        background: #116B72;
    }

    .service-table-card {
        background: #FFFFFF;
        padding: 22px;
        border-radius: 15px;
        border: 1px solid #EAE5D9;
        box-shadow: 0 4px 18px rgba(22, 78, 86, 0.06);
        overflow-x: auto;
    }

    .service-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 850px;
    }

    .service-table th {
        background: #EAF3F1;
        color: #164E56;
        font-size: 12px;
        font-weight: 700;
        text-align: left;
        padding: 15px 12px;
        white-space: nowrap;
    }

    .service-table th:first-child {
        border-radius: 8px 0 0 8px;
    }

    .service-table th:last-child {
        border-radius: 0 8px 8px 0;
    }

    .service-table td {
        padding: 16px 12px;
        border-bottom: 1px solid #F0EDE5;
        font-size: 12px;
        color: #52686A;
        vertical-align: middle;
    }

    .service-table tbody tr {
        transition: 0.2s;
    }

    .service-table tbody tr:hover {
        background: #FAF8F3;
    }

    .service-table tbody tr:last-child td {
        border-bottom: none;
    }

    .badge-service-id {
        display: inline-block;
        background: #E2F1EF;
        color: #0F8790;
        padding: 6px 10px;
        border-radius: 7px;
        font-weight: 700;
    }

    .badge-customer-id {
        display: inline-block;
        background: #F3DDB5;
        color: #765B2C;
        padding: 6px 10px;
        border-radius: 7px;
        font-weight: 600;
    }

    .service-complaint {
        max-width: 220px;
        line-height: 1.6;
        overflow-wrap: anywhere;
    }

    .service-date {
        white-space: nowrap;
        color: #164E56;
        font-weight: 600;
    }

    .btn-service-edit,
    .btn-service-delete {
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

    .btn-service-edit {
        background: #FFF2D9;
        color: #A56B00;
    }

    .btn-service-edit:hover {
        background: #F3DDB5;
    }

    .btn-service-delete {
        background: #FDECEC;
        color: #D9534F;
    }

    .btn-service-delete:hover {
        background: #F8D5D4;
    }

    .service-action-group {
        display: flex;
        gap: 7px;
        align-items: center;
    }

    .service-action-group form {
        display: inline;
        margin: 0;
    }

    .service-empty {
        text-align: center;
        padding: 45px 20px !important;
        color: #84948D !important;
    }

    .service-empty i {
        display: block;
        font-size: 35px;
        color: #0F8790;
        margin-bottom: 13px;
    }

    .service-empty p {
        margin: 5px 0;
    }

    .service-alert-success {
        background: #E7F5EC;
        color: #27845D;
        padding: 13px 16px;
        border-radius: 9px;
        margin-bottom: 18px;
        font-size: 13px;
        border: 1px solid #D2EBDD;
    }

    @media (max-width: 600px) {
        .service-page-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .btn-add-service {
            display: inline-block;
        }

        .service-table-card {
            padding: 14px;
        }
    }
</style>

<div class="service-page-header">
    <div>
        <h3>Daftar Service Kendaraan</h3>
        <p>Kelola pendaftaran service dan keluhan pelanggan.</p>
    </div>

    <a href="{{ route('daftar-service.create') }}" class="btn-add-service">
        <i class="fas fa-plus"></i> Tambah Daftar Service
    </a>
</div>

@if(session('success'))
    <div class="service-alert-success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
@endif

<div class="service-table-card">
    <table class="service-table">
        <thead>
            <tr>
                <th>ID Service</th>
                <th>Nomor Plat</th>
                <th>ID Pelanggan</th>
                <th>Nama Pelanggan</th>
                <th>Keluhan Kendaraan</th>
                <th>Tanggal Service</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($daftarServices as $service)
                <tr>
                    <td>
                        <span class="badge-service-id">
                            {{ $service->id }}
                        </span>
                    </td>

                    <td>{{ $service->kendaraan->no_plat }}</td>

                    <td>
                        <span class="badge-customer-id">
                            {{ $service->pelanggan->id }}
                        </span>
                    </td>

                    <td>{{ $service->pelanggan->nama_lengkap }}</td>

                    <td>
                        <div class="service-complaint">
                            {{ $service->keluhan_kendaraan }}
                        </div>
                    </td>

                    <td>
                        <span class="service-date">
                            {{ \Carbon\Carbon::parse($service->tanggal_servis)->format('d-m-Y') }}
                        </span>
                    </td>

                    <td>
                        <div class="service-action-group">
                            <a href="{{ route('daftar-service.edit', $service->id) }}"
                               class="btn-service-edit">
                                <i class="fas fa-pen"></i> Edit
                            </a>

                            <form action="{{ route('daftar-service.destroy', $service->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus daftar service ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn-service-delete">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="service-empty">
                        <i class="fas fa-clipboard-list"></i>
                        <p><strong>Belum Ada Daftar Service</strong></p>
                        <p>Silakan tambahkan pendaftaran service terlebih dahulu.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection