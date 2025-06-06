<x-app-layout>
    <!-- Header -->
    <div class="bg-white shadow-sm">
        <div class="max-w-5xl mx-auto px-4 py-5 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-dark">
                    <i class="fas fa-clipboard-check mr-2 text-primary"></i>Review Usulan Kata
                </h1>
                <p class="text-sm text-gray-500 mt-1">Tinjau dan berikan keputusan untuk usulan kata baru</p>
            </div>
            <a href="{{ route('usulan_kata.index') }}"
                class="flex items-center text-sm font-medium text-gray-600 hover:text-primary transition-colors">
                <i class="fas fa-reply mr-1"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-5xl mx-auto px-4 py-6">
        <!-- Card Info Usulan -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 mb-8">
            <!-- Header Card -->
            <div class="bg-gradient-to-r from-primary to-secondary px-6 py-4">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <h2 class="text-xl font-bold text-white">{{ $usulan->kata_daerah }}</h2>
                        <div class="flex items-center mt-1">
                            <span class="bg-white bg-opacity-20 px-2 py-1 rounded-full text-xs text-white">Bahasa
                                Jawa</span>
                            <span class="bg-white bg-opacity-20 px-2 py-1 rounded-full text-xs text-white ml-2">{{
                                $usulan->kategori->nama_kategori }}</span>
                        </div>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-lg px-3 py-1">
                        <span class="text-white font-medium">Status:
                            <span class="font-normal bg-yellow-500 text-white px-2 py-0.5 rounded-full ml-1 text-xs">{{
                                $usulan->status }}</span>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Body Card -->
            <div class="p-6">
                <!-- Info Pengusul -->
                <div class="flex items-center mb-6 p-3 bg-gray-50 rounded-lg">
                    <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white mr-3">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">Diusulkan oleh</p>
                        <p class="font-semibold">{{ $usulan->user->name }}</p>
                    </div>
                </div>

                <!-- Kata dalam berbagai bahasa -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-dark mb-4 flex items-center">
                        <i class="fas fa-language mr-2 text-primary"></i>Kata
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{
                                    $usulan->bahasa->nama_bahasa }}</span>
                            </div>
                            <p class="text-lg font-medium">Lisan</p>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Indonesia</span>
                            </div>
                            <p class="text-lg font-medium">{{ $usulan->kata_indonesia }}</p>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <span
                                    class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Inggris</span>
                            </div>
                            <p class="text-lg font-medium">{{ $usulan->kata_inggris }}</p>
                        </div>
                    </div>
                </div>

                <!-- Arti dalam berbagai bahasa -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-dark mb-4 flex items-center">
                        <i class="fas fa-book-open mr-2 text-primary"></i>Arti
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Daerah</span>
                            </div>
                            <p>{{ $usulan->arti_daerah ?? '-' }}</p>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Indonesia</span>
                            </div>
                            <p>{{ $usulan->arti_indonesia ?? '-' }}</p>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <span
                                    class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Inggris</span>
                            </div>
                            <p>{{ $usulan->arti_inggris ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Contoh Kalimat -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-dark mb-4 flex items-center">
                        <i class="fas fa-comment-dots mr-2 text-primary"></i>Contoh Kalimat
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Daerah</span>
                            </div>
                            <p class="italic">{{ $usulan->contoh_kalimat_daerah ?? '-' }}.</p>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Indonesia</span>
                            </div>
                            <p class="italic">{{ $usulan->contoh_kalimat_indonesia ?? '-' }}.</p>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <span
                                    class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Inggris</span>
                            </div>
                            <p class="italic">{{ $usulan->contoh_kalimat_inggris ?? '-' }}.</p>
                        </div>
                    </div>
                </div>

                <!-- Media -->
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-dark mb-4 flex items-center">
                        <i class="fas fa-images mr-2 text-primary"></i>Media Pendukung
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Gambar -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center mb-3">
                                <span class="text-sm font-medium text-gray-700">Gambar</span>
                            </div>
                            <div class="flex justify-center">
                                <div class="relative">
                                    @if ($usulan->gambar_path)
                                    <div>
                                        <p class="font-semibold text-gray-700 mb-1">Gambar:</p>
                                        <img src="{{ asset('storage/' . $usulan->gambar_path) }}"
                                            alt="{{ $usulan->kata_daerah }}"
                                            class="w-64 shadow-sm rounded-lg shadow-md w-full max-w-xs object-cover">
                                    </div>
                                    @else
                                    <span>No picture</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Audio -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center mb-3">
                                <span class="text-sm font-medium text-gray-700">Audio</span>
                            </div>
                            <div class="flex items-center justify-center">
                                <div class="bg-gray-100 rounded-xl p-5 w-full max-w-md">
                                    <div class="text-sm text-gray-500 mb-3">Pengucapan kata: {{ $usulan->kata_daerah }}
                                    </div>
                                    @if ($usulan->audio_path === NULL)
                                    <span>Belum ada audio</span>
                                    @else
                                    <audio controls class="w-full max-w-xs">
                                        <source src="{{ asset('storage/' . $usulan->audio_path) }}" type="audio/mp3">
                                    </audio>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Aksi -->
        @if ($usulan->status === 'pending')
        <div class="mt-8">
            <h3 class="text-xl font-bold text-dark mb-6 flex items-center">
                <i class="fas fa-tasks mr-2 text-primary"></i>Berikan Keputusan
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Form Approve -->
                <div
                    class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-xl shadow-md overflow-hidden">
                    <div class="px-6 py-4 bg-green-500">
                        <h4 class="text-lg font-semibold text-white flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>Setujui Usulan
                        </h4>
                    </div>
                    <form method="POST" action="{{ route('usulan.approve', $usulan) }}"
                        class="bg-green-50 p-6 rounded-lg shadow space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Catatan (opsional)
                            </label>
                            <textarea name="catatan_ahli" placeholder="Berikan catatan atau masukan untuk pengusul..."
                                class="w-full h-24 border border-gray-300 rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-green-300 focus:border-green-400 focus:outline-none"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white py-3 px-4 rounded-lg transition-all flex items-center justify-center">
                            <i class="fas fa-check mr-2"></i> Setujui Usulan
                        </button>
                    </form>
                </div>

                <!-- Form Reject -->
                <div
                    class="bg-gradient-to-br from-red-50 to-red-100 border border-red-200 rounded-xl shadow-md overflow-hidden">
                    <div class="px-6 py-4 bg-red-500">
                        <h4 class="text-lg font-semibold text-white flex items-center">
                            <i class="fas fa-times-circle mr-2"></i>Tolak Usulan
                        </h4>
                    </div>
                    <form method="POST" action="{{ route('usulan.reject', $usulan) }}"
                        class="bg-red-50 p-6 rounded-lg shadow space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Alasan Penolakan <span class="text-red-500">*</span>
                            </label>
                            <textarea name="catatan_ahli" placeholder="Jelaskan alasan penolakan usulan ini..." required
                                class="w-full h-24 border border-gray-300 rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-red-300 focus:border-red-400 focus:outline-none"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white py-3 px-4 rounded-lg transition-all flex items-center justify-center">
                            <i class="fas fa-ban mr-2"></i> Tolak Usulan
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @else
        <!-- Status Jika Bukan Pending -->
        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-xl p-6 text-center">
            <div class="text-blue-500 text-4xl mb-3">
                <i class="fas fa-check-circle"></i>
            </div>
            <h3 class="text-xl font-bold text-blue-700 mb-2">Usulan Telah Direview</h3>
            <p class="text-gray-600">Status saat ini: <span class="font-semibold text-green-600">{{ $usulan->status
                    }}</span>
            </p>
            <p class="text-sm text-gray-500 mt-2">Anda tidak dapat melakukan perubahan karena usulan ini sudah
                diproses</p>
        </div>
        @endif
    </div>

    @push('sceipts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        secondary: '#1e40af',
                        success: '#10b981',
                        warning: '#f59e0b',
                        danger: '#ef4444',
                        dark: '#1e293b',
                        light: '#f8fafc'
                    }
                }
            }
        }
    </script>
    @endpush
</x-app-layout>