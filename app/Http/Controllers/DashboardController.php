<?php

namespace App\Http\Controllers;

use App\Models\Amalan;
use App\Models\Kategori;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahAmalan = Amalan::count();
        $jumlahKategori = Kategori::count();

        $kategoriTerpopuler = Kategori::withCount('amalans')
            ->orderByDesc('amalans_count')
            ->first();

        $lastUpdated = Carbon::now();

        $aktivitas = [
            [
                'judul' => 'Amalan baru ditambahkan',
                'waktu' => '2 jam yang lalu',
                'icon' => 'fa-edit',
                'icon_bg' => 'bg-green-500',
            ],
            [
                'judul' => 'Amalan diperbarui',
                'waktu' => 'Kemarin, 15:32',
                'icon' => 'fa-edit',
                'icon_bg' => 'bg-green-500',
            ],
        ];

        return view('dashboard.index', compact(
            'jumlahAmalan',
            'jumlahKategori',
            'kategoriTerpopuler',
            'lastUpdated',
            'aktivitas'
        ));
    }
}
