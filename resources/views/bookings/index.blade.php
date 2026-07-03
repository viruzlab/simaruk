<x-app-layout>
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-surface-700/50 mb-6 mt-4 px-4 sm:px-6 lg:px-8">
        <a href="{{ route('dashboard') }}" class="hover:text-primary-600 transition-colors">Beranda</a>
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
        <span class="text-surface-900 font-medium">Manajemen Persetujuan</span>
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
        <span class="text-surface-900 font-medium">Daftar Permintaan</span>
    </nav>

    <div class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto pb-12">
        
        @if(session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl shadow-sm flex items-center gap-3">
                <svg class="w-5 h-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Header & Stats -->
        <div class="flex flex-col xl:flex-row xl:items-start justify-between gap-8 mb-8">
            <div class="max-w-2xl">
                <h1 class="text-3xl font-extrabold text-surface-900 tracking-tight">Daftar Permintaan Persetujuan</h1>
                <p class="text-sm text-surface-700/60 mt-2 font-medium leading-relaxed">
                    Kelola dan tinjau semua pengajuan peminjaman ruangan di lingkungan universitas.
                </p>
            </div>
            
            <div class="flex gap-4">
                <!-- Stat: Pending -->
                <div class="bg-white rounded-2xl border border-surface-200/60 p-4 shadow-sm flex items-center gap-4 min-w-[140px]">
                    <div class="w-12 h-12 rounded-xl bg-primary-50 flex items-center justify-center text-primary-600 shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-surface-500 uppercase tracking-wider">Total Pending</p>
                        <p class="text-2xl font-black text-surface-900 mt-0.5">{{ $totalPending }}</p>
                    </div>
                </div>
                <!-- Stat: Approved -->
                <div class="bg-white rounded-2xl border border-surface-200/60 p-4 shadow-sm flex items-center gap-4 min-w-[140px]">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-surface-500 uppercase tracking-wider">Disetujui</p>
                        <p class="text-2xl font-black text-surface-900 mt-0.5">{{ $totalApproved }}</p>
                    </div>
                </div>
                <!-- Stat: Rejected -->
                <div class="bg-white rounded-2xl border border-surface-200/60 p-4 shadow-sm flex items-center gap-4 min-w-[140px]">
                    <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center text-red-600 shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-surface-500 uppercase tracking-wider">Ditolak</p>
                        <p class="text-2xl font-black text-surface-900 mt-0.5">{{ $totalRejected }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter & Search Bar -->
        <div class="bg-white rounded-2xl border border-surface-200/60 p-2 shadow-sm mb-6 flex flex-col md:flex-row items-center gap-2">
            <div class="relative flex-1 w-full">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-surface-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </div>
                <input type="text" class="block w-full pl-11 pr-4 py-3 border-transparent bg-transparent text-sm font-medium text-surface-900 placeholder-surface-400 focus:border-transparent focus:ring-0" placeholder="Cari nama pemohon atau ID...">
            </div>
            <div class="h-8 w-px bg-surface-200 hidden md:block"></div>
            <div class="flex items-center gap-2 w-full md:w-auto px-2">
                <div class="flex items-center gap-2">
                    <span class="text-sm font-semibold text-surface-500 whitespace-nowrap">Tipe:</span>
                    <select class="border-transparent bg-transparent text-sm font-bold text-surface-900 focus:border-transparent focus:ring-0 cursor-pointer">
                        <option>Semua Tipe</option>
                    </select>
                </div>
                <div class="h-6 w-px bg-surface-200 hidden md:block"></div>
                <div class="flex items-center gap-2">
                    <span class="text-sm font-semibold text-surface-500 whitespace-nowrap">Gedung:</span>
                    <select class="border-transparent bg-transparent text-sm font-bold text-surface-900 focus:border-transparent focus:ring-0 cursor-pointer">
                        <option>Semua Gedung</option>
                    </select>
                </div>
                <button class="ml-auto md:ml-4 px-6 py-2.5 bg-surface-600 hover:bg-surface-700 text-white text-sm font-bold rounded-xl transition-colors shadow-sm">
                    Terapkan
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-2xl border border-surface-200/60 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead class="bg-surface-50 border-b border-surface-200/60 text-surface-500">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-bold uppercase tracking-wider text-[11px]">ID Permintaan</th>
                            <th scope="col" class="px-6 py-4 font-bold uppercase tracking-wider text-[11px]">Pemohon</th>
                            <th scope="col" class="px-6 py-4 font-bold uppercase tracking-wider text-[11px]">Ruangan & Waktu</th>
                            <th scope="col" class="px-6 py-4 font-bold uppercase tracking-wider text-[11px]">Keperluan</th>
                            <th scope="col" class="px-6 py-4 font-bold uppercase tracking-wider text-[11px]">Status</th>
                            <th scope="col" class="px-6 py-4 font-bold uppercase tracking-wider text-[11px] text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-100">
                        @forelse($bookings as $booking)
                            <tr class="hover:bg-surface-50/50 transition-colors">
                                <!-- ID -->
                                <td class="px-6 py-5">
                                    <span class="text-sm font-bold text-primary-600 bg-primary-50 px-3 py-1.5 rounded-lg border border-primary-100">
                                        #BK-{{ $booking->created_at->format('Y') }}-{{ str_pad($booking->id, 3, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>
                                
                                <!-- Pemohon -->
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-surface-700 to-surface-900 flex items-center justify-center text-white text-sm font-bold shadow-sm">
                                            {{ strtoupper(substr($booking->user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-surface-900">{{ $booking->user->name }}</p>
                                            <p class="text-xs font-medium text-surface-500 mt-0.5">{{ $booking->user->role === 'admin' ? 'Administrator' : 'Pengguna' }}</p>
                                        </div>
                                    </div>
                                </td>
                                
                                <!-- Ruangan & Waktu -->
                                <td class="px-6 py-5">
                                    <p class="text-sm font-bold text-surface-900">{{ $booking->room->name }}</p>
                                    <p class="text-xs font-medium text-surface-500 mt-0.5">
                                        {{ $booking->start_time->translatedFormat('d M Y') }}, 
                                        {{ $booking->start_time->format('H:i') }} - {{ $booking->end_time->format('H:i') }}
                                    </p>
                                </td>
                                
                                <!-- Keperluan -->
                                <td class="px-6 py-5">
                                    <p class="text-sm font-bold text-surface-700">{{ $booking->purpose }}</p>
                                    @if($booking->activity_name)
                                        <p class="text-xs font-medium text-surface-500 mt-0.5 max-w-[200px] truncate" title="{{ $booking->activity_name }}">{{ $booking->activity_name }}</p>
                                    @endif
                                </td>
                                
                                <!-- Status -->
                                <td class="px-6 py-5">
                                    @if($booking->status === 'pending')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold text-amber-700 bg-amber-50 border border-amber-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            Menunggu Persetujuan
                                        </span>
                                    @elseif($booking->status === 'approved')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold text-emerald-700 bg-emerald-50 border border-emerald-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Disetujui
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold text-red-700 bg-red-50 border border-red-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                            Ditolak
                                        </span>
                                    @endif
                                </td>
                                
                                <!-- Aksi -->
                                <td class="px-6 py-5 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- View -->
                                        <a href="{{ route('bookings.show', $booking) }}" class="w-8 h-8 rounded-full bg-white border border-surface-200 flex items-center justify-center text-surface-400 hover:text-primary-600 hover:border-primary-200 hover:bg-primary-50 transition-colors shadow-sm" title="Lihat Detail">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                        </a>
                                        
                                        @if(auth()->user()->role === 'admin' && $booking->status === 'pending')
                                            <!-- Approve -->
                                            <form action="{{ route('bookings.approve', $booking) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="w-8 h-8 rounded-full bg-white border border-surface-200 flex items-center justify-center text-surface-400 hover:text-emerald-600 hover:border-emerald-200 hover:bg-emerald-50 transition-colors shadow-sm" title="Setujui">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                                </button>
                                            </form>
                                            <!-- Reject -->
                                            <form action="{{ route('bookings.reject', $booking) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="w-8 h-8 rounded-full bg-white border border-surface-200 flex items-center justify-center text-surface-400 hover:text-red-600 hover:border-red-200 hover:bg-red-50 transition-colors shadow-sm" title="Tolak">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-surface-500 font-medium">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-surface-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                                        Belum ada data permintaan persetujuan.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination Footer -->
            <div class="bg-surface-50 px-6 py-4 border-t border-surface-200/60 flex items-center justify-between">
                <p class="text-sm font-medium text-surface-500">
                    Menampilkan <span class="font-bold text-surface-900">{{ $bookings->count() }}</span> permintaan
                </p>
                <!-- Simple pagination placeholder matching design -->
                <div class="flex items-center gap-1">
                    <button class="w-8 h-8 rounded-lg border border-surface-200 bg-white flex items-center justify-center text-surface-400 hover:bg-surface-50 cursor-not-allowed">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                    </button>
                    <button class="w-8 h-8 rounded-lg border-transparent bg-surface-600 flex items-center justify-center text-white font-bold text-sm">1</button>
                    <button class="w-8 h-8 rounded-lg border border-surface-200 bg-white flex items-center justify-center text-surface-600 font-bold text-sm hover:bg-surface-50">2</button>
                    <button class="w-8 h-8 rounded-lg border border-surface-200 bg-white flex items-center justify-center text-surface-600 font-bold text-sm hover:bg-surface-50">3</button>
                    <button class="w-8 h-8 rounded-lg border border-surface-200 bg-white flex items-center justify-center text-surface-600 font-bold text-sm hover:bg-surface-50">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </button>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
