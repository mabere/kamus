<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <h1 class="text-2xl font-bold mb-4">Edit Kata</h1>
        <form method="POST" action="{{ route('kata.update', $kata) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="bahasa_id" class="block text-sm font-medium">Bahasa</label>
                <select name="bahasa_id" class="mt-1 block w-full rounded-md border-gray-300" required>
                    @foreach ($bahasa as $item)
                    <option value="{{ $item->id }}" {{ $kata->bahasa_id == $item->id ? 'selected' : '' }}>{{
                        $item->nama_bahasa }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="kategori_id" class="block text-sm font-medium">Kategori</label>
                <select name="kategori_id" class="mt-1 block w-full rounded-md border-gray-300">
                    <option value="">- Pilih Kategori -</option>
                    @foreach ($kategori as $item)
                    <option value="{{ $item->id }}" {{ $kata->kategori_id == $item->id ? 'selected' : '' }}>{{
                        $item->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="kata_daerah" class="block text-sm font-medium">Kata Daerah</label>
                <input type="text" name="kata_daerah" value="{{ $kata->kata_daerah }}"
                    class="mt-1 block w-full rounded-md border-gray-300" required>
            </div>
            <div class="mb-4">
                <label for="kata_indonesia" class="block text-sm font-medium">Kata Indonesia</label>
                <input type="text" name="kata_indonesia" value="{{ $kata->kata_indonesia }}"
                    class="mt-1 block w-full rounded-md border-gray-300" required>
            </div>
            <div class="mb-4">
                <label for="kata_inggris" class="block text-sm font-medium">Kata Inggris</label>
                <input type="text" name="kata_inggris" value="{{ $kata->kata_inggris }}"
                    class="mt-1 block w-full rounded-md border-gray-300" required>
            </div>
            <div class="mb-4">
                <label for="arti_daerah" class="block text-sm font-medium">Arti Daerah</label>
                <textarea name="arti_daerah"
                    class="mt-1 block w-full rounded-md border-gray-300">{{ $kata->arti_daerah }}</textarea>
            </div>
            <div class="mb-4">
                <label for="arti_indonesia" class="block text-sm font-medium">Arti Indonesia</label>
                <textarea name="arti_indonesia"
                    class="mt-1 block w-full rounded-md border-gray-300">{{ $kata->arti_indonesia }}</textarea>
            </div>
            <div class="mb-4">
                <label for="arti_inggris" class="block text-sm font-medium">Arti Inggris</label>
                <textarea name="arti_inggris"
                    class="mt-1 block w-full rounded-md border-gray-300">{{ $kata->arti_inggris }}</textarea>
            </div>
            <div class="mb-4">
                <label for="gambar" class="block text-sm font-medium">Gambar (opsional)</label>
                @if ($kata->gambar_path)
                <img src="{{ asset('storage/' . $kata->gambar_path) }}" alt="Gambar" class="w-32 mb-2">
                @endif
                <input type="file" name="gambar" class="mt-1 block w-full">
            </div>
            <div class="mb-4">
                <label for="audio" class="block text-sm font-medium">Audio (opsional)</label>
                @if ($kata->audio_path)
                <audio controls src="{{ asset('storage/' . $kata->audio_path) }}" class="mb-2"></audio>
                @endif
                <input type="file" name="audio" class="mt-1 block w-full">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Perbarui</button>
        </form>
    </div>
</x-app-layout>