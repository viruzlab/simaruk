<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-surface-900 leading-tight">
            {{ auth()->user()->role === 'admin' ? 'Admin Dashboard' : 'Dashboard' }}
        </h2>
    </x-slot>

    <!-- Dashboard Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-surface-900">
                {{ auth()->user()->role === 'admin' ? 'Dashboard Admin' : 'Dashboard Saya' }}
            </h1>
            <p class="text-surface-700/60 text-sm mt-1">Ringkasan aktivitas dan manajemen ruangan hari ini.</p>
        </div>
        <div class="flex items-center gap-3">
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('reports.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-surface-200 text-surface-700 text-sm font-medium rounded-xl hover:bg-surface-50 transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Unduh Laporan
            </a>
            @endif
            <a href="{{ route('bookings.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary-600 text-white text-sm font-medium rounded-xl hover:bg-primary-700 transition-colors shadow-sm shadow-primary-600/20">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Booking Baru
            </a>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 mb-8">
        <!-- Menunggu Persetujuan -->
        <div class="bg-white rounded-2xl border border-surface-200/60 p-5 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-surface-700/60 font-medium">Menunggu Persetujuan</p>
                <div class="w-9 h-9 rounded-lg bg-amber-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-surface-900">{{ $pendingBookings }}</p>
            @if($pendingBookings > 0)
            <p class="text-xs text-amber-600 mt-2 flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                Perlu ditinjau
            </p>
            @endif
        </div>

        <!-- Disetujui Bulan Ini -->
        <div class="bg-white rounded-2xl border border-surface-200/60 p-5 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-surface-700/60 font-medium">Disetujui Bulan Ini</p>
                <div class="w-9 h-9 rounded-lg bg-emerald-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-surface-900">{{ $approvedBookings }}</p>
            <p class="text-xs text-emerald-600 mt-2 flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                bulan ini
            </p>
        </div>

        <!-- Ditolak Bulan Ini -->
        <div class="bg-white rounded-2xl border border-surface-200/60 p-5 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-surface-700/60 font-medium">Ditolak Bulan Ini</p>
                <div class="w-9 h-9 rounded-lg bg-red-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-surface-900">{{ $rejectedBookings }}</p>
            <p class="text-xs text-surface-700/40 mt-2">Stabil</p>
        </div>

        @if(auth()->user()->role === 'admin')
        <!-- Ruangan Aktif -->
        <div class="bg-white rounded-2xl border border-surface-200/60 p-5 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-surface-700/60 font-medium">Ruangan Aktif</p>
                <div class="w-9 h-9 rounded-lg bg-primary-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-surface-900">{{ $availableRooms }}</p>
            <p class="text-xs text-primary-600 mt-2">dari {{ $totalRooms }} total</p>
        </div>
        @else
        <!-- Total Permohonan Saya -->
        <div class="bg-white rounded-2xl border border-surface-200/60 p-5 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-surface-700/60 font-medium">Total Permohonan</p>
                <div class="w-9 h-9 rounded-lg bg-indigo-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-surface-900">{{ $totalBookings }}</p>
            <p class="text-xs text-indigo-600 mt-2">Semua status</p>
        </div>
        @endif
    </div>

    @if(auth()->user()->role === 'admin')
    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-5 mb-8">
        <!-- Bar Chart: Statistik Penggunaan Ruangan -->
        <div class="lg:col-span-3 bg-white rounded-2xl border border-surface-200/60 p-6 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-base font-semibold text-surface-900">Statistik Penggunaan Ruangan</h3>
                    <p class="text-xs text-surface-700/50 mt-1">Total jam pemakaian per minggu</p>
                </div>
                <span class="text-xs font-medium text-primary-600 bg-primary-50 px-3 py-1.5 rounded-lg">Minggu Ini</span>
            </div>

            <!-- Simple CSS Bar Chart -->
            @php
                $days = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
                $maxStat = max(max($weeklyStats), 1);
            @endphp
            <div class="flex items-end justify-between gap-3 h-44 px-2 pt-4">
                @foreach($weeklyStats as $index => $count)
                <div class="flex-1 flex flex-col items-center justify-end h-full gap-1">
                    <span class="text-[11px] font-medium text-surface-700/60">{{ $count }}</span>
                    <div class="w-full rounded-t-lg transition-all duration-500 {{ $index === now()->dayOfWeekIso - 1 ? 'bg-indigo-600' : 'bg-indigo-100' }}"
                         style="height: {{ $maxStat > 0 ? max(($count / $maxStat) * 100, 4) : 4 }}%">
                    </div>
                    <span class="text-[11px] font-medium text-surface-700/60">{{ $days[$index] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Jenis Aktivitas -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-surface-200/60 p-6 shadow-sm">
            <div class="mb-6">
                <h3 class="text-base font-semibold text-surface-900">Jenis Aktivitas</h3>
                <p class="text-xs text-surface-700/50 mt-1">Distribusi kegiatan bulan ini</p>
            </div>



            <div class="space-y-5 mt-2">
                @php
                    $colors = ['bg-indigo-500', 'bg-sky-500', 'bg-emerald-500', 'bg-amber-500', 'bg-rose-500'];
                @endphp
                @foreach($activities as $index => $activity)
                @php
                    $color = $colors[$index % count($colors)];
                @endphp
                <div class="flex flex-col gap-2">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full {{ $color }}"></span>
                            <span class="text-xs font-medium text-surface-700">{{ $activity['name'] }}</span>
                        </div>
                        <span class="text-xs font-semibold text-surface-700">{{ $activity['pct'] }}%</span>
                    </div>
                    <div class="w-full h-2 bg-surface-100 rounded-full overflow-hidden">
                        <div class="{{ $color }} h-full rounded-full transition-all duration-700" style="width: {{ $activity['pct'] }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-6 pt-4 border-t border-surface-100 text-center">
                <p class="text-2xl font-bold text-surface-900">Total: {{ $totalBookings }} Kegiatan</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Bottom Row: Recent Bookings + Today Schedule -->
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-5">
        <!-- Permohonan Terbaru -->
        <div class="lg:col-span-3 bg-white rounded-2xl border border-surface-200/60 shadow-sm overflow-hidden">
            <div class="flex items-center justify-between px-6 py-5">
                <h3 class="text-base font-semibold text-surface-900">
                    {{ auth()->user()->role === 'admin' ? 'Permohonan Terbaru' : 'Permohonan Saya' }}
                </h3>
                <a href="{{ route('bookings.index') }}" class="text-xs text-primary-600 hover:text-primary-700 font-medium">
                    Lihat Semua
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-t border-surface-100">
                            @if(auth()->user()->role === 'admin')
                            <th class="px-6 py-3 text-left text-[11px] font-semibold text-surface-700/50 uppercase tracking-wider">Pemohon</th>
                            @endif
                            <th class="px-6 py-3 text-left text-[11px] font-semibold text-surface-700/50 uppercase tracking-wider">Ruangan & Waktu</th>
                            <th class="px-6 py-3 text-left text-[11px] font-semibold text-surface-700/50 uppercase tracking-wider">Keperluan</th>
                            <th class="px-6 py-3 text-center text-[11px] font-semibold text-surface-700/50 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-100">
                        @forelse($recentBookings as $booking)
                        <tr class="hover:bg-surface-50/50 transition-colors">
                            @if(auth()->user()->role === 'admin')
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-primary-400 to-violet-400 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                        {{ strtoupper(substr($booking->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-surface-900">{{ $booking->user->name }}</p>
                                    </div>
                                </div>
                            </td>
                            @endif
                            <td class="px-6 py-4">
                                <p class="text-sm font-medium text-primary-700">{{ $booking->room->name }}</p>
                                <p class="text-xs text-surface-700/50 mt-0.5">{{ $booking->start_time->format('d M Y, H:i') }} - {{ $booking->end_time->format('H:i') }}</p>
                            </td>
                            <td class="px-6 py-4 text-sm text-surface-700/70 max-w-[150px] truncate">{{ $booking->purpose }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    @if(auth()->user()->role === 'admin' && $booking->status === 'pending')
                                        <a href="{{ route('bookings.show', $booking) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-700 hover:bg-indigo-100 text-xs font-semibold transition-colors" title="Review Permohonan">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                            Review
                                        </a>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold
                                            {{ $booking->status === 'approved' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                            {{ $booking->status === 'pending' ? 'bg-amber-100 text-amber-700' : '' }}
                                            {{ $booking->status === 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                                            @if($booking->status === 'pending')
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            @endif
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center">
                                <svg class="w-10 h-10 text-surface-200 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <p class="text-sm text-surface-700/40">Belum ada permohonan</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Jadwal Hari Ini -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-surface-200/60 p-6 shadow-sm">
            <div class="flex items-center gap-2 mb-6">
                <svg class="w-5 h-5 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="text-base font-semibold text-surface-900">
                    {{ auth()->user()->role === 'admin' ? 'Jadwal Hari Ini' : 'Jadwal Saya Hari Ini' }}
                </h3>
            </div>

            @forelse($todaySchedule as $schedule)
            <div class="flex gap-4 mb-5 last:mb-0">
                <!-- Time -->
                <div class="flex flex-col items-center flex-shrink-0">
                    <span class="text-xs font-semibold text-surface-700/60">{{ $schedule->start_time->format('H:i') }}</span>
                    <div class="w-px h-full bg-surface-200 mt-1 min-h-[30px]"></div>
                    <span class="text-[10px] text-surface-700/40 mt-1">{{ $schedule->end_time->format('H:i') }}</span>
                </div>

                <!-- Event Card -->
                @php
                    $colors = ['border-primary-400 bg-primary-50', 'border-emerald-400 bg-emerald-50', 'border-amber-400 bg-amber-50', 'border-violet-400 bg-violet-50', 'border-sky-400 bg-sky-50'];
                    $dotColors = ['bg-primary-500', 'bg-emerald-500', 'bg-amber-500', 'bg-violet-500', 'bg-sky-500'];
                    $colorIndex = $loop->index % count($colors);
                @endphp
                <div class="flex-1 border-l-[3px] {{ $colors[$colorIndex] }} rounded-lg p-3">
                    <div class="flex items-center justify-between">
                        <p class="text-[11px] font-semibold text-surface-700/60 uppercase">{{ $schedule->room->name }}</p>
                        <span class="w-2 h-2 rounded-full {{ $dotColors[$colorIndex] }}"></span>
                    </div>
                    <p class="text-sm font-semibold text-surface-900 mt-1">{{ Str::limit($schedule->purpose, 30) }}</p>
                    @if(auth()->user()->role === 'admin' && $schedule->user)
                    <p class="text-xs text-surface-700/50 mt-1">{{ $schedule->user->name }}</p>
                    @endif
                </div>
            </div>
            @empty
            <div class="flex flex-col items-center py-8 text-center">
                <svg class="w-12 h-12 text-surface-200 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <p class="text-sm font-medium text-surface-700/50">Tidak ada jadwal hari ini</p>
                <p class="text-xs text-surface-700/30 mt-1">Jadwal yang disetujui akan muncul di sini</p>
            </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
