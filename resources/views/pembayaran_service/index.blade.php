@extends('layouts.app')

@section('title', 'Pembayaran Service')
@section('heading', 'Pembayaran Service')

@section('content')

<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 22px;
        flex-wrap: wrap;
    }

    .page-header h2 {
        color: #164E56;
        font-size: 22px;
        margin: 0 0 6px;
    }

    .page-header p {
        color: #84948D;
        font-size: 13px;
        margin: 0;
    }

    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #0F8790;
        color: white;
        padding: 11px 17px;
        border-radius: 9px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 600;
        transition: 0.2s;
    }

    .btn-add:hover {
        background: #116B72;
    }

    .table-card {
        background: #FFFFFF;
        border: 1px solid #EAE5D9;
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 4px 18px rgba(22, 78, 86, 0.05);
    }

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .payment-table {
        width: 100%;
        min-width: 950px;
        border-collapse: collapse;
    }

    .payment-table thead {
        background: #EAF3F1;
    }

    .payment-table th {
        color: #164E56;
        font-size: 12px;
        font-weight: 700;
        padding: 15px 13px;
        text-align: left;
        white-space: nowrap;
    }

    .payment-table td {
        color: #52686A;
        font-size: 12px;
        padding: 15px 13px;
        border-bottom: 1px solid #F0EDE6;
        vertical-align: middle;
    }

    .payment-table tbody tr:hover {
        background: #FFFCF5;
    }

    .payment-table tbody tr:last-child td {
        border-bottom: none;
    }

    .id-badge {
        display: inline-block;
        background: #E2F1EF;
        color: #0F747B;
        padding: 5px 10px;
        border-radius: 7px;
        font-weight: 700;
    }

    .plate-badge {
        display: inline-block;
        background: #F3DDB5;
        color: #765B2C;
        padding: 5px 9px;
        border-radius: 6px;
        font-weight: 600;
        white-space: nowrap;
    }

    .customer-name {
        color: #164E56;
        font-weight: 600;
    }

    .amount {
        color: #27845D;
        font-weight: 700;
        white-space: nowrap;
    }

    .payment-badge {
        display: inline-block;
        background: #E2F1EF;
        color: #0F747B;
        padding: 5px 9px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
    }

    .payment-badge.cash {
        background: #FFF2D9;
        color: #A87522;
    }

    .payment-badge.non-cash {
        background: #E2F1EF;
        color: #0F747B;
    }

    .action-buttons {
        display: flex;
        gap: 7px;
        align-items: center;
    }

    .btn-edit {
        display: inline-block;
        background: #FFF2D9;
        color: #A87522;
        padding: 7px 11px;
        border-radius: 7px;
        text-decoration: none;
        font-size: 11px;
        font-weight: 600;
    }

    .btn-edit:hover {
        background: #F3DDB5;
    }

    .btn-delete {
        background: #FDECEC;
        color: #D9534F;
        padding: 7px 11px;
        border-radius: 7px;
        font-size: 11px;
        font-weight: 600;
        border: none;
        cursor: pointer;
    }

    .btn-delete:hover {
        background: #F8D7D6;
    }

    .alert-success {
        background: #E7F5EC;
        color: #27845D;
        padding: 13px 16px;
        border-radius: 9px;
        font-size: 12px;
        margin-bottom: 18px;
    }

    .empty-state {
        text-align: center;
        padding: 35px 15px !important;
        color: #84948D !important;
    }

    .empty-state i {
        display: block;
        font-size: 28px;
        color: #0F8790;
        margin-bottom: 10px;
    }

    @media (max-width: 600px) {
        .table-card {
            padding: 12px;
        }

        .page-header h2 {
            font-size: 19px;
        }
    }
</style>

<div class="page-header">
    <div>
        <h2>Pembayaran Service</h2>
        <p>Daftar transaksi pembayaran service kendaraan pelanggan.</p>
    </div>

    <a href="{{ route('pembayaran-service.create') }}" class="btn-add">
        <i class="fas fa-plus"></i>
        Tambah Pembayaran
    </a>
</div>

@if (session('success'))
    <div class="alert-success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
@endif

<div class="table-card">
    <div class="table-wrapper">
        <table class="payment-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Service</th>
                    <th>No Plat</th>
                    <th>Nama Pelanggan</th>
                    <th>Jumlah Biaya</th>
                    <th>Jenis Pembayaran</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($pembayaranServices as $pembayaran)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <span class="id-badge">
                                #{{ $pembayaran->daftar_service_id }}
                            </span>
                        </td>

                        <td>
                            <span class="plate-badge">
                                {{ $pembayaran->daftarService->kendaraan->no_plat }}
                            </span>
                        </td>

                        <td class="customer-name">
                            {{ $pembayaran->daftarService->pelanggan->nama_lengkap }}
                        </td>

                        <td class="amount">
                            Rp {{ number_format($pembayaran->jumlah_biaya, 0, ',', '.') }}
                        </td>

                        <td>
                            @if($pembayaran->jenis_pembayaran == 'Cash')
                                <span class="payment-badge cash">Cash</span>
                            @elseif($pembayaran->jenis_pembayaran == 'Non Tunai')
                                <span class="payment-badge non-cash">Non Tunai</span>
                            @else
                                -
                            @endif
                        </td>

                        <td>{{ $pembayaran->keterangan ?? '-' }}</td>

                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('pembayaran-service.edit', $pembayaran->id) }}"
                                   class="btn-edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <form action="{{ route('pembayaran-service.destroy', $pembayaran->id) }}"
                                      method="POST"
                                      style="display:inline;"
                                      onsubmit="return confirm('Yakin ingin menghapus pembayaran ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn-delete">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="empty-state">
                            <i class="fas fa-wallet"></i>
                            Belum ada data pembayaran.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection