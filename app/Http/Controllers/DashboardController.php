<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kategori;

class DashboardController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('index', compact('kategori'));
    }
}
