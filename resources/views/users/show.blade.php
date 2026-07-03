<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('users.index') }}" class="p-2 -ml-2 text-surface-400 hover:text-surface-600 rounded-lg hover:bg-surface-100 transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            </a>
            <h2 class="font-bold text-xl text-surface-900 leading-tight">Detail Pengguna</h2>
        </div>
    </x-slot>

    <!-- Breadcrumb + Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <nav class="flex items-center gap-2 text-sm text-surface-500">
            <a href="{{ route('users.index') }}" class="hover:text-primary-600 transition-colors">User Access</a>
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            <span class="text-surface-900 font-medium">User Detail</span>
        </nav>
        <div class="flex items-center gap-3">
            <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-primary-700 bg-white border border-primary-200 rounded-xl hover:bg-primary-50 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                Edit Profil
            </a>
            @if(auth()->id() !== $user->id)
            <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-red-500 rounded-xl hover:bg-red-600 transition-colors shadow-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" /></svg>
                    Nonaktifkan Akun
                </button>
            </form>
            @endif
        </div>
    </div>

    <!-- Profile Hero Card -->
    <div class="bg-white rounded-2xl border border-surface-200/60 shadow-sm overflow-hidden mb-6">
        <div class="p-6 sm:p-8 flex flex-col sm:flex-row gap-6 sm:gap-8 items-start">
            <!-- Avatar -->
            <div class="w-28 h-28 rounded-2xl flex-shrink-0 flex items-center justify-center font-bold text-4xl text-white shadow-lg" style="background: linear-gradient(135deg, {{ $user->role === 'admin' ? '#4f46e5, #7c3aed' : '#0ea5e9, #06b6d4' }});">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <!-- Info -->
            <div class="flex-1 min-w-0">
                <div class="flex flex-wrap items-center gap-3 mb-1">
                    <h1 class="text-2xl font-bold text-surface-900">{{ $user->name }}</h1>
                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md text-xs font-bold
                        {{ $user->role === 'admin' ? 'bg-amber-100 text-amber-700' : 'bg-sky-100 text-sky-700' }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
                <p class="text-sm text-surface-500 mb-5">{{ $user->study_program ?? 'Belum ada Program Studi' }} • {{ '@' . $user->username }}</p>

                <!-- Stat Row -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-6">
                    <div>
                        <p class="text-[10px] font-bold text-surface-400 uppercase tracking-widest mb-0.5">Status</p>
                        <div class="flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <p class="text-sm font-bold text-surface-900">{{ ucfirst($user->role) }}</p>
                        </div>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-surface-400 uppercase tracking-widest mb-0.5">Tanggal Bergabung</p>
                        <p class="text-sm font-bold text-surface-900">{{ $user->created_at->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-surface-400 uppercase tracking-widest mb-0.5">NIM/NIP</p>
                        <p class="text-sm font-bold text-surface-900 font-mono">{{ $user->nim_nip ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-surface-400 uppercase tracking-widest mb-0.5">Terverifikasi</p>
                        <p class="text-sm font-bold text-emerald-600">Aktif ✓</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Two Column: Personal Info + Stats -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Informasi Personal -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-surface-200/60 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-surface-200/60 flex items-center gap-3">
                <svg class="w-5 h-5 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                <h3 class="font-semibold text-surface-900">Informasi Personal</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-10">
                    <div>
                        <p class="text-[10px] font-bold text-surface-400 uppercase tracking-widest mb-1">Nama Lengkap</p>
                        <p class="text-sm text-surface-900">{{ $user->name }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-surface-400 uppercase tracking-widest mb-1">Username</p>
                        <p class="text-sm text-surface-900 font-mono">{{ $user->username }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-surface-400 uppercase tracking-widest mb-1">Nomor Telepon</p>
                        <p class="text-sm text-surface-900">{{ $user->phone ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-surface-400 uppercase tracking-widest mb-1">NIM / NIP</p>
                        <p class="text-sm text-surface-900 font-mono">{{ $user->nim_nip ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-surface-400 uppercase tracking-widest mb-1">Program Studi / Unit</p>
                        <p class="text-sm text-surface-900">{{ $user->study_program ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-surface-400 uppercase tracking-widest mb-1">Peran Sistem</p>
                        <p class="text-sm text-surface-900">{{ $user->role === 'admin' ? 'Administrator' : 'User Biasa' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Aktivitas -->
        <div class="bg-white rounded-2xl border border-surface-200/60 shadow-sm overflow-hidden" style="background: linear-gradient(160deg, #0f172a, #1e3a5f);">
            <div class="px-6 py-4 border-b border-white/10 flex items-center gap-3">
                <svg class="w-5 h-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                <h3 class="font-semibold text-white">Statistik Aktivitas</h3>
            </div>
            <div class="p-6 space-y-5">
                <!-- Total Bookings -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-indigo-500/20 flex items-center justify-center">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                        <span class="text-sm text-blue-200/80 font-medium">Total Booking</span>
                    </div>
                    <span class="text-xl font-bold text-white">{{ $user->bookings()->count() ?? 0 }}</span>
                </div>
                <!-- Approved -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-emerald-500/20 flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <span class="text-sm text-blue-200/80 font-medium">Disetujui</span>
                    </div>
                    <span class="text-xl font-bold text-emerald-400">{{ $user->bookings()->where('status', 'approved')->count() ?? 0 }}</span>
                </div>
                <!-- Pending -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-amber-500/20 flex items-center justify-center">
                            <svg class="w-5 h-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <span class="text-sm text-blue-200/80 font-medium">Menunggu</span>
                    </div>
                    <span class="text-xl font-bold text-amber-400">{{ $user->bookings()->where('status', 'pending')->count() ?? 0 }}</span>
                </div>

                <!-- Progress Bar -->
                @php
                    $totalBookings = $user->bookings()->count();
                    $approvedBookings = $user->bookings()->where('status', 'approved')->count();
                    $percentage = $totalBookings > 0 ? round(($approvedBookings / $totalBookings) * 100) : 0;
                @endphp
                <div class="pt-3 border-t border-white/10">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs text-blue-200/60 font-medium">Tingkat Persetujuan</span>
                        <span class="text-xs font-bold text-emerald-400">{{ $percentage }}%</span>
                    </div>
                    <div class="w-full h-2 bg-white/10 rounded-full overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-500" style="width: {{ $percentage }}%; background: linear-gradient(90deg, #10b981, #34d399);"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Aktivitas Terakhir -->
    <div class="bg-white rounded-2xl border border-surface-200/60 shadow-sm overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-surface-200/60 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-surface-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <h3 class="font-semibold text-surface-900">Riwayat Aktivitas Terakhir</h3>
            </div>
            <span class="text-xs text-primary-600 font-semibold cursor-pointer hover:underline">Lihat Semua</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-50 border-b border-surface-200/60">
                        <th class="px-6 py-3 text-[10px] font-bold text-surface-400 uppercase tracking-widest">Aktivitas</th>
                        <th class="px-6 py-3 text-[10px] font-bold text-surface-400 uppercase tracking-widest">Tanggal</th>
                        <th class="px-6 py-3 text-[10px] font-bold text-surface-400 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-3 text-[10px] font-bold text-surface-400 uppercase tracking-widest">Lokasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200/60">
                    @forelse($user->bookings()->latest()->take(5)->get() as $booking)
                    <tr class="hover:bg-surface-50/50 transition-colors">
                        <td class="px-6 py-3.5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center
                                    {{ $booking->status === 'approved' ? 'bg-emerald-100' : ($booking->status === 'rejected' ? 'bg-red-100' : 'bg-amber-100') }}">
                                    @if($booking->status === 'approved')
                                        <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                    @elseif($booking->status === 'rejected')
                                        <svg class="w-4 h-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                    @else
                                        <svg class="w-4 h-4 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    @endif
                                </div>
                                <span class="text-sm font-medium text-surface-900">Booking {{ $booking->room->name ?? 'Ruangan' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-3.5 text-sm text-surface-500">{{ $booking->created_at->format('d M Y, H:i') }}</td>
                        <td class="px-6 py-3.5">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-bold
                                {{ $booking->status === 'approved' ? 'bg-emerald-100 text-emerald-700' : ($booking->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700') }}">
                                {{ $booking->status === 'approved' ? 'Disetujui' : ($booking->status === 'rejected' ? 'Ditolak' : 'Menunggu') }}
                            </span>
                        </td>
                        <td class="px-6 py-3.5 text-sm text-surface-500">{{ $booking->room->name ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center">
                            <p class="text-sm text-surface-400">Belum ada riwayat aktivitas.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Admin Central -->
    <div class="bg-white rounded-2xl border border-surface-200/60 shadow-sm overflow-hidden">
        <div class="px-6 py-4 flex items-center gap-4">
            <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm text-white" style="background: linear-gradient(135deg, #4f46e5, #7c3aed);">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div>
                <p class="text-sm font-bold text-surface-900">Admin Central</p>
                <p class="text-xs text-surface-500">{{ auth()->user()->username }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
