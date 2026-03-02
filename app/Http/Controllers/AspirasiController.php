<?php

namespace App\Http\Controllers;

use App\Models\Aspiras;
use Illuminate\Http\Request;
use App\Models\Kategori;

class AspirasiController extends Controller
{
    /**
     * Show list of aspirasi.
     */
    public function index()
    {
        $aspirasis = Aspiras::with(['kategori', 'user'])->get();
        return view('aspirasi.index', compact('aspirasis'));
    }

    public function create()
    {
        $kategori = Kategori::all();

        return view('aspirasi.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'feedback' => 'required',
        ]);

        Aspiras::create($validate);

        return redirect()->route('aspirasi.index')->with('success', 'Aspirasi berhasil disimpan!');
    }

    public function edit($id)
    {
        $aspirasi = Aspiras::findOrFail($id);
        $kategori = Kategori::all();
        return view('aspirasi.edit', compact('aspirasi', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $aspirasi = Aspiras::findOrFail($id);
        $validate = $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'feedback' => 'required',
        ]);
        $aspirasi->update($validate);

        return redirect()->route('aspirasi.index')->with('success', 'Aspirasi berhasil diupdate!');
    }

    public function show($id)
    {
        $aspirasi = Aspiras::with(['user', 'kategori'])->findOrFail($id);
        return view('aspirasi.show', compact('aspirasi'));
    }

   
}
