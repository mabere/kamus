<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <h1 class="text-2xl font-bold mb-4">Daftar Kata</h1>
        @if (session('success'))
        <div class="bg-green-100 p-4 rounded mb-4">{{ session('success') }}</div>
        @endif
        <a href="{{ route('kata.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah
            Kata</a>
        <table class="w-full border-collapse border">
            <thead>
                <tr>
                    <th class="border p-2">Kata Daerah</th>
                    <th class="border p-2">Bahasa</th>
                    <th class="border p-2">Kategori</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kata as $item)
                <tr>
                    <td class="border p-2">{{ $item->kata_daerah }}</td>
                    <td class="border p-2">{{ $item->bahasa->nama_bahasa }}</td>
                    <td class="border p-2">{{ $item->kategori->nama_kategori ?? '-' }}</td>
                    <td class="border p-2">
                        <a href="{{ route('kata.edit', $item) }}" class="text-blue-500">Edit</a>
                        <form action="{{ route('kata.destroy', $item) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500"
                                onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $kata->links() }}
    </div>
</x-app-layout>