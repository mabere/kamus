<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <h1 class="text-2xl font-bold mb-4">Edit Usulan Kata</h1>

        <form method="POST" action="{{ route('usulan_kata.update', $usulanKata->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="bahasa_id" class="block text-sm font-medium">Bahasa</label>
                <select name="bahasa_id" class="mt-1 block w-full rounded-md border-gray-300">
                    @foreach ($bahasa as $item)
                    <option value="{{ $item->id }}" {{ $usulanKata->bahasa_id == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_bahasa }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="kategori_id" class="block text-sm font-medium">Kategori</label>
                <select name="kategori_id" class="mt-1 block w-full rounded-md border-gray-300">
                    <option value="">- Pilih Kategori -</option>
                    @foreach ($kategori as $item)
                    <option value="{{ $item->id }}" {{ $usulanKata->kategori_id == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_kategori }}
                    </option>
                    @endforeach
                </select>
            </div>

            @foreach (['kata_daerah', 'kata_indonesia', 'kata_inggris'] as $field)
            <div class="mb-4">
                <label for="{{ $field }}" class="block text-sm font-medium">{{ ucfirst(str_replace('_', ' ', $field))
                    }}</label>
                <input type="text" name="{{ $field }}" value="{{ old($field, $usulanKata->$field) }}"
                    class="mt-1 block w-full rounded-md border-gray-300" required>
            </div>
            @endforeach

            @foreach (['arti_daerah', 'arti_indonesia', 'arti_inggris', 'contoh_kalimat_daerah',
            'contoh_kalimat_indonesia', 'contoh_kalimat_inggris'] as $field)
            <div class="mb-4">
                <label for="{{ $field }}" class="block text-sm font-medium">{{ ucfirst(str_replace('_', ' ', $field))
                    }}</label>
                <textarea name="{{ $field }}"
                    class="mt-1 block w-full rounded-md border-gray-300">{{ old($field, $usulanKata->$field) }}</textarea>
            </div>
            @endforeach

            <div class="mb-4">
                <label for="gambar" class="block text-sm font-medium">Gambar (opsional)</label>
                @if ($usulanKata->gambar_path)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $usulanKata->gambar_path) }}" class="h-24">
                </div>
                @endif
                <input type="file" name="gambar" class="mt-1 block w-full">
            </div>

            <div class="mb-4">
                <label for="audio" class="block text-sm font-medium">Audio (opsional)</label>
                @if ($usulanKata->audio_path)
                <div class="mb-2">
                    <audio controls>
                        <source src="{{ asset('storage/' . $usulanKata->audio_path) }}" type="audio/mp3">
                    </audio>
                </div>
                @endif
                <input type="file" name="audio" class="mt-1 block w-full">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Perbarui Usulan</button>
        </form>
    </div>
</x-app-layout>