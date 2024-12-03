<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MahasiswaExport;

class MahasiswaController extends Controller
{
    public function index()
    {
        // Menampilkan semua data mahasiswa
        $mahasiswas = Mahasiswa::all();
        return view('mahasiswas.index', compact('mahasiswas'));
    }

    public function create()
    {
        return view('mahasiswas.create');
    }

    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'nama' => 'required',
            'npm' => 'required|unique:mahasiswas',
            'prodi' => 'required',
        ]);

        // Simpan data mahasiswa
        Mahasiswa::create($request->all());

        return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    public function downloadExcel()
    {
        // Fitur download excel
        return Excel::download(new MahasiswaExport, 'mahasiswa.xlsx');
    }
}
