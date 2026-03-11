<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    public function index()
    {
        return view('dashboardSiswa.index');
    }   

public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv'
    ]);

    Excel::import(new UsersImport, $request->file('file'));

    return redirect()->back()->with('success', 'Data berhasil diimport');
}
}
