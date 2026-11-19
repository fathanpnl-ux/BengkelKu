<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    // Menampilkan seluruh data kendaraan
    public function index()
    {
        $kendaraans = Kendaraan::orderBy('id', 'asc')->get();

        return view('kendaraan.index', compact('kendaraans'));
    }

    // Menampilkan form tambah kendaraan
    public function create()
    {
        return view('kendaraan.create');
    }

    // Menyimpan data kendaraan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_plat' => 'required|string|max:20|unique:kendaraans,no_plat',
            'jenis_kendaraan' => 'required|in:Matic,Manual',
            'no_stnk' => 'required|string|max:50|unique:kendaraans,no_stnk',
            'tahun_pembuatan' => 'required|integer|min:1900|max:' . date('Y'),
            'nama_pemilik' => 'required|string|max:255',
            'warna_kendaraan' => 'required|string|max:100',
        ]);

        Kendaraan::create($validated);

        return redirect()->route('kendaraan.index')
            ->with('success', 'Data kendaraan berhasil ditambahkan!');
    }

    // Menampilkan form edit kendaraan
    public function edit(Kendaraan $kendaraan)
    {
        return view('kendaraan.edit', compact('kendaraan'));
    }

    // Memperbarui data kendaraan
    public function update(Request $request, Kendaraan $kendaraan)
    {
        $validated = $request->validate([
            'no_plat' => 'required|string|max:20|unique:kendaraans,no_plat,' . $kendaraan->id,
            'jenis_kendaraan' => 'required|in:Matic,Manual',
            'no_stnk' => 'required|string|max:50|unique:kendaraans,no_stnk,' . $kendaraan->id,
            'tahun_pembuatan' => 'required|integer|min:1900|max:' . date('Y'),
            'nama_pemilik' => 'required|string|max:255',
            'warna_kendaraan' => 'required|string|max:100',
        ]);

        $kendaraan->update($validated);

        return redirect()->route('kendaraan.index')
            ->with('success', 'Data kendaraan berhasil diperbarui!');
    }

    // Menghapus data kendaraan
    public function destroy(Kendaraan $kendaraan)
    {
        if ($kendaraan->daftarServices()->exists()) {
            return redirect()->route('kendaraan.index')
                ->with('error', 'Kendaraan tidak dapat dihapus karena sudah memiliki riwayat service!');
        }

        $kendaraan->delete();

        return redirect()->route('kendaraan.index')
            ->with('success', 'Data kendaraan berhasil dihapus!');
    }
}