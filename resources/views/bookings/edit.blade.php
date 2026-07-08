<x-app-layout>
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-surface-700/50 mb-6 mt-4 px-4 sm:px-6 lg:px-8">
        <a href="{{ route('dashboard') }}" class="hover:text-primary-600 transition-colors">Beranda</a>
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
        <a href="{{ route('bookings.index') }}" class="hover:text-primary-600 transition-colors">Daftar Permohonan</a>
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
        <span class="text-surface-900 font-medium">Edit #BK-{{ $booking->created_at->format('Y') }}-{{ str_pad($booking->id, 3, '0', STR_PAD_LEFT) }}</span>
    </nav>

    <div class="px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto pb-12" x-data="editBookingForm()">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider text-amber-700 bg-amber-50 border border-amber-200">
                    Menunggu Persetujuan
                </span>
                <span class="text-sm font-medium text-surface-500">
                    ID: #BK-{{ $booking->created_at->format('Y') }}-{{ str_pad($booking->id, 3, '0', STR_PAD_LEFT) }}
                </span>
            </div>
            <h1 class="text-3xl font-extrabold text-surface-900 tracking-tight">Edit Data Peminjaman</h1>
            <p class="text-sm text-surface-700/60 mt-2 font-medium">Perbaiki data peminjaman ruangan Anda. Setelah disimpan, admin akan meninjau ulang.</p>
        </div>

        @if($booking->admin_notes)
            <div class="mb-6 bg-amber-50 border border-amber-200 text-amber-700 px-4 py-3 rounded-xl shadow-sm flex items-start gap-3">
                <svg class="w-5 h-5 text-amber-500 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" /></svg>
                <div>
                    <p class="font-bold text-sm">Catatan dari Admin:</p>
                    <p class="text-sm mt-1">{{ $booking->admin_notes }}</p>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl shadow-sm">
                <ul class="list-disc list-inside text-sm font-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('bookings.update', $booking) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">

                <!-- Card 1: Detail Kegiatan -->
                <div class="bg-white rounded-2xl border border-surface-200/60 p-8 shadow-sm">
                    <div class="flex items-center gap-3 mb-8 pb-4 border-b border-surface-100">
                        <div class="w-10 h-10 rounded-xl bg-primary-50 flex items-center justify-center text-primary-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h2 class="text-xl font-bold text-surface-900">Detail Kegiatan</h2>
                    </div>

                    <div class="space-y-6">
                        <!-- Jenis Kegiatan -->
                        <div>
                            <label class="block text-sm font-semibold text-surface-800 mb-2">Jenis Kegiatan <span class="text-red-500">*</span></label>
                            <select name="purpose" class="w-full rounded-xl border-surface-200 shadow-sm focus:border-primary-500 focus:ring-primary-500/40 text-sm py-2.5 px-4 font-medium text-surface-900 bg-surface-50">
                                <option value="">Pilih jenis kegiatan...</option>
                                <option value="Seminar/Workshop/Kuliah Umum" {{ old('purpose', $booking->purpose) === 'Seminar/Workshop/Kuliah Umum' ? 'selected' : '' }}>Seminar/Workshop/Kuliah Umum</option>
                                <option value="Sidang Seminar Proposal Tesis/Disertasi" {{ old('purpose', $booking->purpose) === 'Sidang Seminar Proposal Tesis/Disertasi' ? 'selected' : '' }}>Sidang Seminar Proposal Tesis/Disertasi</option>
                                <option value="Sidang Ujian Tahap 1 Tesis/Disertasi" {{ old('purpose', $booking->purpose) === 'Sidang Ujian Tahap 1 Tesis/Disertasi' ? 'selected' : '' }}>Sidang Ujian Tahap 1 Tesis/Disertasi</option>
                                <option value="Sidang Ujian Tahap 2" {{ old('purpose', $booking->purpose) === 'Sidang Ujian Tahap 2' ? 'selected' : '' }}>Sidang Ujian Tahap 2</option>
                                <option value="Sidang Promosi Doktor" {{ old('purpose', $booking->purpose) === 'Sidang Promosi Doktor' ? 'selected' : '' }}>Sidang Promosi Doktor</option>
                                <option value="Rapat" {{ old('purpose', $booking->purpose) === 'Rapat' ? 'selected' : '' }}>Rapat</option>
                                <option value="Lainnya" {{ old('purpose', $booking->purpose) === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>

                        <!-- Nama Kegiatan -->
                        <div>
                            <label class="block text-sm font-semibold text-surface-800 mb-2">Nama Kegiatan <span class="text-red-500">*</span></label>
                            <input type="text" name="activity_name" value="{{ old('activity_name', $booking->activity_name) }}" class="w-full rounded-xl border-surface-200 shadow-sm focus:border-primary-500 focus:ring-primary-500/40 text-sm py-2.5 px-4 font-medium" placeholder="Contoh: Seminar Proposal Tesis - [Nama Mahasiswa]">
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label class="block text-sm font-semibold text-surface-800 mb-2">Deskripsi Kegiatan</label>
                            <textarea name="description" rows="4" class="w-full rounded-xl border-surface-200 shadow-sm focus:border-primary-500 focus:ring-primary-500/40 text-sm py-3 px-4 font-medium resize-none" placeholder="Jelaskan detail tujuan dan kebutuhan kegiatan ini secara singkat...">{{ old('description', $booking->description) }}</textarea>
                        </div>

                        <!-- Jumlah Peserta -->
                        <div>
                            <label class="block text-sm font-semibold text-surface-800 mb-2">Estimasi Jumlah Peserta <span class="text-red-500">*</span></label>
                            <div class="relative w-48">
                                <input type="number" name="participants_count" min="1" value="{{ old('participants_count', $booking->participants_count) }}" class="w-full rounded-xl border-surface-200 shadow-sm focus:border-primary-500 focus:ring-primary-500/40 text-sm py-2.5 pl-4 pr-10 font-medium" placeholder="0">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-surface-400">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                </div>
                            </div>
                            <p class="text-xs text-surface-500 mt-1.5 font-medium">Masukkan estimasi jumlah orang yang akan hadir di dalam ruangan.</p>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Waktu & Ruangan -->
                <div class="bg-white rounded-2xl border border-surface-200/60 p-8 shadow-sm">
                    <div class="flex items-center gap-3 mb-8 pb-4 border-b border-surface-100">
                        <div class="w-10 h-10 rounded-xl bg-primary-50 flex items-center justify-center text-primary-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h2 class="text-xl font-bold text-surface-900">Waktu & Ruangan</h2>
                    </div>

                    <div class="space-y-6">
                        <!-- Pilih Ruangan -->
                        <div>
                            <label class="block text-sm font-semibold text-surface-800 mb-2">Pilih Ruangan <span class="text-red-500">*</span></label>
                            <select name="room_id" class="w-full rounded-xl border-surface-200 shadow-sm focus:border-primary-500 focus:ring-primary-500/40 text-sm py-2.5 px-4 font-medium text-surface-900 bg-surface-50">
                                <option value="">-- Pilih Ruangan --</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" {{ old('room_id', $booking->room_id) == $room->id ? 'selected' : '' }}>
                                        {{ $room->name }} (Kapasitas: {{ $room->capacity }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Waktu -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-surface-800 mb-2">Waktu Mulai <span class="text-red-500">*</span></label>
                                <input type="datetime-local" name="start_time" value="{{ old('start_time', $booking->start_time->format('Y-m-d\TH:i')) }}" class="w-full rounded-xl border-surface-200 shadow-sm focus:border-primary-500 focus:ring-primary-500/40 text-sm py-2.5 px-4 font-medium">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-surface-800 mb-2">Waktu Selesai <span class="text-red-500">*</span></label>
                                <input type="datetime-local" name="end_time" value="{{ old('end_time', $booking->end_time->format('Y-m-d\TH:i')) }}" class="w-full rounded-xl border-surface-200 shadow-sm focus:border-primary-500 focus:ring-primary-500/40 text-sm py-2.5 px-4 font-medium">
                            </div>
                        </div>

                        <!-- Info: Previous date -->
                        <div class="bg-surface-50 rounded-xl p-4 border border-surface-200">
                            <p class="text-xs font-bold text-surface-500 uppercase tracking-wider mb-2">Tanggal Sebelumnya</p>
                            <p class="text-sm font-medium text-surface-700">
                                {{ $booking->start_time->translatedFormat('d F Y') }}, 
                                {{ $booking->start_time->format('H:i') }} - {{ $booking->end_time->format('H:i') }} WIB
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between">
                    <a href="{{ route('bookings.show', $booking) }}" class="px-6 py-2.5 text-sm font-bold text-surface-700 bg-white border border-surface-200 rounded-xl hover:bg-surface-50 transition-colors shadow-sm">Batal</a>
                    <button type="submit" class="inline-flex items-center gap-2 px-8 py-3 bg-primary-600 text-white text-sm font-bold rounded-xl hover:bg-primary-700 transition-colors shadow-sm shadow-primary-600/20">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        Simpan Perubahan
                    </button>
                </div>

            </div>
        </form>
    </div>

</x-app-layout>
