<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Aspiras;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $query = Aspiras::query();

        // Filter based on role
        if ($user->role === 'siswa') {
            $query->where('user_id', $user->id);
        }

        // Total aspirasi
        $totalAspirasi = $query->count();
        
        // Stats by status
        $menunggu = (clone $query)->where('status', 'Menunggu')->count();
        $diproses = (clone $query)->where('status', 'Diproses')->count();
        $selesai = (clone $query)->where('status', 'Selesai')->count();
        $arsip = (clone $query)->where('is_archive', true)->count();
        
        // Percentages
        $persentaseSelesai = $totalAspirasi > 0 ? round(($selesai / $totalAspirasi) * 100) : 0;
        $persentaseMenunggu = $totalAspirasi > 0 ? round(($menunggu / $totalAspirasi) * 100) : 0;
        $persentaseDiproses = $totalAspirasi > 0 ? round(($diproses / $totalAspirasi) * 100) : 0;
        
        // Weekly Data based on role
        $dataMingguan = [];
        $labelMingguan = [];
        for ($i = 6; $i >= 0; $i--) {
            $day = now()->subDays($i);
            $date = $day->format('Y-m-d');
            
            $dayQuery = Aspiras::whereDate('created_at', $date);
            if ($user->role === 'siswa') {
                $dayQuery->where('user_id', $user->id);
            }
            
            $dataMingguan[] = $dayQuery->count();
            $labelMingguan[] = $day->format('D');
        }

        // Recent Aspirations (contextual)
        $aspirasiTerbaru = Aspiras::with(['user', 'kategori'])
            ->where('is_archive', false);
        
        if ($user->role === 'siswa') {
            $aspirasiTerbaru->where('user_id', $user->id);
        }

        $aspirasiTerbaru = $aspirasiTerbaru->latest()->take(5)->get();
        
        return view('index', compact(
            'totalAspirasi',
            'menunggu',
            'diproses',
            'selesai',
            'persentaseSelesai',
            'persentaseMenunggu',
            'persentaseDiproses',
            'dataMingguan',
            'labelMingguan',
            'aspirasiTerbaru',
            'arsip'
        ));
    }
}
