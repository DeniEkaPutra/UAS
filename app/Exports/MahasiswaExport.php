<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;

class MahasiswaExport implements FromCollection
{
    public function collection()
    {
        // Ambil semua data mahasiswa dari database
        return Mahasiswa::select('id', 'nama', 'npm', 'prodi')->get();
    }
}
