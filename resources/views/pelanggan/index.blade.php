@extends('layouts.app')

@section('title', 'Data Pelanggan')
@section('heading', 'Data Pelanggan')

@section('content')

<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
        gap: 12px;
        flex-wrap: wrap;
    }

    .page-header h3 {
        color: #164E56;
        font-size: 17px;
        font-weight: 700;
    }

    .page-header p {
        color: #84948D;
        font-size: 12px;
        margin-top: 6px;
    }

    .btn-add {
        background: #0F8790;
        color: white;
        text-decoration: none;
        padding: 12px 17px;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 600;
        transition: .2s;
    }

    .btn-add:hover {
        background: #116B72;
    }

    .table-card {
        background: #FFFFFF;
        padding: 23px;
        border-radius: 15px;
        border: 1px solid #EAE5D9;
        box-shadow: 0 4px 15px rgba(22,78,86,0.05);
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 750px;
    }

    th {
        background: #EAF3F1;
        color: #164E56;
        font-size: 12px;
        font-weight: 700;
        text-align: left;
        padding: 15px 13px;
    }

    th:first-child {
        border-radius: 8px 0 0 8px;
    }

    th:last-child {
        border-radius: 0 8px 8px 0;
    }

    td {
        padding: 15px 13px;
        border-bottom: 1px solid #EAE5D9;
        font-size: 12px;
        color: #52686A;
    }

    tbody tr:hover {
        background: #FCFBF8;
    }

    tbody tr:last-child td {
        border-bottom: none;
    }

    .badge-id {
        background: #E2F1EF;
        color: #0F8790;
        padding: 6px 11px;
        border-radius: 7px;
        font-size: 11px;
        font-weight: 700;
    }

    .btn-edit,
    .btn-delete {
        border: none;
        padding: 8px 11px;
        border-radius: 7px;
        font-size: 11px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: .2s;
        font-family: inherit;
    }

    .btn-edit {
        background: #FFF2D9;
        color: #A56B00;
    }

    .btn-edit:hover {
        background: #F3DDB5;
    }

    .btn-delete {
        background: #FDE8E8;
        color: #C03939;
    }

    .btn-delete:hover {
        background: #F8D2D2;
    }

    .alert-success {
        background: #E7F4EC;
        color: #27845D;
        padding: 14px 17px;
        border: 1px solid #CDE8D8;
        border-radius: 9px;
        margin-bottom: 18px;
        font-size: 12px;
    }

    .empty {
        text-align: center;
        padding: 40px;
        color: #84948D;
    }

    .empty i {
        display: block;
        font-size: 32px;
        color: #0F8790;
        margin-bottom: 13px;
    }

    .empty p {
        line-height: 1.8;
    }

    .action-group {
        display: flex;
        gap: 7px;
        align-items: center;
    }

    .action-group form {
        display: inline;
        margin: 0;
    }

    @media(max-width: 600px) {
        .page-header {
            align-items: flex-start;
        }
    }
</style>

<div class="page-header">
    <div>
        <h3>Daftar Pelanggan</h3>
        <p>Kelola informasi pelanggan bengkel motor.</p>
    </div>

    <a href="{{ route('pelanggan.create') }}" class="btn-add">
        <i class="fas fa-plus"></i> Tambah Pelanggan
    </a>
</div>

@if(session('success'))
    <div class="alert-success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
@endif

<div class="table-card">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Lengkap</th>
                <th>No. HP</th>
                <th>Alamat</th>
                <th>Pekerjaan</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($pelanggans as $pelanggan)
                <tr>
                    <td>
                        <span class="badge-id">
                            {{ $pelanggan->id }}
                        </span>
                    </td>

                    <td>{{ $pelanggan->nama_lengkap }}</td>
                    <td>{{ $pelanggan->no_hp }}</td>
                    <td>{{ $pelanggan->alamat }}</td>
                    <td>{{ $pelanggan->pekerjaan }}</td>

                    <td>
                        <div class="action-group">
                            <a href="{{ route('pelanggan.edit', $pelanggan->id) }}"
                               class="btn-edit">
                                <i class="fas fa-pen"></i> Edit
                            </a>

                            <form action="{{ route('pelanggan.destroy', $pelanggan->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus data pelanggan ini?')">
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
                    <td colspan="6" class="empty">
                        <i class="fas fa-users"></i>
                        <p>Belum ada data pelanggan.</p>
                        <p>Silakan tambahkan data pelanggan terlebih dahulu.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection