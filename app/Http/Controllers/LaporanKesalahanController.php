<?php

namespace App\Http\Controllers;

use App\Models\LaporanKesalahan;
use App\Models\Kata;
use App\Models\KataLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\LaporanStatusUpdated;
use Illuminate\Support\Str;

class LaporanKesalahanController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth')->only(['index', 'show', 'update', 'selesai', 'updateKata']);
    //     $this->middleware('role:ahli')->only(['index', 'show', 'update', 'selesai', 'updateKata']);
    // }

    public function index()
    {
        $laporan = LaporanKesalahan::with(['kata', 'user'])->orderBy('created_at', 'desc')->get();
        return view('laporan.index', compact('laporan'));
    }

    public function show($id)
    {
        $laporan = LaporanKesalahan::with(['kata', 'user'])->findOrFail($id);
        return view('laporan.show', compact('laporan'));
    }

    public function update(Request $request, $id)
    {
        $laporan = LaporanKesalahan::findOrFail($id);
        $request->validate([
            'status' => 'required|in:baru,diproses,selesai',
            'catatan_ahli' => 'nullable|string|max:1000',
        ]);

        $laporan->update([
            'status' => $request->status,
            'catatan_ahli' => $request->catatan_ahli,
        ]);

        if ($laporan->user) {
            $laporan->user->notify(new LaporanStatusUpdated($laporan));
        }

        return redirect()->route('laporan_kesalahan.show', $id)
            ->with('success', 'Respon berhasil disimpan.');
    }

    public function selesai($id)
    {
        $laporan = LaporanKesalahan::findOrFail($id);
        $laporan->update([
            'status' => 'selesai',
            'catatan_ahli' => $laporan->catatan_ahli ?? 'Ditandai selesai oleh ahli.',
        ]);

        if ($laporan->user) {
            $laporan->user->notify(new LaporanStatusUpdated($laporan));
        }

        return redirect()->route('laporan_kesalahan.index')
            ->with('success', 'Laporan berhasil ditandai selesai.');
    }

    public function create($kata_id)
    {
        $kata = Kata::findOrFail($kata_id);
        return view('laporan.create', compact('kata'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kata_id' => 'required|exists:kata,id',
            'tipe_kesalahan' => 'required|in:terjemahan,ejaan,arti,contoh_kalimat,media,lainnya',
            'deskripsi' => 'required|string|max:1000',
            'bukti' => 'nullable|image|max:2048',
        ]);

        $buktiPath = null;
        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('bukti_laporan', 'public');
        }

        $pelaporId = Auth::id() ?? Str::uuid()->toString();
        $pelaporType = Auth::check() ? 'App\Models\User' : 'visitor';

        $laporan = LaporanKesalahan::create([
            'user_id' => Auth::id(),
            'kata_id' => $request->kata_id,
            'tipe_kesalahan' => $request->tipe_kesalahan,
            'deskripsi' => $request->deskripsi,
            'bukti_path' => $buktiPath,
            'status' => 'baru',
            'pelapor_id' => $pelaporId,
            'pelapor_type' => $pelaporType,
        ]);

        return redirect()->route('dictionary.show', $request->kata_id)
            ->with('success', 'Laporan kesalahan berhasil dikirim.');
    }

    public function updateKata(Request $request, $id)
    {
        $laporan = LaporanKesalahan::findOrFail($id);
        $request->validate([
            'kata_daerah' => 'required|string|max:255',
        ]);

        $kata = $laporan->kata;
        $oldValue = $kata->kata_daerah;

        $kata->update([
            'kata_daerah' => $request->kata_daerah,
        ]);

        KataLog::create([
            'kata_id' => $kata->id,
            'user_id' => Auth::id(),
            'pelapor_id' => $laporan->pelapor_id,
            'pelapor_type' => $laporan->pelapor_type,
            'field_changed' => 'kata_daerah',
            'old_value' => $oldValue,
            'new_value' => $request->kata_daerah,
            'description' => 'Perubahan berdasarkan laporan kesalahan #' . $laporan->id,
        ]);

        $laporan->update([
            'status' => 'selesai',
            'catatan_ahli' => $laporan->catatan_ahli ?? 'Koreksi diterima: "' . $oldValue . '" diubah menjadi "' . $request->kata_daerah . '"',
        ]);

        if ($laporan->user) {
            $laporan->user->notify(new LaporanStatusUpdated($laporan));
        }

        return redirect()->route('laporan_kesalahan.show', $id)
            ->with('success', 'Entri kata berhasil diperbarui dan laporan ditandai selesai.');
    }

    public function laporanSaya()
    {
        $laporan = LaporanKesalahan::with(['kata'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('laporan.laporan_saya', compact('laporan'));
    }

    public function kataLog()
    {
        $logs = KataLog::with(['kata', 'user'])->orderBy('created_at', 'desc')->get();
        return view('katalog.index', compact('logs'));
    }
}