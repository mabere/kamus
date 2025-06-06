<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <h1 class="text-2xl font-bold mb-4">{{ $kata->kata_daerah }} ({{ $kata->bahasa->nama_bahasa }})</h1>

        <!-- Navigation Tabs -->
        <ul class="nav nav-tabs" id="languageTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="daerah-tab" data-bs-toggle="tab" data-bs-target="#daerah"
                    type="button" role="tab" aria-controls="daerah" aria-selected="true">
                    {{ ucfirst($kata->bahasa->nama_bahasa) }}
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="indonesia-tab" data-bs-toggle="tab" data-bs-target="#indonesia"
                    type="button" role="tab" aria-controls="indonesia" aria-selected="false">
                    Indonesia
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="inggris-tab" data-bs-toggle="tab" data-bs-target="#inggris" type="button"
                    role="tab" aria-controls="inggris" aria-selected="false">
                    Inggris
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content p-4 border rounded mt-4">
            <!-- Bahasa Daerah (Tolaki) -->
            <div class="tab-pane fade show active" id="daerah" role="tabpanel" aria-labelledby="daerah-tab">
                <p><strong>Kata:</strong> {{ $kata->kata_daerah }}</p>
                <p><strong>Arti:</strong> {{ $kata->arti_daerah ?? '-' }}</p>
                <p><strong>Contoh Kalimat:</strong> {{ $kata->contoh_kalimat_daerah ?? '-' }}</p>
                <p><strong>Kategori:</strong> {{ $kata->kategori->nama_kategori ?? '-' }}</p>
                @if ($kata->gambar_path)
                <p><strong>Gambar:</strong></p>
                <img src="{{ asset('storage/' . $kata->gambar_path) }}" alt="{{ $kata->kata_daerah }}"
                    class="w-64 my-2">
                @endif
                @if ($kata->audio_path)
                <p><strong>Audio:</strong></p>
                <audio controls src="{{ asset('storage/' . $kata->audio_path) }}" class="my-2"></audio>
                @endif
            </div>

            <!-- Bahasa Indonesia -->
            <div class="tab-pane fade" id="indonesia" role="tabpanel" aria-labelledby="indonesia-tab">
                <p><strong>Kata:</strong> {{ $kata->kata_indonesia }}</p>
                <p><strong>Arti:</strong> {{ $kata->arti_indonesia ?? '-' }}</p>
                <p><strong>Contoh Kalimat:</strong> {{ $kata->contoh_kalimat_indonesia ?? '-' }}</p>
                <p><strong>Kategori:</strong> {{ $kata->kategori->nama_kategori ?? '-' }}</p>
            </div>

            <!-- Bahasa Inggris -->
            <div class="tab-pane fade" id="inggris" role="tabpanel" aria-labelledby="inggris-tab">
                <p><strong>Kata:</strong> {{ $kata->kata_inggris }}</p>
                <p><strong>Arti:</strong> {{ $kata->arti_inggris ?? '-' }}</p>
                <p><strong>Contoh Kalimat:</strong> {{ $kata->contoh_kalimat_inggris ?? '-' }}</p>
                <p><strong>Kategori:</strong> {{ $kata->kategori->nama_kategori ?? '-' }}</p>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('laporan.create', $kata->id) }}" class="text-red-500 hover:text-red-700">
                <i class="fas fa-exclamation-triangle mr-1"></i>Laporkan Kesalahan
            </a>
        </div>

        <a href="{{ route('dictionary.index') }}"
            class="text-white px-2 py-1 rounded-2 bg-blue-500 mt-4 inline-block">Kembali</a>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS dan Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>