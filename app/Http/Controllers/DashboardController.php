<?php

namespace App\Http\Controllers;

use App\Models\Kata;
use App\Models\Bahasa;
use App\Models\Kategori;
use App\Models\UsulanKata;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Section 1: Informasi Usulan Umum
        $totalUsulan = UsulanKata::count();
        $approvedUsulan = UsulanKata::where('status', 'approved')->count();
        $rejectedUsulan = UsulanKata::where('status', 'rejected')->count();
        $pendingUsulan = UsulanKata::where('status', 'pending')->count();

        // Section 2: Jumlah Usulan 6 Bulan Terakhir (Kompatibel dengan SQLite)
        $usulanPerBulanRaw = UsulanKata::selectRaw("strftime('%m', created_at) as month, COUNT(*) as total")
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $usulanPerBulan = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i)->month;
            $monthStr = sprintf("%02d", $month);
            $usulanPerBulan[$monthStr] = $usulanPerBulanRaw[$monthStr] ?? 0;
        }

        // Section 3: Top 5 Kata Populer yang Dicari
        $kataPopuler = Kata::select('kata_daerah', 'bahasa_id', DB::raw('search_count'))
            ->orderBy('search_count', 'desc')
            ->take(5)
            ->with('bahasa')
            ->get();

        // Section 4: Top Kategori Kata yang Diusulkan
        $kategoriPopuler = UsulanKata::select('kategori_id')
            ->whereNotNull('kategori_id')
            ->groupBy('kategori_id')
            ->orderByRaw('COUNT(*) DESC')
            ->take(5)
            ->pluck('kategori_id')
            ->toArray();

        $kategoriData = UsulanKata::select('kategori_id', DB::raw('COUNT(*) as total'))
            ->whereIn('kategori_id', $kategoriPopuler)
            ->whereNotNull('kategori_id')
            ->groupBy('kategori_id')
            ->orderByRaw('COUNT(*) DESC')
            ->pluck('total', 'kategori_id')
            ->toArray();

        $kategoriNames = Kategori::whereIn('id', $kategoriPopuler)->pluck('nama_kategori', 'id')->toArray();

        // Pastikan $kategoriNames selaras dengan $kategoriData
        $kategoriLabels = [];
        foreach ($kategoriData as $id => $total) {
            $kategoriLabels[] = $kategoriNames[$id] ?? 'Unknown';
        }

        return view('dashboard.index', [
            'totalUsulan' => $totalUsulan,
            'approvedUsulan' => $approvedUsulan,
            'rejectedUsulan' => $rejectedUsulan,
            'pendingUsulan' => $pendingUsulan,
            'usulanPerBulan' => $usulanPerBulan,
            'kataPopuler' => $kataPopuler,
            'kategoriData' => $kategoriData,
            'kategoriNames' => $kategoriNames,
            'kategoriLabels' => $kategoriLabels,
        ]);
    }
}