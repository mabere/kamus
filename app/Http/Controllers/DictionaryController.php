<?php

namespace App\Http\Controllers;

use App\Models\Kata;
use Illuminate\Http\Request;


class DictionaryController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $bahasa_id = $request->input('bahasa_id');

        $kata = Kata::query()
            ->when($query, function ($q) use ($query) {
                return $q->where('kata_daerah', 'like', "%$query%")
                    ->orWhere('kata_indonesia', 'like', "%$query%")
                    ->orWhere('kata_inggris', 'like', "%$query%");
            })
            ->when($bahasa_id, function ($q) use ($bahasa_id) {
                return $q->where('bahasa_id', $bahasa_id);
            })
            ->with(['bahasa', 'kategori'])
            ->orderBy('kata_daerah', 'asc')
            ->paginate(5);

        $bahasa = \App\Models\Bahasa::all();

        return view('dictionary.index', compact('kata', 'bahasa', 'query', 'bahasa_id'));
    }

    public function show(Kata $kata)
    {
        $kata->increment('search_count');
        return view('dictionary.show', compact('kata'));
    }
}