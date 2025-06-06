<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-dark mb-6">
                <i class="fas fa-history text-blue-500 mr-2"></i>Riwayat Perubahan Kata
            </h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kata
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Pelapor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ahli
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Perubahan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Sebelum</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Sesudah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Deskripsi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($logs as $log)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $log->kata->kata_daerah }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $log->pelapor_type === 'App\Models\User' ? ($log->kata->laporanKesalahan->user->name ??
                            'User Tidak Diketahui') : 'Pengunjung (ID: ' . $log->pelapor_id . ')' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $log->user->name ?? 'Ahli Tidak Diketahui' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($log->field_changed) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $log->old_value }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $log->new_value }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $log->description }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $log->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>