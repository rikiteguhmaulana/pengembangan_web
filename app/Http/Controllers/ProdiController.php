<?php

namespace App\Http\Controllers;

use App\Models\Prodi;  // Menghubungkan ke model Prodi
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    // Function index untuk menampilkan halaman index prodi
    public function index()
    {
        $prodis = Prodi::orderBy('id', 'desc')->get(); // Mengambil semua data prodi
        return view('prodi.index', compact('prodis'));  // Mengarahkan ke view prodi/index.blade.php
    }

    // Function untuk menampilkan halaman tambah prodi
    public function create()
    {
        return view('prodi.create'); // Mengarahkan ke view prodi/create.blade.php
    }

    // Function untuk menyimpan data prodi
    public function save(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required'
        ]);

        // Membuat data prodi baru
        Prodi::create([
            'nama' => $request->nama
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('prodi.index')->with('success', 'Program Studi berhasil ditambahkan');
    }

    // Function untuk menampilkan halaman edit prodi
    public function edit($id)
    {
        $prodi = Prodi::findOrFail($id); // Mencari prodi berdasarkan ID
        return view('prodi.edit', compact('prodi')); // Mengarahkan ke view prodi/edit.blade.php
    }

    // Function untuk memperbarui data prodi
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required'
        ]);

        $prodi = Prodi::findOrFail($id); // Mencari prodi berdasarkan ID
        $prodi->update([
            'nama' => $request->nama
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('prodi.index')->with('success', 'Program Studi berhasil diperbarui');
    }

    // Function untuk menghapus data prodi
    public function delete($id)
    {
        $prodi = Prodi::findOrFail($id); // Mencari prodi berdasarkan ID
        $prodi->delete(); // Menghapus prodi

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('prodi.index')->with('success', 'Program Studi berhasil dihapus');
    }
}
