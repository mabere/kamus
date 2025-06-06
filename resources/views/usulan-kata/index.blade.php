<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Daftar Usulan Kata</h1>

        @if (session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
        @endif

        @if ($usulan->isEmpty())
        <div class="text-center text-gray-600">
            Tidak ada usulan kata yang perlu direview.
        </div>
        @else
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($usulan as $item)
            <div class="bg-white shadow-md rounded-2xl p-5 hover:shadow-lg transition duration-300">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">
                    Kata yang diusulan: {{ $item->kata_daerah }}
                </h2>
                <p class="text-sm text-gray-600 mb-1">
                    <strong>Bahasa:</strong> {{ $item->bahasa->nama_bahasa }}
                </p>
                <p class="text-sm text-gray-600 mb-4">
                    <strong>Pengusul:</strong> {{ $item->user->name }}
                </p>
                @php
                $statusColor = match($item->status) {
                'approved' => 'bg-green-100 text-green-800',
                'rejected' => 'bg-red-100 text-red-800',
                'pending' => 'bg-yellow-300 text-yellow-800',
                default => 'bg-gray-100 text-gray-800',
                };
                @endphp

                <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full {{ $statusColor }}">
                    {{ ucfirst($item->status) }}
                </span>
                @auth
                @if (Auth::user()->role === 'contributor' && $item->status === 'pending')
                <a href="{{ route('usulan_kata.edit', $item) }}"
                    class="px-3 py-1 text-sm font-semibold rounded-full ms-auto inline-block bg-orange-600 hover:bg-orange-700 text-white text-sm p-2 rounded-lg transition duration-200 float-right">
                    <i class="fas fa-edit mr-1"></i> Edit
                </a>
                @endif
                @if (Auth::user()->role === 'ahli' || Auth::user()->role === 'admin')
                <a href="{{ route('usulan.review', $item) }}"
                    class="px-3 py-1 text-sm font-semibold rounded-full ms-auto inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm p-2 rounded-lg transition duration-200  float-right">
                    <i class="fas fa-eye mr-1"></i> Review
                </a>
                @endif
                @endauth
            </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $usulan->links() }}
        </div>
        @endif
    </div>
</x-app-layout>