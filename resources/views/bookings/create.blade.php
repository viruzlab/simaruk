<x-app-layout>
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-surface-700/50 mb-6 mt-4 px-4 sm:px-6 lg:px-8">
        <a href="{{ route('dashboard') }}" class="hover:text-primary-600 transition-colors">Beranda</a>
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
        <span class="text-surface-900 font-medium">Peminjaman Baru</span>
    </nav>

    <div class="px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto pb-12" x-data="bookingForm()">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-surface-900 tracking-tight">Buat Peminjaman Baru</h1>
            <p class="text-sm text-surface-700/60 mt-2 font-medium">Lengkapi formulir di bawah ini untuk mengajukan peminjaman ruangan kegiatan akademik.</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl shadow-sm">
                <ul class="list-disc list-inside text-sm font-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Stepper -->
        <div class="flex items-center justify-between bg-surface-50 p-2 rounded-2xl mb-8 border border-surface-200/60 shadow-sm relative overflow-hidden">
            <div class="absolute inset-0 bg-white/50 backdrop-blur-sm pointer-events-none"></div>
            <!-- Step 1 -->
            <div class="relative flex-1 text-center py-2.5 rounded-xl transition-all duration-300 font-bold text-sm flex justify-center items-center gap-2"
                 :class="step === 1 ? 'bg-white shadow-sm text-primary-700 ring-1 ring-surface-200' : (step > 1 ? 'text-primary-600' : 'text-surface-400')">
                <span class="w-5 h-5 rounded-full flex items-center justify-center text-[10px]"
                      :class="step === 1 ? 'bg-primary-100 text-primary-700' : (step > 1 ? 'bg-primary-600 text-white' : 'bg-surface-200 text-surface-500')">1</span>
                Informasi Dasar
            </div>
            <!-- Step 2 -->
            <div class="relative flex-1 text-center py-2.5 rounded-xl transition-all duration-300 font-bold text-sm flex justify-center items-center gap-2"
                 :class="step === 2 ? 'bg-white shadow-sm text-primary-700 ring-1 ring-surface-200' : (step > 2 ? 'text-primary-600' : 'text-surface-400')">
                <span class="w-5 h-5 rounded-full flex items-center justify-center text-[10px]"
                      :class="step === 2 ? 'bg-primary-100 text-primary-700' : (step > 2 ? 'bg-primary-600 text-white' : 'bg-surface-200 text-surface-500')">2</span>
                Waktu & Ruangan
            </div>
            <!-- Step 3 -->
            <div class="relative flex-1 text-center py-2.5 rounded-xl transition-all duration-300 font-bold text-sm flex justify-center items-center gap-2"
                 :class="step === 3 ? 'bg-white shadow-sm text-primary-700 ring-1 ring-surface-200' : 'text-surface-400'">
                <span class="w-5 h-5 rounded-full flex items-center justify-center text-[10px]"
                      :class="step === 3 ? 'bg-primary-100 text-primary-700' : 'bg-surface-200 text-surface-500'">3</span>
                Konfirmasi
            </div>
        </div>

        <form action="{{ route('bookings.store') }}" method="POST" id="bookingForm">
            @csrf

            <!-- ================= STEP 1: INFORMASI DASAR ================= -->
            <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" style="display: none;">
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
                            <select x-model="formData.purpose" name="purpose" class="w-full rounded-xl border-surface-200 shadow-sm focus:border-primary-500 focus:ring-primary-500/40 text-sm py-2.5 px-4 font-medium text-surface-900 bg-surface-50">
                                <option value="">Pilih jenis kegiatan...</option>
                                <option value="Seminar/Workshop/Kuliah Umum">Seminar/Workshop/Kuliah Umum</option>
                                <option value="Sidang Seminar Proposal Tesis/Disertasi">Sidang Seminar Proposal Tesis/Disertasi</option>
                                <option value="Sidang Ujian Tahap 1 Tesis/Disertasi">Sidang Ujian Tahap 1 Tesis/Disertasi</option>
                                <option value="Sidang Ujian Tahap 2">Sidang Ujian Tahap 2</option>
                                <option value="Sidang Promosi Doktor">Sidang Promosi Doktor</option>
                                <option value="Rapat">Rapat</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            <p x-show="validationErrors.purpose" class="text-red-500 text-xs mt-1 font-medium" x-text="validationErrors.purpose"></p>
                        </div>

                        <!-- Nama Kegiatan -->
                        <div>
                            <label class="block text-sm font-semibold text-surface-800 mb-2">Nama Kegiatan <span class="text-red-500">*</span></label>
                            <input x-model="formData.activity_name" type="text" name="activity_name" class="w-full rounded-xl border-surface-200 shadow-sm focus:border-primary-500 focus:ring-primary-500/40 text-sm py-2.5 px-4 font-medium" placeholder="Contoh: Seminar Proposal Tesis - [Nama Mahasiswa]">
                            <p x-show="validationErrors.activity_name" class="text-red-500 text-xs mt-1 font-medium" x-text="validationErrors.activity_name"></p>
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label class="block text-sm font-semibold text-surface-800 mb-2">Deskripsi Kegiatan</label>
                            <textarea x-model="formData.description" name="description" rows="4" class="w-full rounded-xl border-surface-200 shadow-sm focus:border-primary-500 focus:ring-primary-500/40 text-sm py-3 px-4 font-medium resize-none" placeholder="Jelaskan detail tujuan dan kebutuhan kegiatan ini secara singkat..."></textarea>
                        </div>

                        <!-- Jumlah Peserta -->
                        <div>
                            <label class="block text-sm font-semibold text-surface-800 mb-2">Estimasi Jumlah Peserta <span class="text-red-500">*</span></label>
                            <div class="relative w-48">
                                <input x-model="formData.participants_count" type="number" name="participants_count" min="1" class="w-full rounded-xl border-surface-200 shadow-sm focus:border-primary-500 focus:ring-primary-500/40 text-sm py-2.5 pl-4 pr-10 font-medium" placeholder="0">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-surface-400">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                </div>
                            </div>
                            <p class="text-xs text-surface-500 mt-1.5 font-medium">Masukkan estimasi jumlah orang yang akan hadir di dalam ruangan.</p>
                            <p x-show="validationErrors.participants_count" class="text-red-500 text-xs mt-1 font-medium" x-text="validationErrors.participants_count"></p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-10 pt-6 border-t border-surface-100 flex items-center justify-between">
                        <a href="{{ route('rooms.index') }}" class="px-6 py-2.5 text-sm font-bold text-surface-700 bg-white border border-surface-200 rounded-xl hover:bg-surface-50 transition-colors shadow-sm">Batal</a>
                        <button type="button" @click="nextStep(1)" class="inline-flex items-center gap-2 px-6 py-2.5 bg-surface-800 text-white text-sm font-bold rounded-xl hover:bg-surface-900 transition-colors shadow-sm">
                            Lanjut ke Waktu & Ruangan
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- ================= STEP 2: WAKTU & RUANGAN ================= -->
            <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" style="display: none;">
                <div class="bg-white rounded-2xl border border-surface-200/60 p-8 shadow-sm">
                    <div class="flex items-center gap-3 mb-8 pb-4 border-b border-surface-100">
                        <div class="w-10 h-10 rounded-xl bg-primary-50 flex items-center justify-center text-primary-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h2 class="text-xl font-bold text-surface-900">Penjadwalan</h2>
                    </div>

                    <div class="space-y-6">
                        <!-- Pilih Ruangan -->
                        <div>
                            <label class="block text-sm font-semibold text-surface-800 mb-2">Pilih Ruangan <span class="text-red-500">*</span></label>
                            <select x-model="formData.room_id" @change="updateRoomName($event)" name="room_id" class="w-full rounded-xl border-surface-200 shadow-sm focus:border-primary-500 focus:ring-primary-500/40 text-sm py-2.5 px-4 font-medium text-surface-900 bg-surface-50">
                                <option value="">-- Pilih Ruangan --</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" data-name="{{ $room->name }}">
                                        {{ $room->name }} (Kapasitas: {{ $room->capacity }})
                                    </option>
                                @endforeach
                            </select>
                            <p x-show="validationErrors.room_id" class="text-red-500 text-xs mt-1 font-medium" x-text="validationErrors.room_id"></p>
                        </div>

                        <!-- Waktu -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-surface-800 mb-2">Waktu Mulai <span class="text-red-500">*</span></label>
                                <input x-model="formData.start_time" type="datetime-local" name="start_time" class="w-full rounded-xl border-surface-200 shadow-sm focus:border-primary-500 focus:ring-primary-500/40 text-sm py-2.5 px-4 font-medium">
                                <p x-show="validationErrors.start_time" class="text-red-500 text-xs mt-1 font-medium" x-text="validationErrors.start_time"></p>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-surface-800 mb-2">Waktu Selesai <span class="text-red-500">*</span></label>
                                <input x-model="formData.end_time" type="datetime-local" name="end_time" class="w-full rounded-xl border-surface-200 shadow-sm focus:border-primary-500 focus:ring-primary-500/40 text-sm py-2.5 px-4 font-medium">
                                <p x-show="validationErrors.end_time" class="text-red-500 text-xs mt-1 font-medium" x-text="validationErrors.end_time"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-10 pt-6 border-t border-surface-100 flex items-center justify-between">
                        <button type="button" @click="step = 1" class="px-6 py-2.5 text-sm font-bold text-surface-700 bg-white border border-surface-200 rounded-xl hover:bg-surface-50 transition-colors shadow-sm">Kembali</button>
                        <button type="button" @click="nextStep(2)" class="inline-flex items-center gap-2 px-6 py-2.5 bg-surface-800 text-white text-sm font-bold rounded-xl hover:bg-surface-900 transition-colors shadow-sm">
                            Lanjut ke Konfirmasi
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- ================= STEP 3: KONFIRMASI ================= -->
            <div x-show="step === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" style="display: none;">
                <div class="bg-white rounded-2xl border border-surface-200/60 p-8 shadow-sm">
                    <div class="flex items-center gap-3 mb-8 pb-4 border-b border-surface-100">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h2 class="text-xl font-bold text-surface-900">Konfirmasi Data</h2>
                    </div>

                    <div class="space-y-6">
                        <!-- Summary Cards -->
                        <div class="bg-surface-50 rounded-xl p-6 border border-surface-200">
                            <h3 class="text-sm font-bold text-surface-500 uppercase tracking-wider mb-4">Informasi Kegiatan</h3>
                            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">
                                <div>
                                    <dt class="text-sm font-semibold text-surface-500">Jenis Kegiatan</dt>
                                    <dd class="mt-1 text-sm font-bold text-surface-900" x-text="formData.purpose"></dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-semibold text-surface-500">Nama Kegiatan</dt>
                                    <dd class="mt-1 text-sm font-bold text-surface-900" x-text="formData.activity_name"></dd>
                                </div>
                                <div class="sm:col-span-2">
                                    <dt class="text-sm font-semibold text-surface-500">Deskripsi</dt>
                                    <dd class="mt-1 text-sm text-surface-700 font-medium" x-text="formData.description || '-'"></dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-semibold text-surface-500">Estimasi Peserta</dt>
                                    <dd class="mt-1 text-sm font-bold text-surface-900"><span x-text="formData.participants_count"></span> Orang</dd>
                                </div>
                            </dl>
                        </div>

                        <div class="bg-primary-50/50 rounded-xl p-6 border border-primary-100">
                            <h3 class="text-sm font-bold text-primary-600/80 uppercase tracking-wider mb-4">Waktu & Ruangan</h3>
                            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">
                                <div class="sm:col-span-2">
                                    <dt class="text-sm font-semibold text-primary-600/80">Ruangan</dt>
                                    <dd class="mt-1 text-base font-bold text-primary-900" x-text="selectedRoomName"></dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-semibold text-primary-600/80">Waktu Mulai</dt>
                                    <dd class="mt-1 text-sm font-bold text-primary-900" x-text="formatDate(formData.start_time)"></dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-semibold text-primary-600/80">Waktu Selesai</dt>
                                    <dd class="mt-1 text-sm font-bold text-primary-900" x-text="formatDate(formData.end_time)"></dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-10 pt-6 border-t border-surface-100 flex items-center justify-between">
                        <button type="button" @click="step = 2" class="px-6 py-2.5 text-sm font-bold text-surface-700 bg-white border border-surface-200 rounded-xl hover:bg-surface-50 transition-colors shadow-sm">Kembali</button>
                        <button type="submit" class="inline-flex items-center gap-2 px-8 py-3 bg-primary-600 text-white text-sm font-bold rounded-xl hover:bg-primary-700 transition-colors shadow-sm shadow-primary-600/20">
                            Ajukan Peminjaman
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>

    <!-- Alpine JS Script for Form Wizard -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('bookingForm', () => ({
                step: 1,
                formData: {
                    purpose: '{{ old('purpose', '') }}',
                    activity_name: '{{ old('activity_name', '') }}',
                    description: '{{ old('description', '') }}',
                    participants_count: '{{ old('participants_count', '') }}',
                    room_id: '{{ old('room_id', $room_id ?? '') }}',
                    start_time: '{{ old('start_time', '') }}',
                    end_time: '{{ old('end_time', '') }}'
                },
                validationErrors: {},
                selectedRoomName: '-',

                init() {
                    // Initialize room name if room_id is already set (e.g. from redirect with old input or query param)
                    if (this.formData.room_id) {
                        this.$nextTick(() => {
                            const select = document.querySelector('select[name="room_id"]');
                            if (select) {
                                const option = select.options[select.selectedIndex];
                                if (option) this.selectedRoomName = option.getAttribute('data-name');
                            }
                        });
                    }
                },

                updateRoomName(event) {
                    const option = event.target.options[event.target.selectedIndex];
                    this.selectedRoomName = option ? option.getAttribute('data-name') : '-';
                },

                nextStep(currentStep) {
                    this.validationErrors = {};
                    let isValid = true;

                    if (currentStep === 1) {
                        if (!this.formData.purpose) { this.validationErrors.purpose = 'Pilih jenis kegiatan.'; isValid = false; }
                        if (!this.formData.activity_name) { this.validationErrors.activity_name = 'Nama kegiatan wajib diisi.'; isValid = false; }
                        if (!this.formData.participants_count || this.formData.participants_count < 1) { this.validationErrors.participants_count = 'Masukkan jumlah peserta yang valid.'; isValid = false; }
                    }

                    if (currentStep === 2) {
                        if (!this.formData.room_id) { this.validationErrors.room_id = 'Pilih ruangan.'; isValid = false; }
                        if (!this.formData.start_time) { this.validationErrors.start_time = 'Waktu mulai wajib diisi.'; isValid = false; }
                        if (!this.formData.end_time) { this.validationErrors.end_time = 'Waktu selesai wajib diisi.'; isValid = false; }
                        
                        // Basic client side validation for time
                        if(this.formData.start_time && this.formData.end_time) {
                            if(new Date(this.formData.end_time) <= new Date(this.formData.start_time)) {
                                this.validationErrors.end_time = 'Waktu selesai harus setelah waktu mulai.';
                                isValid = false;
                            }
                        }
                    }

                    if (isValid) {
                        this.step = currentStep + 1;
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }
                },

                formatDate(dateString) {
                    if (!dateString) return '-';
                    const date = new Date(dateString);
                    return date.toLocaleString('id-ID', {
                        weekday: 'long', year: 'numeric', month: 'long', day: 'numeric',
                        hour: '2-digit', minute: '2-digit'
                    });
                }
            }));
        });
    </script>
</x-app-layout>
