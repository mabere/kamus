<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <h1 class="text-3xl font-bold mb-4">Kamus Bahasa Daerah</h1>

        <!-- Form Pencarian -->
        <form method="GET" action="{{ route('dictionary.index') }}" class="mb-6">
            <div class="flex gap-4">
                <input type="text" name="query" value="{{ $query ?? '' }}" placeholder="Cari kata..."
                    class="w-full rounded-md border-gray-300 p-2">
                <select name="bahasa_id" class="rounded-md border-gray-300 p-2">
                    <option value="">Semua Bahasa</option>
                    @foreach ($bahasa as $item)
                    <option value="{{ $item->id }}" {{ $bahasa_id==$item->id ? 'selected' : '' }}>{{ $item->nama_bahasa
                        }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Cari</button>
            </div>
        </form>

        <!-- Daftar Kata -->
        @if ($kata->isEmpty())
        <p>Tidak ada kata ditemukan.</p>
        @else
        <div class="grid gap-4">
            @foreach ($kata as $item)
            <div class="border p-4 rounded">
                <a href="{{ route('dictionary.show', $item) }}" class="text-lg font-semibold">{{ $item->kata_daerah
                    }}</a>
                <p><strong>Bahasa:</strong> {{ $item->bahasa->nama_bahasa }}</p>
                <p><strong>Kategori:</strong> {{ $item->kategori->nama_kategori ?? '-' }}</p>
                <p><strong>Arti (Indonesia):</strong> {{ $item->arti_indonesia ?? '-' }}</p>
            </div>
            @endforeach
        </div>
        {{ $kata->links() }}
        @endif
    </div>
</x-app-layout>