<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aspiras;
use Illuminate\Http\Request;

class AktivitasController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('aspirasi_id')) {
            $aktivitas = Aspiras::with('user', 'kategori')
                ->where('id', $request->aspirasi_id)
                ->get();
        } else {
            $aktivitas = Aspiras::with('user', 'kategori')
                ->orderBy('updated_at', 'desc')
                ->limit(20)
                ->get();
        }

        return view('aktivitas', compact('aktivitas'));
    }   
}
