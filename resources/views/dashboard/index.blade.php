<x-app-layout>
    <!-- Section 1: Informasi Usulan Umum -->
    <div class="bg-gradient-to-r from-primary to-secondary shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-6">
            <h1 class="text-2xl md:text-3xl font-bold text-white">
                <i class="fas fa-chart-line mr-2"></i>Dashboard Statistik Usulan Kata
            </h1>
            <p class="text-blue-100 mt-1">Analisis dan visualisasi data usulan kata</p>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-md p-5 border-l-4 border-primary">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">Total Usulan</p>
                        <h3 class="text-2xl font-bold text-dark mt-1">{{ $totalUsulan }}</h3>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-lg"><i class="fas fa-file-alt text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md p-5 border-l-4 border-success">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">Usulan Disetujui</p>
                        <h3 class="text-2xl font-bold text-dark mt-1">{{ $approvedUsulan }}</h3>
                    </div>
                    <div class="bg-green-100 p-3 rounded-lg"><i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md p-5 border-l-4 border-warning">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">Usulan Ditolak</p>
                        <h3 class="text-2xl font-bold text-dark mt-1">{{ $rejectedUsulan }}</h3>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-lg"><i
                            class="fas fa-times-circle text-yellow-600 text-xl"></i></div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md p-5 border-l-4 border-danger">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">Usulan Pending</p>
                        <h3 class="text-2xl font-bold text-dark mt-1">{{ $pendingUsulan }}</h3>
                    </div>
                    <div class="bg-red-100 p-3 rounded-lg"><i class="fas fa-clock text-red-600 text-xl"></i></div>
                </div>
            </div>
        </div>

        <!-- Section 2: Jumlah Usulan 6 Bulan Terakhir -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <h2 class="text-xl font-bold text-dark flex items-center">
                <i class="fas fa-chart-bar text-primary mr-2"></i>Jumlah Usulan Per Bulan (6 Bulan Terakhir)
            </h2>
            <div class="h-80">
                <canvas id="usulanChart"></canvas>
            </div>
        </div>

        <!-- Section 3: Top 5 Kata Populer -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h2 class="text-xl font-bold text-dark flex items-center">
                    <i class="fas fa-fire text-red-500 mr-2"></i>Top 5 Kata Populer
                </h2>
                <div class="space-y-4">
                    @foreach ($kataPopuler as $index => $kata)
                    <div
                        class="flex items-center p-4 border border-gray-200 rounded-xl hover:shadow-md transition-shadow">
                        <div
                            class="w-10 h-10 rounded-full bg-gradient-to-r {{ $index === 0 ? 'from-red-500 to-orange-500' : ($index === 1 ? 'bg-orange-300' : ($index === 2 ? 'bg-yellow-400' : 'bg-gray-300')) }} flex items-center justify-center text-white font-bold mr-4">
                            {{ $index + 1 }}
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-lg text-dark">{{ $kata->kata_daerah }}</h3>
                            <p class="text-gray-600 text-sm">{{ $kata->bahasa->nama_bahasa }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-lg">{{ $kata->search_count }}</p>
                            <p class="text-gray-500 text-sm">pencarian</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Section 4: Top Kategori Kata yang Diusulkan -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-dark flex items-center">
                    <i class="fas fa-globe-asia text-green-500 mr-2"></i>Top Kategori Kata Diusulkan
                </h2>
                <div class="h-80">
                    <canvas id="kategoriChart" height="300"></canvas>
                </div>
                <div class="mt-4 grid grid-cols-2 gap-2">
                    @foreach ($kategoriData as $id => $jumlah)
                    @php
                    $colors = ['bg-blue-500', 'bg-green-500', 'bg-yellow-500', 'bg-purple-500', 'bg-red-500'];
                    $index = array_search($id, array_keys($kategoriData));
                    $colorClass = $colors[$index % count($colors)];
                    @endphp
                    <div class="bg-{{ $colorClass }}-50 p-3 rounded-lg flex items-center">
                        <div class="w-3 h-3 rounded-full {{ $colorClass }} mr-2"></div>
                        <div>
                            <p class="font-medium">{{ $kategoriNames[$id] }}</p>
                            <p class="text-gray-600 text-sm">{{ $jumlah }} usulan</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const usulanChart = document.getElementById('usulanChart').getContext('2d');
    const kategoriChart = document.getElementById('kategoriChart').getContext('2d');

    const usulanChartInstance = new Chart(usulanChart, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($usulanPerBulan)) !!},
            datasets: [{
                label: 'Jumlah Usulan',
                data: {!! json_encode(array_values($usulanPerBulan)) !!},
                borderColor: '#3b82f6',
                backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#ef4444'],
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true }
            }
        }
    });

    const kategoriChartInstance = new Chart(kategoriChart, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($kategoriLabels) !!},
            datasets: [{
                data: {!! json_encode(array_values($kategoriData)) !!},
                backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#ef4444'],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#abcabc', 
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