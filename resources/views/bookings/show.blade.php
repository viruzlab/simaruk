<x-app-layout>
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-surface-700/50 mb-6 mt-4 px-4 sm:px-6 lg:px-8">
        <a href="{{ route('dashboard') }}" class="hover:text-primary-600 transition-colors">Beranda</a>
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
        <a href="{{ route('bookings.index') }}" class="hover:text-primary-600 transition-colors">Daftar Permohonan</a>
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
        <span class="text-surface-900 font-medium">Detail #BK-{{ $booking->created_at->format('Y') }}-{{ str_pad($booking->id, 3, '0', STR_PAD_LEFT) }}</span>
    </nav>

    <div class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto pb-12">
        
        @if(session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl shadow-sm flex items-center gap-3">
                <svg class="w-5 h-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                @if($booking->status === 'pending')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider text-amber-700 bg-amber-50 border border-amber-200">
                        Menunggu Persetujuan
                    </span>
                @elseif($booking->status === 'approved')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 border border-emerald-200">
                        Disetujui
                    </span>
                @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider text-red-700 bg-red-50 border border-red-200">
                        Ditolak
                    </span>
                @endif
                <span class="text-sm font-medium text-surface-500">
                    Diajukan {{ $booking->created_at->translatedFormat('d M Y') }}
                </span>
            </div>
            <h1 class="text-3xl font-extrabold text-surface-900 tracking-tight">Detail Permohonan Ruangan</h1>
            <p class="text-sm font-bold text-surface-500 mt-1 uppercase tracking-wider">
                ID Pemesanan: #BK-{{ $booking->created_at->format('Y') }}-{{ str_pad($booking->id, 3, '0', STR_PAD_LEFT) }}
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column (Main Content) -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Card 1: Informasi Pemohon -->
                <div class="bg-white rounded-2xl border border-surface-200/60 p-6 shadow-sm">
                    <div class="flex items-center gap-2 mb-6 text-surface-800">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        <h2 class="text-lg font-bold">Informasi Pemohon</h2>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-6 items-start">
                        <!-- Avatar -->
                        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-surface-700 to-surface-900 flex items-center justify-center text-white text-xl font-bold shadow-md shrink-0">
                            {{ strtoupper(substr($booking->user->name, 0, 2)) }}
                        </div>
                        
                        <!-- Details Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-8 w-full">
                            <div>
                                <p class="text-xs font-bold text-surface-400 uppercase tracking-wider mb-1">Nama Lengkap</p>
                                <p class="text-base font-bold text-surface-900">{{ $booking->user->name }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-surface-400 uppercase tracking-wider mb-1">NIM / NIP</p>
                                <p class="text-base font-bold text-surface-900">{{ $booking->user->nim_nip ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-surface-400 uppercase tracking-wider mb-1">Program Studi / Divisi</p>
                                <p class="text-base font-bold text-surface-900">{{ $booking->user->study_program ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-surface-400 uppercase tracking-wider mb-1">Kontak (WA/Telp)</p>
                                <p class="text-base font-bold text-surface-900">{{ $booking->user->phone ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Detail Kegiatan -->
                <div class="bg-white rounded-2xl border border-surface-200/60 p-6 shadow-sm">
                    <div class="flex items-center gap-2 mb-6 text-surface-800">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                        <h2 class="text-lg font-bold">Detail Kegiatan</h2>
                    </div>
                    
                    <div class="space-y-6">
                        <div>
                            <p class="text-xs font-bold text-surface-400 uppercase tracking-wider mb-1">Nama Kegiatan</p>
                            <p class="text-lg font-bold text-surface-900">{{ $booking->activity_name ?? $booking->purpose }}</p>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <p class="text-xs font-bold text-surface-400 uppercase tracking-wider mb-1">Jenis Kegiatan</p>
                                <p class="text-sm font-bold text-surface-700 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-surface-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                                    {{ $booking->purpose }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-surface-400 uppercase tracking-wider mb-1">Estimasi Peserta</p>
                                <p class="text-sm font-bold text-surface-700 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-surface-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                    {{ $booking->participants_count ?? 0 }} Orang
                                </p>
                            </div>
                        </div>
                        
                        <div>
                            <p class="text-xs font-bold text-surface-400 uppercase tracking-wider mb-2">Deskripsi Singkat</p>
                            <p class="text-sm text-surface-600 leading-relaxed bg-surface-50 p-4 rounded-xl border border-surface-100">
                                {{ $booking->description ?? 'Tidak ada deskripsi yang diberikan.' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Ruangan & Waktu -->
                <div class="bg-white rounded-2xl border border-surface-200/60 shadow-sm overflow-hidden flex flex-col md:flex-row">
                    <!-- Image Area -->
                    <div class="w-full md:w-5/12 shrink-0 relative min-h-[200px] overflow-hidden" style="background-color: #1e293b;">
                        @php
                            $roomPhotos = $booking->room->photos;
                            if (is_string($roomPhotos)) {
                                $roomPhotos = json_decode($roomPhotos, true);
                            }
                        @endphp
                        @if(!empty($roomPhotos) && is_array($roomPhotos) && count($roomPhotos) > 0)
                            <img src="{{ asset('storage/' . $roomPhotos[0]) }}" class="absolute inset-0 w-full h-full object-cover opacity-80" alt="{{ $booking->room->name }}">
                        @else
                            <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80&w=600" class="absolute inset-0 w-full h-full object-cover opacity-80" alt="Placeholder Ruangan">
                        @endif
                        <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(15, 23, 42, 0.9), transparent);"></div>
                        <div class="absolute bottom-4 left-6 right-6 text-white z-10">
                            <h3 class="text-xl font-bold">{{ $booking->room->name }}</h3>
                            <p class="text-sm font-medium opacity-90 mt-1">{{ $booking->room->floor ?? 'Lantai -' }} (Kapasitas: {{ $booking->room->capacity }} org)</p>
                        </div>
                    </div>
                    
                    <!-- Time Details -->
                    <div class="md:w-7/12 p-6 flex flex-col justify-center gap-6 bg-white">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-primary-50 text-primary-600 flex items-center justify-center shrink-0 mt-1">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-surface-400 uppercase tracking-wider mb-1">Tanggal</p>
                                <p class="text-base font-bold text-surface-900">{{ $booking->start_time->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-primary-50 text-primary-600 flex items-center justify-center shrink-0 mt-1">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-surface-400 uppercase tracking-wider mb-1">Waktu</p>
                                <p class="text-base font-bold text-surface-900">
                                    {{ $booking->start_time->format('H:i') }} - {{ $booking->end_time->format('H:i') }} WIB
                                </p>
                                @php
                                    $duration = $booking->start_time->diffInHours($booking->end_time);
                                @endphp
                                <p class="text-sm font-medium text-surface-500 mt-0.5">({{ $duration }} Jam)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fasilitas Tambahan -->
                <div class="bg-white rounded-2xl border border-surface-200/60 p-6 shadow-sm">
                    <p class="text-xs font-bold text-surface-400 uppercase tracking-wider mb-4">Fasilitas Tambahan</p>
                    <div class="flex flex-wrap gap-2">
                        @if($booking->room->facilities)
                            @foreach(explode(',', $booking->room->facilities) as $facility)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-medium text-surface-700 bg-surface-50 border border-surface-200">
                                    <svg class="w-4 h-4 text-surface-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                    {{ trim($facility) }}
                                </span>
                            @endforeach
                        @else
                            <p class="text-sm text-surface-500">Tidak ada fasilitas khusus.</p>
                        @endif
                    </div>
                </div>

            </div>

            <!-- Right Column (Sidebar) -->
            <div class="space-y-6">
                
                <!-- Riwayat Status -->
                <div class="bg-white rounded-2xl border border-surface-200/60 p-6 shadow-sm">
                    <h3 class="text-base font-bold text-surface-900 mb-6">Riwayat Status</h3>
                    
                    <div class="relative">
                        <!-- Timeline Line -->
                        <div class="absolute left-2.5 top-3 bottom-3 w-px bg-surface-200"></div>
                        
                        <!-- Step 1: Created -->
                        <div class="relative flex gap-4 mb-6">
                            <div class="w-5 h-5 rounded-full bg-emerald-500 border-4 border-white shadow-sm z-10 shrink-0"></div>
                            <div class="-mt-1">
                                <p class="text-sm font-bold text-surface-900">Permohonan Masuk</p>
                                <p class="text-xs font-medium text-surface-500 mt-1">{{ $booking->created_at->translatedFormat('d M Y, H:i') }} WIB</p>
                                <p class="text-xs text-surface-400 mt-0.5">Oleh {{ $booking->user->name }}</p>
                            </div>
                        </div>
                        
                        <!-- Step 2: In Progress/Pending -->
                        <div class="relative flex gap-4 mb-6">
                            <div class="w-5 h-5 rounded-full {{ $booking->status === 'pending' ? 'bg-amber-500' : 'bg-emerald-500' }} border-4 border-white shadow-sm z-10 shrink-0"></div>
                            <div class="-mt-1">
                                <p class="text-sm font-bold text-surface-900">Menunggu Persetujuan Admin</p>
                                @if($booking->status === 'pending')
                                    <p class="text-xs font-medium text-surface-500 mt-1">Sedang diproses</p>
                                @endif
                            </div>
                        </div>

                        <!-- Step 3: Result -->
                        <div class="relative flex gap-4">
                            @if($booking->status === 'approved')
                                <div class="w-5 h-5 rounded-full bg-emerald-500 border-4 border-white shadow-sm z-10 shrink-0"></div>
                                <div class="-mt-1">
                                    <p class="text-sm font-bold text-emerald-700">Peminjaman Disetujui</p>
                                    <p class="text-xs font-medium text-surface-500 mt-1">{{ $booking->updated_at->translatedFormat('d M Y, H:i') }} WIB</p>
                                </div>
                            @elseif($booking->status === 'rejected')
                                <div class="w-5 h-5 rounded-full bg-red-500 border-4 border-white shadow-sm z-10 shrink-0"></div>
                                <div class="-mt-1">
                                    <p class="text-sm font-bold text-red-700">Peminjaman Ditolak</p>
                                    <p class="text-xs font-medium text-surface-500 mt-1">{{ $booking->updated_at->translatedFormat('d M Y, H:i') }} WIB</p>
                                </div>
                            @else
                                <div class="w-5 h-5 rounded-full bg-surface-200 border-4 border-white shadow-sm z-10 shrink-0"></div>
                                <div class="-mt-1">
                                    <p class="text-sm font-bold text-surface-400">Selesai</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Tindak Lanjut (Admin Action / Note Display) -->
                <div class="bg-white rounded-2xl border border-surface-200/60 p-6 shadow-sm">
                    <h3 class="text-base font-bold text-surface-900 mb-4">Tindak Lanjut</h3>
                    
                    @if(auth()->user()->role === 'admin' && $booking->status === 'pending')
                        <form method="POST" id="action-form">
                            @csrf
                            @method('PATCH')
                            
                            <div class="mb-4">
                                <label for="admin_notes" class="block text-xs font-bold text-surface-500 mb-2">Catatan Admin (Opsional)</label>
                                <textarea id="admin_notes" name="admin_notes" rows="3" class="w-full bg-surface-50 border border-surface-200 rounded-xl text-sm p-3 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500" placeholder="Tuliskan alasan penolakan atau catatan tambahan..."></textarea>
                            </div>
                            
                            <div class="flex gap-3 mt-6">
                                <button type="submit" formaction="{{ route('bookings.reject', $booking) }}" class="flex-1 px-4 py-2.5 border border-red-200 text-red-600 bg-white hover:bg-red-50 font-bold rounded-xl text-sm transition-colors flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                    Tolak
                                </button>
                                <button type="submit" formaction="{{ route('bookings.approve', $booking) }}" class="flex-1 px-4 py-2.5 bg-surface-900 text-white hover:bg-surface-800 font-bold rounded-xl text-sm transition-colors flex items-center justify-center gap-2 shadow-lg">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                    Setujui
                                </button>
                            </div>
                            <p class="text-[11px] text-center text-surface-400 mt-4">
                                Dengan menyetujui, email notifikasi akan (segera) dikirimkan otomatis ke pemohon.
                            </p>
                        </form>
                    @elseif(auth()->user()->role === 'admin' && in_array($booking->status, ['approved', 'rejected']))
                        <!-- Admin can revoke approval/rejection -->
                        @if($booking->admin_notes)
                            <div class="mb-4">
                                <p class="text-xs font-bold text-surface-500 mb-2">Catatan Admin Sebelumnya</p>
                                <div class="bg-surface-50 border border-surface-200 rounded-xl p-4">
                                    <p class="text-sm text-surface-700">{{ $booking->admin_notes }}</p>
                                </div>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('bookings.revoke', $booking) }}" onsubmit="return confirm('Yakin ingin membatalkan status ini? Booking akan dikembalikan ke status Pending agar user dapat mengedit ulang.')">
                            @csrf
                            @method('PATCH')
                            
                            <div class="mb-4">
                                <label for="revoke_notes" class="block text-xs font-bold text-surface-500 mb-2">Alasan Pembatalan (Opsional)</label>
                                <textarea id="revoke_notes" name="admin_notes" rows="3" class="w-full bg-surface-50 border border-surface-200 rounded-xl text-sm p-3 focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500" placeholder="Contoh: Tanggal kegiatan salah, perlu diperbaiki..."></textarea>
                            </div>
                            
                            <button type="submit" class="w-full px-4 py-2.5 border border-amber-300 text-amber-700 bg-amber-50 hover:bg-amber-100 font-bold rounded-xl text-sm transition-colors flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" /></svg>
                                Batalkan & Kembalikan ke Pending
                            </button>
                            <p class="text-[11px] text-center text-surface-400 mt-3">
                                Status akan dikembalikan ke <strong>Pending</strong>. User akan mendapat notifikasi untuk mengedit dan mengajukan ulang.
                            </p>
                        </form>
                    @else
                        <!-- If already processed or user view -->
                        @if($booking->admin_notes)
                            <div>
                                <p class="text-xs font-bold text-surface-500 mb-2">Catatan Admin</p>
                                <div class="bg-surface-50 border border-surface-200 rounded-xl p-4">
                                    <p class="text-sm text-surface-700">{{ $booking->admin_notes }}</p>
                                </div>
                            </div>
                        @else
                            <div class="bg-surface-50 rounded-xl p-4 text-center">
                                <p class="text-sm text-surface-500 font-medium">Tidak ada catatan dari admin.</p>
                            </div>
                        @endif

                        @if($booking->status === 'pending' && (auth()->user()->role === 'admin' || $booking->user_id === auth()->id()))
                            <a href="{{ route('bookings.edit', $booking) }}" class="mt-4 w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-600 text-white hover:bg-blue-700 font-bold rounded-xl text-sm transition-colors shadow-sm">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                Edit Peminjaman
                            </a>
                        @endif
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
