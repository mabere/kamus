<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-dark mb-6">
                <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>Detail Laporan Kesalahan
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-500">Kata</p>
                    <p class="text-lg font-medium">{{ $laporan->kata->kata_daerah }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Pelapor</p>
                    <p class="text-lg font-medium">{{ $laporan->user ? $laporan->user->name : 'Pengunjung (ID: ' .
                        $laporan->pelapor_id . ')' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tipe Kesalahan</p>
                    <p class="text-lg font-medium">{{ ucfirst($laporan->tipe_kesalahan) }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status</p>
                    <p class="text-lg font-medium">
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $laporan->status == 'baru' ? 'bg-red-100 text-red-800' : ($laporan->status == 'diproses' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                            {{ ucfirst($laporan->status) }}
                        </span>
                    </p>
                </div>
                <div class="col-span-2">
                    <p class="text-sm text-gray-500">Deskripsi Kesalahan</p>
                    <p class="text-lg">{{ $laporan->deskripsi }}</p>
                </div>
                @if ($laporan->bukti_path)
                <div class="col-span-2">
                    <p class="text-sm text-gray-500">Bukti</p>
                    <img src="{{ Storage::url($laporan->bukti_path) }}" alt="Bukti" class="max-w-xs rounded-md">
                </div>
                @endif
            </div>

            <hr class="my-6">

            @if($laporan->status != 'selesai')
            <h3 class="text-lg font-bold text-dark mb-4">Perbarui Entri Kata</h3>
            <form action="{{ route('laporan_kesalahan.update_kata', $laporan->id) }}" method="POST" class="mb-6">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="kata_daerah" class="block text-sm font-medium text-gray-700">Koreksi Kata</label>
                    <input type="text" name="kata_daerah" id="kata_daerah" value="{{ $laporan->kata->kata_daerah }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                    @error('kata_daerah') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                        Terima dan Perbarui Kata
                    </button>
                </div>
            </form>

            <hr class="my-6">
            @endif

            <h3 class="text-lg font-bold text-dark mb-4">Respon Ahli</h3>
            <form action="{{ route('laporan_kesalahan.update', $laporan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                        <option value="baru" {{ $laporan->status == 'baru' ? 'selected' : '' }}>Baru</option>
                        <option value="diproses" {{ $laporan->status == 'diproses' ? 'selected' : '' }}>Diproses
                        </option>
                        <option value="selesai" {{ $laporan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="catatan_ahli" class="block text-sm font-medium text-gray-700">Catatan Ahli</label>
                    <textarea name="catatan_ahli" id="catatan_ahli" rows="4"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">{{ $laporan->catatan_ahli ?? old('catatan_ahli') }}</textarea>
                    @error('catatan_ahli') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Simpan Respon
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>