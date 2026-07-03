<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-surface-900 leading-tight">Laporan & Analisis</h2>
    </x-slot>

    <!-- Page Header & Actions -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-surface-900">Laporan & Analisis</h1>
            <p class="text-sm text-surface-500 mt-1">Ringkasan performa pemesanan ruang dan aktivitas pengguna.</p>
        </div>
        <div class="flex items-center gap-3">
            <!-- Date Filter Button -->
            <button class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-surface-700 bg-white border border-surface-300 rounded-xl hover:bg-surface-50 transition-colors shadow-sm">
                <svg class="w-4 h-4 text-surface-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                30 Hari Terakhir
            </button>
            <!-- Download PDF Button -->
            <button class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-surface-700 bg-white border border-surface-300 rounded-xl hover:bg-surface-50 transition-colors shadow-sm">
                <svg class="w-4 h-4 text-surface-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                Unduh PDF
            </button>
            <!-- Export CSV Button -->
            <button class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-bold text-white rounded-xl shadow-sm transition-all hover:shadow-md hover:-translate-y-0.5" style="background: linear-gradient(135deg, #0f172a, #1e3a5f);">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                Ekspor CSV
            </button>
        </div>
    </div>

    <!-- Stat Cards (4 cols) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Pemesanan -->
        <div class="bg-white rounded-2xl border border-surface-200/60 p-6 shadow-sm relative overflow-hidden group hover:border-primary-300 transition-colors">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center border border-indigo-100">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                </div>
                <span class="inline-flex items-center gap-1 text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-md">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                    +12%
                </span>
            </div>
            <p class="text-xs font-semibold text-surface-400 uppercase tracking-widest mb-1">Total Pemesanan</p>
            <h3 class="text-3xl font-bold text-surface-900 mb-2">{{ number_format($totalBookings) }}</h3>
            <p class="text-xs text-surface-400 font-medium">vs. bulan sebelumnya</p>
        </div>

        <!-- Pengguna Aktif -->
        <div class="bg-white rounded-2xl border border-surface-200/60 p-6 shadow-sm relative overflow-hidden group hover:border-blue-300 transition-colors">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center border border-blue-100">
                    <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                </div>
                <span class="inline-flex items-center gap-1 text-xs font-bold text-surface-500 bg-surface-100 px-2 py-1 rounded-md">
                    — Stabil
                </span>
            </div>
            <p class="text-xs font-semibold text-surface-400 uppercase tracking-widest mb-1">Pengguna Aktif</p>
            <h3 class="text-3xl font-bold text-surface-900 mb-2">{{ number_format($activeUsers) }}</h3>
            <p class="text-xs text-surface-400 font-medium">Sesi aktif hari ini</p>
        </div>

        <!-- Okupansi Ruang -->
        <div class="bg-white rounded-2xl border border-surface-200/60 p-6 shadow-sm relative overflow-hidden group hover:border-rose-300 transition-colors">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-xl bg-rose-50 flex items-center justify-center border border-rose-100">
                    <svg class="w-5 h-5 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                </div>
                <span class="inline-flex items-center gap-1 text-xs font-bold text-rose-600 bg-rose-50 px-2 py-1 rounded-md">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" /></svg>
                    -5%
                </span>
            </div>
            <p class="text-xs font-semibold text-surface-400 uppercase tracking-widest mb-1">Okupansi Ruang</p>
            <h3 class="text-3xl font-bold text-surface-900 mb-2">{{ $occupancyRate }}%</h3>
            <!-- Tiny mini progress bar at bottom of card -->
            <div class="w-full h-1.5 bg-surface-100 rounded-full mt-4 overflow-hidden">
                <div class="h-full bg-rose-500 rounded-full" style="width: {{ $occupancyRate }}%"></div>
            </div>
        </div>

        <!-- Jam Sibuk -->
        <div class="bg-white rounded-2xl border border-surface-200/60 p-6 shadow-sm relative overflow-hidden group hover:border-amber-300 transition-colors">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center border border-amber-100">
                    <svg class="w-5 h-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <span class="inline-flex items-center text-[10px] font-bold text-surface-600 uppercase tracking-widest">
                    Puncak
                </span>
            </div>
            <p class="text-xs font-semibold text-surface-400 uppercase tracking-widest mb-1">Jam Sibuk</p>
            <h3 class="text-xl sm:text-2xl font-bold text-surface-900 mb-2">{{ $peakHours }}</h3>
            <p class="text-xs text-surface-400 font-medium">Berdasarkan data 30 hari</p>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Main Line Chart -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-surface-200/60 shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-bold text-surface-900">Tren Pemesanan</h3>
                <div class="flex items-center gap-4 text-xs font-semibold text-surface-500">
                    <div class="flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full" style="background-color: #0f172a;"></span>
                        Bulan Ini
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full" style="background-color: #cbd5e1;"></span>
                        Bulan Lalu
                    </div>
                </div>
            </div>
            <div class="w-full h-[250px] sm:h-[300px]">
                <canvas id="trendChart"></canvas>
            </div>
        </div>

        <!-- Horizontal Bar Chart -->
        <div class="bg-white rounded-2xl border border-surface-200/60 shadow-sm p-6 flex flex-col">
            <h3 class="font-bold text-surface-900 mb-6">Penggunaan per Ruangan</h3>
            <div class="flex-1 space-y-5">
                @foreach($roomUsage as $room)
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-xs font-semibold text-surface-700">{{ $room->name }}</span>
                        <span class="text-xs font-medium text-surface-500">{{ $room->hours }} jam</span>
                    </div>
                    <div class="w-full h-1.5 bg-surface-100 rounded-full overflow-hidden">
                        <div class="h-full rounded-full" style="width: {{ $room->percentage }}%; background-color: #1e3a5f;"></div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-6 pt-4 border-t border-surface-100 text-center">
                <a href="#" class="text-xs font-bold text-primary-600 hover:text-primary-800 transition-colors">Lihat Semua Ruangan</a>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-2xl border border-surface-200/60 shadow-sm overflow-hidden mb-8">
        <div class="px-6 py-5 border-b border-surface-200/60 flex items-center justify-between">
            <h3 class="font-bold text-surface-900">Log Penggunaan Detail</h3>
            <div class="flex items-center gap-2 text-surface-400">
                <button class="p-1.5 hover:bg-surface-50 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
                </button>
                <button class="p-1.5 hover:bg-surface-50 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" /></svg>
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-50/50 border-b border-surface-200/60">
                        <th class="px-6 py-4 text-[10px] font-bold text-surface-400 uppercase tracking-widest">Nama Ruang</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-surface-400 uppercase tracking-widest">Departemen</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-surface-400 uppercase tracking-widest">Durasi</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-surface-400 uppercase tracking-widest">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200/60">
                    @forelse($bookingLogs as $log)
                        @php
                            // Mocking duration based on timestamps if exact duration logic isn't readily available
                            $durationHours = (int) $log->start_time->diffInHours($log->end_time);
                            $durationText = $durationHours > 0 ? $durationHours . ' Jam' : '1 Jam';
                        @endphp
                        <tr class="hover:bg-surface-50/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded border border-surface-200 flex items-center justify-center bg-surface-50 text-surface-500">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                                    </div>
                                    <span class="text-sm font-bold text-surface-900">{{ $log->room->name ?? 'Unknown Room' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-surface-600">
                                {{ $log->user->study_program ?? 'Umum' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-surface-600">
                                {{ $durationText }}
                            </td>
                            <td class="px-6 py-4">
                                @if($log->status === 'approved')
                                    <span class="inline-flex px-2 py-0.5 rounded text-[10px] font-bold tracking-wider text-emerald-500 bg-emerald-50 border border-emerald-100">SELESAI</span>
                                @elseif($log->status === 'pending')
                                    <span class="inline-flex px-2 py-0.5 rounded text-[10px] font-bold tracking-wider text-blue-500 bg-blue-50 border border-blue-100">TERJADWAL</span>
                                @elseif($log->status === 'rejected')
                                    <span class="inline-flex px-2 py-0.5 rounded text-[10px] font-bold tracking-wider text-rose-500 bg-rose-50 border border-rose-100">BATAL</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-sm text-surface-500">Tidak ada log penggunaan saat ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination Minimalist -->
        <div class="px-6 py-4 bg-surface-50/50 border-t border-surface-200/60 flex items-center justify-between">
            <span class="text-xs text-surface-500 font-medium">Menampilkan {{ $bookingLogs->firstItem() ?? 0 }}-{{ $bookingLogs->lastItem() ?? 0 }} dari {{ $bookingLogs->total() }} entri</span>
            <div class="flex items-center gap-1">
                @if($bookingLogs->onFirstPage())
                    <span class="px-3 py-1.5 text-xs font-semibold text-surface-400 bg-white border border-surface-200 rounded cursor-not-allowed">Sebelumnya</span>
                @else
                    <a href="{{ $bookingLogs->previousPageUrl() }}" class="px-3 py-1.5 text-xs font-semibold text-surface-700 bg-white border border-surface-200 rounded hover:bg-surface-50 transition-colors">Sebelumnya</a>
                @endif

                <!-- Simplified Pagination Numbers -->
                @for ($i = 1; $i <= min($bookingLogs->lastPage(), 3); $i++)
                    @if ($i == $bookingLogs->currentPage())
                        <span class="w-8 h-7 flex items-center justify-center text-xs font-bold text-white bg-[#0f172a] rounded shadow-sm">{{ $i }}</span>
                    @else
                        <a href="{{ $bookingLogs->url($i) }}" class="w-8 h-7 flex items-center justify-center text-xs font-semibold text-surface-700 bg-white border border-surface-200 rounded hover:bg-surface-50 transition-colors">{{ $i }}</a>
                    @endif
                @endfor

                @if($bookingLogs->hasMorePages())
                    <a href="{{ $bookingLogs->nextPageUrl() }}" class="px-3 py-1.5 text-xs font-semibold text-surface-700 bg-white border border-surface-200 rounded hover:bg-surface-50 transition-colors">Selanjutnya</a>
                @else
                    <span class="px-3 py-1.5 text-xs font-semibold text-surface-400 bg-white border border-surface-200 rounded cursor-not-allowed">Selanjutnya</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Push Chart.js script to the layout's end if needed, or just include it inline here -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('trendChart').getContext('2d');
            
            // Generate nice gradient for area chart
            let gradientBlue = ctx.createLinearGradient(0, 0, 0, 400);
            gradientBlue.addColorStop(0, 'rgba(15, 23, 42, 0.2)');   // #0f172a
            gradientBlue.addColorStop(1, 'rgba(15, 23, 42, 0)');
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartData['labels']) !!},
                    datasets: [
                        {
                            label: 'Bulan Ini',
                            data: {!! json_encode($chartData['current_month']) !!},
                            borderColor: '#0f172a',
                            backgroundColor: gradientBlue,
                            borderWidth: 3,
                            pointBackgroundColor: '#0f172a',
                            pointBorderColor: '#fff',
                            pointHoverBackgroundColor: '#fff',
                            pointHoverBorderColor: '#0f172a',
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            fill: true,
                            tension: 0.4 // Smooth curve
                        },
                        {
                            label: 'Bulan Lalu',
                            data: {!! json_encode($chartData['last_month']) !!},
                            borderColor: '#cbd5e1', // text-surface-300
                            borderWidth: 2,
                            borderDash: [5, 5],
                            pointRadius: 0,
                            fill: false,
                            tension: 0.4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    plugins: {
                        legend: {
                            display: false // We use custom HTML legend
                        },
                        tooltip: {
                            backgroundColor: 'rgba(255, 255, 255, 0.9)',
                            titleColor: '#0f172a',
                            bodyColor: '#475569',
                            borderColor: '#e2e8f0',
                            borderWidth: 1,
                            padding: 10,
                            displayColors: true,
                            boxPadding: 4,
                            usePointStyle: true,
                            callbacks: {
                                labelColor: function(context) {
                                    return {
                                        borderColor: context.datasetIndex === 0 ? '#0f172a' : '#cbd5e1',
                                        backgroundColor: context.datasetIndex === 0 ? '#0f172a' : '#cbd5e1',
                                    };
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                color: '#94a3b8',
                                font: {
                                    size: 11,
                                    family: "'Inter', sans-serif"
                                }
                            }
                        },
                        y: {
                            grid: {
                                color: '#f1f5f9', // surface-100
                                drawBorder: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                color: '#94a3b8',
                                font: {
                                    size: 11,
                                    family: "'Inter', sans-serif"
                                },
                                padding: 10
                            },
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
