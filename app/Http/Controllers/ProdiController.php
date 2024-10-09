<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    // Menampilkan daftar program studi (tampilan index)
    public function index()
    {
        $prodis = Prodi::orderBy('id', 'desc')->get();
        return view('prodi.index', compact('prodis'));
    }

    // Menampilkan form untuk tambah program studi (tampilan create)
    public function create()
    {
        return view('prodi.create');
    }

    // Menyimpan data program studi baru (fungsi save)
    public function save(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required'
        ]);

        // Menyimpan data ke tabel prodis
        Prodi::create([
            'nama' => $request->nama
        ]);

        // Redirect ke halaman daftar prodi dengan pesan sukses
        return redirect()->route('prodi.index')->with('success', 'Program Studi berhasil ditambahkan');
    }
    public function edit($id)
    {
        $prodi = Prodi::findOrFail($id);
        return view('prodi.edit', compact('prodi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        $prodi = Prodi::findOrFail($id);
        $prodi->update([
            'nama' => $request->nama
        ]);

        return redirect()->route('prodi')->with('success', 'Program Studi berhasil diupdated');
    }
    public function delete($id)
    {
        $prodi = Prodi::findOrFail($id);
        $prodi->delete();

        return redirect()->route('prodi')->with('success', 'Data Program Studi berhasil dihapus');
    }
}
