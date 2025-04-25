<?php

// app/Http/Controllers/Dashboard/AmalanController.php

namespace App\Http\Controllers\Dashboard;

use App\Models\Amalan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AmalanController extends Controller
{
    public function index(Request $request)
    {
        $query = Amalan::with('kategoris');
    
        if ($search = $request->input('search')) {
            $query->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $search . '%');
        }
    
        $amalans = $query->latest()->paginate(25);
    
        return view('dashboard.amalan.index', compact('amalans'));
    }
    

    public function create()
    {
        $kategoris = Kategori::all();
        return view('dashboard.amalan.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'link' => 'nullable|url',
            'kategoris' => 'required|array'
        ]);

        $amalan = Amalan::create($validated);
        $amalan->kategoris()->attach($validated['kategoris']);

        return redirect()->route('amalan.index')->with('success', 'Amalan ditambahkan.');
    }

    public function edit(Amalan $amalan)
    {
        $kategoris = Kategori::all();
        return view('dashboard.amalan.edit', compact('amalan', 'kategoris'));
    }

    public function update(Request $request, Amalan $amalan)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'link' => 'nullable|url',
            'kategoris' => 'required|array'
        ]);

        $amalan->update($validated);
        $amalan->kategoris()->sync($validated['kategoris']);

        return redirect()->route('amalan.index')->with('success', 'Amalan diperbarui.');
    }

    public function destroy(Amalan $amalan)
    {
        $amalan->delete();
        return redirect()->route('amalan.index')->with('success', 'Amalan dihapus.');
    }
}
