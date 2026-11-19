<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DataService;
use Illuminate\Http\Request;

class DataServiceController extends Controller
{
    // Menampilkan semua data service
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Data service berhasil ditampilkan',
            'data' => DataService::all()
        ], 200);
    }

    // Menambahkan data service
    public function store(Request $request)
    {
        $validated = $request->validate([
            'daftar_service_id' => 'required|exists:daftar_services,id|unique:data_services,daftar_service_id',
            'estimasi_service' => 'required|numeric|min:0',
            'nama_mekanik' => 'required|string|max:255',
            'sparepart_pengganti' => 'nullable|string|max:255',
        ]);

        $dataService = DataService::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data service berhasil ditambahkan',
            'data' => $dataService
        ], 201);
    }

    // Menampilkan detail data service
    public function show(string $id)
    {
        $dataService = DataService::find($id);

        if (!$dataService) {
            return response()->json([
                'success' => false,
                'message' => 'Data service tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data service berhasil ditampilkan',
            'data' => $dataService
        ], 200);
    }

    // Mengubah data service
    public function update(Request $request, string $id)
    {
        $dataService = DataService::find($id);

        if (!$dataService) {
            return response()->json([
                'success' => false,
                'message' => 'Data service tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'daftar_service_id' => 'required|exists:daftar_services,id|unique:data_services,daftar_service_id,' . $id,
            'estimasi_service' => 'required|numeric|min:0',
            'nama_mekanik' => 'required|string|max:255',
            'sparepart_pengganti' => 'nullable|string|max:255',
        ]);

        $dataService->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data service berhasil diperbarui',
            'data' => $dataService
        ], 200);
    }

    // Menghapus data service
    public function destroy(string $id)
    {
        $dataService = DataService::find($id);

        if (!$dataService) {
            return response()->json([
                'success' => false,
                'message' => 'Data service tidak ditemukan'
            ], 404);
        }

        $dataService->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data service berhasil dihapus'
        ], 200);
    }
}