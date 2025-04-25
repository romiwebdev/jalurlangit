<?php

namespace App\Http\Controllers;

use App\Models\Amalan;
use App\Models\Kategori;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
        // Inisialisasi query
        $query = Amalan::with('kategoris');
    
        // Search by title
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('judul', 'like', '%'.$searchTerm.'%')
                  ->orWhere('deskripsi', 'like', '%'.$searchTerm.'%');
            });
        }
    
        // Filter by category
        if ($request->filled('kategori')) {
            $query->whereHas('kategoris', function($q) use ($request) {
                $q->where('kategoris.id', $request->kategori);
            });
        }
    
        // Get paginated results
        $amalans = $query->orderBy('created_at', 'desc')->paginate(25)->withQueryString();
    
        // Get all categories for filter dropdown
        $kategoris = Kategori::orderBy('nama')->get();
    
        return view('frontend.index', compact('amalans', 'kategoris'));
    }
    

    public function show($id)
    {
        $amalan = Amalan::with('kategoris')->findOrFail($id);
        return view('frontend.detail', compact('amalan'));
    }

    public function favorit(Request $request)
    {
        $ids = json_decode($request->get('ids', '[]'), true) ?? [];

        $amalans = Amalan::with('kategoris')
            ->whereIn('id', $ids)
            ->paginate(25);

        return view('frontend.favorit', compact('amalans'));
    }
}