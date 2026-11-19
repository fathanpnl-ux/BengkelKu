<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PembayaranService;
use Illuminate\Http\Request;

class PembayaranServiceController extends Controller
{
    // Menampilkan semua data pembayaran
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Data pembayaran berhasil ditampilkan',
            'data' => PembayaranService::all()
        ], 200);
    }

    // Menambahkan data pembayaran
    public function store(Request $request)
    {
        $validated = $request->validate([
            'daftar_service_id' => 'required|exists:daftar_services,id|unique:pembayaran_services,daftar_service_id',
            'jumlah_biaya' => 'required|numeric|min:0',
            'jenis_pembayaran' => 'nullable|in:Cash,Non Tunai',
            'keterangan' => 'nullable|string',
        ]);

        $pembayaran = PembayaranService::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data pembayaran berhasil ditambahkan',
            'data' => $pembayaran
        ], 201);
    }

    // Menampilkan detail pembayaran
    public function show(string $id)
    {
        $pembayaran = PembayaranService::find($id);

        if (!$pembayaran) {
            return response()->json([
                'success' => false,
                'message' => 'Data pembayaran tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail pembayaran berhasil ditampilkan',
            'data' => $pembayaran
        ], 200);
    }

    // Mengubah data pembayaran
    public function update(Request $request, string $id)
    {
        $pembayaran = PembayaranService::find($id);

        if (!$pembayaran) {
            return response()->json([
                'success' => false,
                'message' => 'Data pembayaran tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'daftar_service_id' => 'required|exists:daftar_services,id|unique:pembayaran_services,daftar_service_id,' . $id,
            'jumlah_biaya' => 'required|numeric|min:0',
            'jenis_pembayaran' => 'nullable|in:Cash,Non Tunai',
            'keterangan' => 'nullable|string',
        ]);

        $pembayaran->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data pembayaran berhasil diperbarui',
            'data' => $pembayaran
        ], 200);
    }

    // Menghapus data pembayaran
    public function destroy(string $id)
    {
        $pembayaran = PembayaranService::find($id);

        if (!$pembayaran) {
            return response()->json([
                'success' => false,
                'message' => 'Data pembayaran tidak ditemukan'
            ], 404);
        }

        $pembayaran->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pembayaran berhasil dihapus'
        ], 200);
    }
}