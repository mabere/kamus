<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kata;
use App\Models\Bahasa;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

class KataController extends Controller
{
    public function index()
    {
        $kata = Kata::with(['bahasa', 'kategori'])->paginate(10);
        return view('kata.index', compact('kata'));
    }

    public function entry()
    {
        $kata = Kata::with(['bahasa', 'kategori'])->paginate(10);
        return view('kata.entry', compact('kata'));
    }

    public function create()
    {
        $bahasa = Bahasa::all();
        $kategori = Kategori::all();
        return view('kata.create', compact('bahasa', 'kategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bahasa_id' => 'required|exists:bahasa,id',
            'kategori_id' => 'nullable|exists:kategori,id',
            'kata_daerah' => 'required|string|max:100',
            'kata_indonesia' => 'required|string|max:100',
            'kata_inggris' => 'required|string|max:100',
            'arti_daerah' => 'nullable|string',
            'arti_indonesia' => 'nullable|string',
            'arti_inggris' => 'nullable|string',
            'contoh_kalimat_daerah' => 'nullable|string',
            'contoh_kalimat_indonesia' => 'nullable|string',
            'contoh_kalimat_inggris' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,png|max:2048',
            'audio' => 'nullable|mimes:mp3|max:5120',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar_path'] = $request->file('gambar')->store('gambar', 'public');
        }

        if ($request->hasFile('audio')) {
            $validated['audio_path'] = $request->file('audio')->store('audio', 'public');
        }

        Kata::create($validated);

        return redirect()->route('kata.index')->with('success', 'Kata berhasil ditambahkan!');
    }

    public function edit(Kata $kata)
    {
        $bahasa = Bahasa::all();
        $kategori = Kategori::all();
        return view('kata.edit', compact('kata', 'bahasa', 'kategori'));
    }

    public function update(Request $request, Kata $kata)
    {
        $validated = $request->validate([
            'bahasa_id' => 'required|exists:bahasa,id',
            'kategori_id' => 'nullable|exists:kategori,id',
            'kata_daerah' => 'required|string|max:100',
            'kata_indonesia' => 'required|string|max:100',
            'kata_inggris' => 'required|string|max:100',
            'arti_daerah' => 'nullable|string',
            'arti_indonesia' => 'nullable|string',
            'arti_inggris' => 'nullable|string',
            'contoh_kalimat_daerah' => 'nullable|string',
            'contoh_kalimat_indonesia' => 'nullable|string',
            'contoh_kalimat_inggris' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,png|max:2048',
            'audio' => 'nullable|mimes:mp3|max:5120',
        ]);

        if ($request->hasFile('gambar')) {
            if ($kata->gambar_path) {
                Storage::disk('public')->delete($kata->gambar_path);
            }
            $validated['gambar_path'] = $request->file('gambar')->store('gambar', 'public');
        }

        if ($request->hasFile('audio')) {
            if ($kata->audio_path) {
                Storage::disk('public')->delete($kata->audio_path);
            }
            $validated['audio_path'] = $request->file('audio')->store('audio', 'public');
        }

        $kata->update($validated);

        return redirect()->route('kata.index')->with('success', 'Kata berhasil diperbarui!');
    }

    public function destroy(Kata $kata)
    {
        if ($kata->gambar_path) {
            Storage::disk('public')->delete($kata->gambar_path);
        }
        if ($kata->audio_path) {
            Storage::disk('public')->delete($kata->audio_path);
        }
        $kata->delete();

        return redirect()->route('kata.index')->with('success', 'Kata berhasil dihapus!');
    }
}