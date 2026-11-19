<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DaftarService;
use Illuminate\Http\Request;

class DaftarServiceController extends Controller
{
    // Menampilkan semua data daftar service
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Data daftar service berhasil ditampilkan',
            'data' => DaftarService::with(['kendaraan', 'pelanggan'])->get()
        ], 200);
    }

    // Menambahkan data daftar service
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'keluhan_kendaraan' => 'required|string',
            'tanggal_servis' => 'required|date',
        ]);

        $daftarService = DaftarService::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data daftar service berhasil ditambahkan',
            'data' => $daftarService
        ], 201);
    }

    // Menampilkan detail daftar service
    public function show(string $id)
    {
        $daftarService = DaftarService::with([
            'kendaraan',
            'pelanggan'
        ])->find($id);

        if (!$daftarService) {
            return response()->json([
                'success' => false,
                'message' => 'Data daftar service tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail daftar service berhasil ditampilkan',
            'data' => $daftarService
        ], 200);
    }

    // Mengubah data daftar service
    public function update(Request $request, string $id)
    {
        $daftarService = DaftarService::find($id);

        if (!$daftarService) {
            return response()->json([
                'success' => false,
                'message' => 'Data daftar service tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'keluhan_kendaraan' => 'required|string',
            'tanggal_servis' => 'required|date',
        ]);

        $daftarService->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data daftar service berhasil diperbarui',
            'data' => $daftarService
        ], 200);
    }

    // Menghapus data daftar service
    public function destroy(string $id)
    {
        $daftarService = DaftarService::find($id);

        if (!$daftarService) {
            return response()->json([
                'success' => false,
                'message' => 'Data daftar service tidak ditemukan'
            ], 404);
        }

        $daftarService->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data daftar service berhasil dihapus'
        ], 200);
    }
}