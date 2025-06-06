<x-app-layout>

    <!-- Header -->
    <div class="bg-white shadow-sm">
        <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-primary">
                <i class="fas fa-book mr-2"></i>Detail Usulan Kata
            </h1>
            <a href="{{ route('usulan_kata.index') }}"
                class="flex items-center text-sm font-medium text-gray-600 hover:text-secondary transition-colors">
                <i class="fas fa-reply mr-1"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-5xl mx-auto px-4 py-6">
        <!-- Card Detail -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <!-- Header Card -->
            <div class="bg-gradient-to-r from-primary to-secondary px-6 py-4">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <h2 class="text-xl font-bold text-white">Kata Daerah: <span class="font-normal">{{
                                $usulanKata->kata_daerah }}</span>
                        </h2>
                        <div class="flex items-center mt-1">
                            <span class="bg-white bg-opacity-20 px-2 py-1 rounded-full text-xs text-white">Bahasa
                                Tolaki</span>
                            <span class="bg-white bg-opacity-20 px-2 py-1 rounded-full text-xs text-white ml-2">{{
                                $usulanKata->kategori->nama_kategori ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-lg px-3 py-1">
                        <span class="text-white font-medium">Status: <span class="font-normal">{{
                                $usulanKata->status ?? '-' }}</span></span>
                    </div>
                </div>
            </div>

            <!-- Body Card -->
            <div class="p-6">
                <!-- Kata dalam berbagai bahasa -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-dark mb-4 flex items-center">
                        <i class="fas fa-language mr-2 text-primary"></i>{{ $usulanKata->bahasa->nama_bahasa }}
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-center mb-2">
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Daerah</span>
                            </div>
                            <p class="text-lg font-medium">{{ $usulanKata->kata_daerah }}</p>
                        </div>

                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-center mb-2">
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Indonesia</span>
                            </div>
                            <p class="text-lg font-medium">{{ $usulanKata->kata_indonesia }}</p>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-center mb-2">
                                <span
                                    class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Inggris</span>
                            </div>
                            <p class="text-lg font-medium">{{ $usulanKata->kata_inggris }}</p>
                        </div>
                    </div>
                </div>

                <!-- Arti dalam berbagai bahasa -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-dark mb-4 flex items-center">
                        <i class="fas fa-book-open mr-2 text-primary"></i>Arti
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-center mb-2">
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Daerah</span>
                            </div>
                            <p>{{ $usulanKata->arti_daerah ?? '-' }}</p>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-center mb-2">
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Indonesia</span>
                            </div>
                            <p>{{ $usulanKata->arti_indonesia ?? '-' }}</p>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-center mb-2">
                                <span
                                    class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Inggris</span>
                            </div>
                            <p>{{ $usulanKata->arti_inggris ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Contoh Kalimat -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-dark mb-4 flex items-center">
                        <i class="fas fa-comment-dots mr-2 text-primary"></i>Contoh Kalimat
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-center mb-2">
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Daerah</span>
                            </div>
                            <p class="italic">"{{ $usulanKata->contoh_kalimat_daerah ?? '-' }}."</p>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-center mb-2">
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Indonesia</span>
                            </div>
                            <p class="italic">"{{ $usulanKata->contoh_kalimat_indonesia ?? '-' }}."</p>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-center mb-2">
                                <span
                                    class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Inggris</span>
                            </div>
                            <p class="italic">"{{ $usulanKata->contoh_kalimat_inggris ?? '-' }}."</p>
                        </div>
                    </div>
                </div>

                <!-- Media -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-dark mb-4 flex items-center">
                        <i class="fas fa-images mr-2 text-primary"></i>Media
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Gambar -->
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-center mb-3">
                                <span class="text-sm font-medium text-gray-700">Gambar</span>
                            </div>
                            <div class="flex justify-center">
                                <div class="relative group">
                                    @if ($usulanKata->gambar_path)
                                    <div class="mt-4">
                                        <strong>Gambar:</strong><br>
                                        <img src="{{ asset('storage/' . $usulanKata->gambar_path) }}"
                                            alt="Contoh gambar"
                                            class="h-32 mt-2 rounded-lg shadow-md w-full max-w-xs object-cover transition-transform duration-300 group-hover:scale-105">
                                    </div>
                                    @endif
                                    <div
                                        class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center rounded-lg opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button class="bg-white rounded-full p-2 shadow-md">
                                            <i class="fas fa-expand text-gray-700"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Audio -->
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-center mb-3">
                                <span class="text-sm font-medium text-gray-700">Audio</span>
                            </div>
                            <div class="flex items-center justify-center">
                                <div class="bg-gray-100 rounded-xl p-5 w-full max-w-md">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="text-sm text-gray-500">Pengucapan kata "Lisan"</div>
                                        <div class="text-xs text-gray-500">1:20</div>
                                        @if ($usulanKata->audio_path)
                                        <div class="mt-4">
                                            <strong>Audio:</strong><br>
                                            <audio controls class="mt-2">
                                                <source src="{{ asset('storage/' . $usulanKata->audio_path) }}"
                                                    type="audio/mp3">
                                            </audio>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <button
                                            class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center hover:bg-secondary transition-colors">
                                            <i class="fas fa-step-backward"></i>
                                        </button>
                                        <button
                                            class="w-12 h-12 rounded-full bg-primary text-white flex items-center justify-center hover:bg-secondary transition-colors">
                                            <i class="fas fa-play"></i>
                                        </button>
                                        <button
                                            class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center hover:bg-secondary transition-colors">
                                            <i class="fas fa-step-forward"></i>
                                        </button>
                                    </div>
                                    <div class="mt-4">
                                        <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                            <div class="h-full bg-primary w-1/3"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Card -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500">
                        <i class="far fa-clock mr-1"></i> Terakhir diperbarui: 29 Mei 2023
                    </div>
                    <div>
                        <button
                            class="px-4 py-2 bg-primary hover:bg-secondary text-white rounded-lg transition-colors flex items-center">
                            <i class="fas fa-edit mr-2"></i> Edit Usulan
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Kembali (mobile) -->
        <div class="mt-8 md:hidden">
            <a href="{{ route('usulan_kata.index') }}"
                class="w-full flex items-center justify-center px-4 py-3 bg-primary hover:bg-secondary text-white rounded-lg transition-colors">
                <i class="fas fa-reply mr-2"></i> Kembali ke Daftar Usulan
            </a>
        </div>
    </div>

    @push('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        secondary: '#1e40af',
                        accent: '#10b981',
                        dark: '#1e293b',
                        light: '#f8fafc'
                    }
                }
            }
        }
    </script>
    @endpush
</x-app-layout>