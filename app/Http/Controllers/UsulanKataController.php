<?php

namespace App\Http\Controllers;

use App\Models\UsulanKata;
use App\Models\Kata;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsulanKataController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('role:contributor')->only(['create', 'store']);
    //     $this->middleware('role:ahli')->only(['index', 'review', 'approve', 'reject']);
    // }

    public function index()
    {
        $usulan = UsulanKata::with(['user', 'bahasa', 'kategori'])->where('status', 'pending')->paginate(10);
        return view('usulan-kata.index', compact('usulan'));
    }

    public function create()
    {
        $bahasa = \App\Models\Bahasa::all();
        $kategori = \App\Models\Kategori::all();
        return view('usulan-kata.create', compact('bahasa', 'kategori'));
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

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending';

        $usulan = UsulanKata::create($validated);

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'usulan-kata_id' => $usulan->id,
            'aksi' => 'usulan',
            'deskripsi' => 'Mengusulkan kata: ' . $usulan->kata_daerah,
        ]);

        return redirect()->route('usulan_kata.index')->with('success', 'Usulan kata berhasil dikirim!');
    }

    public function show($id)
    {
        $usulanKata = UsulanKata::with(['bahasa', 'kategori', 'user'])->findOrFail($id);
        return view('usulan-kata.show', compact('usulanKata'));
    }

    public function edit($id)
    {
        $usulanKata = UsulanKata::findOrFail($id);

        // Opsional: Hanya izinkan pengusul yang bisa edit
        if ($usulanKata->user_id !== auth()->id()) {
            abort(403, 'Anda tidak diizinkan mengedit usulan ini.');
        }

        $bahasa = \App\Models\Bahasa::all();
        $kategori = \App\Models\Kategori::all();

        return view('usulan-kata.edit', compact('usulanKata', 'bahasa', 'kategori'));
    }


    public function update(Request $request, $id)
    {
        $usulan = UsulanKata::findOrFail($id);

        if ($usulan->user_id !== auth()->id()) {
            abort(403, 'Anda tidak diizinkan mengubah usulan ini.');
        }

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
            // hapus file lama jika ada
            if ($usulan->gambar_path) {
                \Storage::disk('public')->delete($usulan->gambar_path);
            }
            $validated['gambar_path'] = $request->file('gambar')->store('gambar', 'public');
        }

        if ($request->hasFile('audio')) {
            if ($usulan->audio_path) {
                \Storage::disk('public')->delete($usulan->audio_path);
            }
            $validated['audio_path'] = $request->file('audio')->store('audio', 'public');
        }

        $usulan->update($validated);

        return redirect()->route('usulan_kata.index')->with('success', 'Usulan kata berhasil diperbarui!');
    }


    public function review(UsulanKata $usulan)
    {
        return view('usulan-kata.review', compact('usulan'));
    }

    public function approve(Request $request, UsulanKata $usulan)
    {
        $validated = $request->validate([
            'catatan_ahli' => 'nullable|string',
        ]);

        $kataData = [
            'bahasa_id' => $usulan->bahasa_id,
            'kategori_id' => $usulan->kategori_id,
            'kata_daerah' => $usulan->kata_daerah,
            'kata_indonesia' => $usulan->kata_indonesia,
            'kata_inggris' => $usulan->kata_inggris,
            'arti_daerah' => $usulan->arti_daerah,
            'arti_indonesia' => $usulan->arti_indonesia,
            'arti_inggris' => $usulan->arti_inggris,
            'contoh_kalimat_daerah' => $usulan->contoh_kalimat_daerah,
            'contoh_kalimat_indonesia' => $usulan->contoh_kalimat_indonesia,
            'contoh_kalimat_inggris' => $usulan->contoh_kalimat_inggris,
            'gambar_path' => $usulan->gambar_path,
            'audio_path' => $usulan->audio_path,
        ];

        $kata = Kata::create($kataData);

        $usulan->update([
            'status' => 'approved',
            'catatan_ahli' => $validated['catatan_ahli'],
        ]);

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'kata_id' => $kata->id,
            'usulan-kata_id' => $usulan->id,
            'aksi' => 'approve',
            'deskripsi' => 'Menyetujui usulan kata: ' . $usulan->kata_daerah,
        ]);

        return redirect()->route('usulan_kata.index')->with('success', 'Usulan kata disetujui!');
    }

    public function reject(Request $request, UsulanKata $usulan)
    {
        $validated = $request->validate([
            'catatan_ahli' => 'required|string',
        ]);

        if ($usulan->gambar_path) {
            Storage::disk('public')->delete($usulan->gambar_path);
        }
        if ($usulan->audio_path) {
            Storage::disk('public')->delete($usulan->audio_path);
        }

        $usulan->update([
            'status' => 'rejected',
            'catatan_ahli' => $validated['catatan_ahli'],
        ]);

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'usulan_kata_id' => $usulan->id,
            'aksi' => 'reject',
            'deskripsi' => 'Menolak usulan kata: ' . $usulan->kata_daerah,
        ]);

        return redirect()->route('usulan_kata.index')->with('success', 'Usulan kata ditolak!');
    }
}