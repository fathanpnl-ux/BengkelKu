<?php

namespace App\Http\Controllers;

use App\Models\PembayaranService;
use App\Models\DaftarService;
use App\Models\DataService;
use Illuminate\Http\Request;

class PembayaranServiceController extends Controller
{
    // Menampilkan seluruh data pembayaran
    public function index()
    {
        $pembayaranServices = PembayaranService::with([
            'daftarService.pelanggan',
            'daftarService.kendaraan'
        ])->orderBy('id', 'asc')->get();

        return view('pembayaran_service.index', compact(
            'pembayaranServices'
        ));
    }

    // Menampilkan form tambah pembayaran
    public function create()
    {
        $dataServices = DataService::with([
            'daftarService.pelanggan',
            'daftarService.kendaraan'
        ])->orderBy('id', 'asc')->get();

        return view('pembayaran_service.create', compact(
            'dataServices'
        ));
    }

    // Menyimpan pembayaran baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'daftar_service_id' => [
                'required',
                'exists:data_services,daftar_service_id',
                'unique:pembayaran_services,daftar_service_id'
            ],
            'jumlah_biaya' => 'required|numeric|min:0',
            'jenis_pembayaran' => 'nullable|in:Cash,Non Tunai',
            'keterangan' => 'nullable|string',
        ]);

        PembayaranService::create($validated);

        return redirect()->route('pembayaran-service.index')
            ->with('success', 'Pembayaran berhasil disimpan!');
    }

    // Menampilkan form edit pembayaran
    public function edit(PembayaranService $pembayaranService)
    {
        $dataServices = DataService::with([
            'daftarService.pelanggan',
            'daftarService.kendaraan'
        ])->orderBy('id', 'asc')->get();

        return view('pembayaran_service.edit', compact(
            'pembayaranService',
            'dataServices'
        ));
    }

    // Memperbarui pembayaran
    public function update(Request $request, PembayaranService $pembayaranService)
    {
        $validated = $request->validate([
            'daftar_service_id' => [
                'required',
                'exists:data_services,daftar_service_id',
                'unique:pembayaran_services,daftar_service_id,' . $pembayaranService->id
            ],
            'jumlah_biaya' => 'required|numeric|min:0',
            'jenis_pembayaran' => 'nullable|in:Cash,Non Tunai',
            'keterangan' => 'nullable|string',
        ]);

        $pembayaranService->update($validated);

        return redirect()->route('pembayaran-service.index')
            ->with('success', 'Pembayaran berhasil diperbarui!');
    }

    // Menghapus pembayaran
    public function destroy(PembayaranService $pembayaranService)
    {
        $pembayaranService->delete();

        return redirect()->route('pembayaran-service.index')
            ->with('success', 'Data pembayaran berhasil dihapus!');
    }
}