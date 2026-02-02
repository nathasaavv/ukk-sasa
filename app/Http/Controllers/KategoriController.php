<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        return view('kategori.index');
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama' => 'required',
            'ket_kategori' => 'required',

        ]);

        Kategori::create($validate);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }
}
