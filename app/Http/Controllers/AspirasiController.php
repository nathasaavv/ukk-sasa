<?php

namespace App\Http\Controllers;

use App\Models\Aspiras;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Kategori;

class AspirasiController extends Controller
{
    /**
     * Show list of aspirasi.
     */
    public function index(Request $request)
    {
        $query = Aspiras::with(['kategori', 'user']);
        
        // Filter berdasarkan role
        if (auth()->user()->role === 'siswa') {
            $query->where('user_id', auth()->id());
        }
        
        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }
        
        // Filter berdasarkan siswa (hanya untuk admin)
        if ($request->filled('siswa') && auth()->user()->role === 'admin') {
            $query->where('user_id', $request->siswa);
        }
        
        // Filter berdasarkan tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }
        
        // Filter berdasarkan bulan
        if ($request->filled('bulan')) {
            $parts = explode('-', $request->bulan);
            if (count($parts) == 2) {
                $query->whereYear('created_at', $parts[0])
                      ->whereMonth('created_at', $parts[1]);
            }
        }
        
        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter Pencarian Global (q)
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('feedback', 'LIKE', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'LIKE', "%{$search}%")
                                ->orWhere('nis', 'LIKE', "%{$search}%");
                  })
                  ->orWhereHas('kategori', function($kategoriQuery) use ($search) {
                      $kategoriQuery->where('nama', 'LIKE', "%{$search}%");
                  });
            });
        }
        
        $aspirasis = $query->where('is_archive', false)->get();
        
        // Data untuk filter dropdown
        $kategoris = Kategori::all();
        $siswa = auth()->user()->role === 'admin' ? User::where('role', 'siswa')->get() : collect();
        $months = Aspiras::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month')
                    ->distinct()
                    ->orderByRaw('YEAR(created_at) DESC, MONTH(created_at) DESC')
                    ->get();
        
        return view('aspirasi.index', compact('aspirasis', 'kategoris', 'siswa', 'months'));
    }

    public function create()
    {
        $kategori = Kategori::where('status', 1)->get();

        return view('aspirasi.create', compact('kategori'));
    }

    public function store(Request $request)
    {  
        $user = auth()->user();
        $request->merge(['user_id' => $user->id]);

        $validate = $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'feedback' => 'required',
            'user_id' => 'required|exists:users,id',
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

    public function editStatus($id)
    {
        $aspirasi = Aspiras::with(['user', 'kategori'])->findOrFail($id);
        return view('aspirasi.edit-status', compact('aspirasi'));
    }

    public function updateStatus(Request $request, $id)
    {
        $aspirasi = Aspiras::findOrFail($id);
        $validate = $request->validate([
            'status' => 'required|in:Menunggu,Diproses,Selesai',
            'feedback_admin' => 'nullable|string',
        ]);
        $aspirasi->update($validate);

        return redirect()->route('aspirasi.show', $id)->with('success', 'Status aspirasi berhasil diupdate!');
    }


    public function archive ()
    {
        // $aspirasi = Aspiras::findOrFail($id);
        // $aspirasi->delete();

        $aspirasis = Aspiras::where('is_archive', true)->get();
        return view('archive.index', compact('aspirasis'));
    }

    public function archiveAspirasi($id)
    {
        $aspirasi = Aspiras::findOrFail($id);
        $aspirasi->is_archive = true;
        $aspirasi->save();

        return redirect()->route('aspirasi.index')->with('success', 'Aspirasi berhasil diarsipkan!');
    }

    public function unarchiveAspirasi($id)
    {
        $aspirasi = Aspiras::findOrFail($id);
        $aspirasi->is_archive = false;
        $aspirasi->save();

        return redirect()->route('archive.index')->with('success', 'Aspirasi berhasil dipulihkan!');
    }
}
