<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-dark mb-6">
                <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>Daftar Laporan Kesalahan
            </h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kata
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Pelapor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe
                            Kesalahan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($laporan as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->kata->kata_daerah }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->user ? $item->user->name : 'Visitor' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($item->tipe_kesalahan) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->status == 'baru' ? 'bg-red-100 text-red-800' : ($item->status == 'diproses' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('laporan_kesalahan.show', $item->id) }}"
                                class="text-blue-600 hover:text-blue-900">Detail</a>

                            @if($item->status != 'selesai')
                            <form action="{{ route('laporan_kesalahan.selesai', $item->id) }}" method="POST"
                                class="inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="text-green-600 hover:text-green-900 ml-2">Tandai
                                    Selesai</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>