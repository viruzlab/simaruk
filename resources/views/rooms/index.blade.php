<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-surface-900 leading-tight">Daftar Ruangan</h2>
    </x-slot>

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-surface-700/50 mb-6">
        <a href="{{ route('dashboard') }}" class="hover:text-primary-600 transition-colors">Beranda</a>
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
        <span class="text-surface-900 font-medium">Manajemen Ruangan</span>
    </nav>

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-surface-900">Daftar Ruangan</h1>
            <p class="text-sm text-surface-700/50 mt-1">Kelola semua aset ruangan yang terdaftar.</p>
        </div>
        @if(auth()->user()->role === 'admin')
        <a href="{{ route('rooms.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary-600 text-white text-sm font-semibold rounded-xl hover:bg-primary-700 transition-colors shadow-sm shadow-primary-600/20">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Ruangan
        </a>
        @endif
    </div>

    @if(session('success'))
        <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl flex items-center gap-2" role="alert">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span class="text-sm">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Room Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
        @forelse($rooms as $room)
            <div class="bg-white rounded-2xl border border-surface-200/60 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 group">
                <!-- Photo -->
                <div class="relative h-48 overflow-hidden">
                    <img class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500"
                         src="{{ !empty($room->photos) ? asset('storage/'.$room->photos[0]) : 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80&w=600' }}"
                         alt="{{ $room->name }}">
                    <!-- Status Badge -->
                    <div class="absolute top-3 right-3">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold backdrop-blur-md
                            {{ $room->status === 'available' ? 'bg-emerald-500/90 text-white' : '' }}
                            {{ $room->status === 'maintenance' ? 'bg-amber-500/90 text-white' : '' }}
                            {{ $room->status === 'unavailable' ? 'bg-red-500/90 text-white' : '' }}">
                            <span class="w-1.5 h-1.5 rounded-full bg-white/80"></span>
                            @if($room->status === 'available') Aktif
                            @elseif($room->status === 'maintenance') Perbaikan
                            @else Non-Aktif
                            @endif
                        </span>
                    </div>
                </div>

                <!-- Info -->
                <div class="p-5">
                    <div class="flex items-center gap-2 mb-2">
                        <h3 class="text-lg font-bold text-surface-900">{{ $room->name }}</h3>
                        @if($room->code)
                        <span class="px-2 py-0.5 bg-primary-100 text-primary-700 text-[11px] font-semibold rounded-md">{{ $room->code }}</span>
                        @endif
                    </div>

                    <div class="flex items-center gap-4 mb-3">
                        <div class="flex items-center gap-1.5 text-sm text-surface-700/60">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>{{ $room->capacity }} Orang</span>
                        </div>
                        @if($room->floor)
                        <div class="flex items-center gap-1.5 text-sm text-surface-700/60">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5" />
                            </svg>
                            <span>Lantai {{ $room->floor }}</span>
                        </div>
                        @endif
                    </div>

                    @if($room->facilities)
                    <div class="flex flex-wrap gap-1.5 mb-4">
                        @foreach(explode(',', $room->facilities) as $facility)
                            <span class="px-2 py-0.5 bg-surface-100 text-surface-700/70 text-[11px] font-medium rounded-md">{{ trim($facility) }}</span>
                        @endforeach
                    </div>
                    @endif

                    <div class="flex items-center justify-between pt-3 border-t border-surface-100">
                        <a href="{{ route('rooms.show', $room) }}" class="text-sm text-primary-600 hover:text-primary-700 font-medium transition-colors">
                            Lihat Detail →
                        </a>

                        @if(auth()->user()->role === 'admin')
                        <div class="flex items-center gap-1">
                            <a href="{{ route('rooms.edit', $room) }}" class="p-2 rounded-lg text-surface-700/40 hover:text-primary-600 hover:bg-primary-50 transition-all" title="Edit">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                            </a>
                            <form action="{{ route('rooms.destroy', $room) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ruangan ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 rounded-lg text-surface-700/40 hover:text-red-600 hover:bg-red-50 transition-all" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white p-12 text-center rounded-2xl border border-surface-200/60 shadow-sm">
                <svg class="mx-auto h-12 w-12 text-surface-200 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <h3 class="text-sm font-semibold text-surface-900 mb-1">Belum ada ruangan</h3>
                <p class="text-sm text-surface-700/50">Silakan tambahkan ruangan baru.</p>
            </div>
        @endforelse
    </div>
</x-app-layout>
