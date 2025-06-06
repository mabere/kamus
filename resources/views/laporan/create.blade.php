<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-dark mb-6">
                <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>Lapor Kesalahan Kata: {{ $kata->kata_daerah
                }}
            </h2>
            <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="kata_id" value="{{ $kata->id }}">

                <div class="mb-4">
                    <label for="tipe_kesalahan" class="block text-sm font-medium text-gray-700">Tipe Kesalahan</label>
                    <select name="tipe_kesalahan" id="tipe_kesalahan"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                        <option value="terjemahan">Terjemahan</option>
                        <option value="ejaan">Ejaan</option>
                        <option value="arti">Arti</option>
                        <option value="contoh_kalimat">Contoh Kalimat</option>
                        <option value="media">Media (Gambar/Audio)</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                    @error('tipe_kesalahan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Kesalahan</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="bukti" class="block text-sm font-medium text-gray-700">Unggah Bukti (Opsional)</label>
                    <input type="file" name="bukti" id="bukti"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    @error('bukti') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Kirim Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>