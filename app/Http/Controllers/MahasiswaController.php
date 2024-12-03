<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MahasiswaExport;

class MahasiswaController extends Controller
{
    // Menampilkan semua data mahasiswa
    public function index()
    {
        // Ambil semua data mahasiswa
        $mahasiswas = Mahasiswa::all();
        // Kirim data ke view
        return view('mahasiswas.index', compact('mahasiswas'));
    }

    // Menampilkan form untuk menambah data mahasiswa
    public function create()
    {
        return view('mahasiswas.create');
    }

    // Menyimpan data mahasiswa baru
    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'nama' => 'required', // Pastikan nama sesuai dengan field pada form
            'npm' => 'required|unique:mahasiswas,npm', // Validasi agar npm unik
            'prodi' => 'required',
        ]);

        // Simpan data mahasiswa
        Mahasiswa::create([
            'nama' => $request->nama,  // Pastikan sesuai dengan field pada database
            'npm' => $request->npm,
            'prodi' => $request->prodi,
        ]);

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit data mahasiswa
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id); // Cari mahasiswa berdasarkan ID
        return view('mahasiswas.edit', compact('mahasiswa'));
    }

    // Memperbarui data mahasiswa
    public function update(Request $request, $id)
    {
        // Validasi inputan
        $request->validate([
            'nama' => 'required',
            'npm' => 'required|unique:mahasiswas,npm,' . $id, // Validasi npm unik kecuali untuk id yang sedang diedit
            'prodi' => 'required',
        ]);

        // Cari mahasiswa berdasarkan ID
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Update data mahasiswa
        $mahasiswa->update([
            'nama' => $request->nama,
            'npm' => $request->npm,
            'prodi' => $request->prodi,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa berhasil diperbarui');
    }

    // Menghapus data mahasiswa
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        
        if ($mahasiswa) {
            $mahasiswa->delete(); // Hapus mahasiswa berdasarkan ID
            return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa berhasil dihapus');
        }

        return redirect()->route('mahasiswas.index')->with('error', 'Mahasiswa tidak ditemukan');
    }


    // Fitur download excel
    public function downloadExcel()
    {
        //buat donlot excel
        return Excel::download(new MahasiswaExport, 'mahasiswa.xlsx');
    }
}
