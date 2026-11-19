<?php

namespace App\Http\Controllers;

use App\Models\DataService;
use App\Models\DaftarService;
use Illuminate\Http\Request;

class DataServiceController extends Controller
{
    // Menampilkan seluruh data service
    public function index()
    {
        $dataServices = DataService::with('daftarService.pelanggan', 'daftarService.kendaraan')
            ->orderBy('id', 'asc')
            ->get();

        return view('data_service.index', compact('dataServices'));
    }

    // Menampilkan form tambah data service
    public function create()
    {
        $daftarServices = DaftarService::with('pelanggan', 'kendaraan')
            ->orderBy('id', 'asc')
            ->get();

        return view('data_service.create', compact('daftarServices'));
    }

    // Menyimpan data service
    public function store(Request $request)
    {
        $validated = $request->validate([
            'daftar_service_id' => 'required|exists:daftar_services,id|unique:data_services,daftar_service_id',
            'estimasi_service' => 'required|string',
            'nama_mekanik' => 'required|string|max:255',
            'sparepart_pengganti' => 'nullable|string',
        ]);

        DataService::create($validated);

        return redirect()->route('data-service.index')
            ->with('success', 'Data service berhasil ditambahkan!');
    }

    // Menampilkan form edit
    public function edit(DataService $dataService)
    {
        $daftarServices = DaftarService::with('pelanggan', 'kendaraan')
            ->orderBy('id', 'asc')
            ->get();

        return view('data_service.edit', compact(
            'dataService',
            'daftarServices'
        ));
    }

    // Memperbarui data service
    public function update(Request $request, DataService $dataService)
    {
        $validated = $request->validate([
            'daftar_service_id' => 'required|exists:daftar_services,id|unique:data_services,daftar_service_id,' . $dataService->id,
            'estimasi_service' => 'required|string',
            'nama_mekanik' => 'required|string|max:255',
            'sparepart_pengganti' => 'nullable|string',
        ]);

        $dataService->update($validated);

        return redirect()->route('data-service.index')
            ->with('success', 'Data service berhasil diperbarui!');
    }

    // Menghapus data service
    public function destroy(DataService $dataService)
    {
        $dataService->delete();

        return redirect()->route('data-service.index')
            ->with('success', 'Data service berhasil dihapus!');
    }
}