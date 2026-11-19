<?php

namespace App\Http\Controllers;

use App\Models\DaftarService;
use App\Models\Pelanggan;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class DaftarServiceController extends Controller
{
    // Menampilkan daftar service
    public function index()
    {
        $daftarServices = DaftarService::with([
            'pelanggan',
            'kendaraan'
        ])->orderBy('id', 'asc')->get();

        return view('daftar_service.index', compact('daftarServices'));
    }

    // Menampilkan form tambah service
    public function create()
    {
        $pelanggans = Pelanggan::orderBy('id', 'asc')->get();
        $kendaraans = Kendaraan::orderBy('id', 'asc')->get();

        return view('daftar_service.create', compact(
            'pelanggans',
            'kendaraans'
        ));
    }

    // Menyimpan daftar service
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'keluhan_kendaraan' => 'required|string',
            'tanggal_servis' => 'required|date',
        ]);

        DaftarService::create($validated);

        return redirect()->route('daftar-service.index')
            ->with('success', 'Daftar service berhasil ditambahkan!');
    }

    // Menampilkan form edit
    public function edit(DaftarService $daftarService)
    {
        $pelanggans = Pelanggan::orderBy('id', 'asc')->get();
        $kendaraans = Kendaraan::orderBy('id', 'asc')->get();

        return view('daftar_service.edit', compact(
            'daftarService',
            'pelanggans',
            'kendaraans'
        ));
    }

    // Memperbarui daftar service
    public function update(Request $request, DaftarService $daftarService)
    {
        $validated = $request->validate([
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'keluhan_kendaraan' => 'required|string',
            'tanggal_servis' => 'required|date',
        ]);

        $daftarService->update($validated);

        return redirect()->route('daftar-service.index')
            ->with('success', 'Daftar service berhasil diperbarui!');
    }

    // Menghapus daftar service
    public function destroy(DaftarService $daftarService)
    {
        $daftarService->delete();

        return redirect()->route('daftar-service.index')
            ->with('success', 'Daftar service berhasil dihapus!');
    }
}