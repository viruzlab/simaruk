<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-surface-900 leading-tight">Tambah Ruangan</h2>
    </x-slot>

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-surface-700/50 mb-6">
        <a href="{{ route('dashboard') }}" class="hover:text-primary-600 transition-colors">Beranda</a>
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <a href="{{ route('rooms.index') }}" class="hover:text-primary-600 transition-colors">Manajemen Ruangan</a>
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-surface-900 font-medium">Tambah Ruangan</span>
    </nav>

    <!-- Page Title -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-surface-900">Tambah Ruangan Baru</h1>
        <p class="text-sm text-surface-700/50 mt-1">Lengkapi data di bawah ini untuk mendaftarkan aset ruangan ke
            sistem.</p>
    </div>

    @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- LEFT COLUMN -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Informasi Dasar -->
                <div class="bg-white rounded-2xl border border-surface-200/60 p-6 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-primary-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-primary-600" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-semibold text-surface-900">Informasi Dasar</h3>
                            <p class="text-xs text-surface-700/50">Informasi identitas dan lokasi fisik ruangan.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Nama Ruangan -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-surface-700 mb-2">Nama
                                Ruangan</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                class="input-modern" placeholder="Contoh: Lab Komputer A">
                        </div>

                        <!-- Kode Ruangan -->
                        <div>
                            <label for="code" class="block text-sm font-medium text-surface-700 mb-2">Kode
                                Ruangan</label>
                            <input type="text" name="code" id="code" value="{{ old('code') }}"
                                class="input-modern" placeholder="Contoh: LAK-001">
                        </div>

                        <!-- Lantai -->
                        <div>
                            <label for="floor" class="block text-sm font-medium text-surface-700 mb-2">Lantai</label>
                            <input type="text" name="floor" id="floor" value="{{ old('floor') }}"
                                class="input-modern" placeholder="Contoh: 1">
                        </div>

                        <!-- Kapasitas -->
                        <div>
                            <label for="capacity" class="block text-sm font-medium text-surface-700 mb-2">Kapasitas
                                Maksimal (Orang)</label>
                            <div class="relative">
                                <input type="number" name="capacity" id="capacity" value="{{ old('capacity') }}"
                                    min="1" required class="input-modern pr-14" placeholder="0">
                                <span
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-sm text-surface-700/40 font-medium">Orang</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kapasitas & Fasilitas -->
                <div class="bg-white rounded-2xl border border-surface-200/60 p-6 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-violet-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-violet-600" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-semibold text-surface-900">Kapasitas & Fasilitas</h3>
                            <p class="text-xs text-surface-700/50">Detail spesifikasi penggunaan ruangan.</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-surface-700 mb-3">Fasilitas Ruangan</label>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3" x-data="{ facilities: '{{ old('facilities', '') }}' }">
                            @php
                                $facilityOptions = [
                                    'Proyektor',
                                    'AC',
                                    'Sound System',
                                    'Whiteboard',
                                    'WiFi',
                                    'Video Conference',
                                ];
                                $oldFacilities = old('facilities', '');
                            @endphp
                            @foreach ($facilityOptions as $facility)
                                <label
                                    class="flex items-center gap-2.5 p-3 rounded-xl border border-surface-200 hover:border-primary-300 hover:bg-primary-50/50 transition-all cursor-pointer group">
                                    <input type="checkbox" name="facility_items[]" value="{{ $facility }}"
                                        class="w-4 h-4 rounded border-surface-200 text-primary-600 focus:ring-primary-500/40 focus:ring-offset-0"
                                        {{ str_contains($oldFacilities, $facility) ? 'checked' : '' }}>
                                    <span
                                        class="text-sm text-surface-700 group-hover:text-primary-700">{{ $facility }}</span>
                                </label>
                            @endforeach
                        </div>
                        <!-- Hidden input to combine facilities -->
                        <input type="hidden" name="facilities" id="facilities-hidden">
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN -->
            <div class="space-y-6">

                <!-- Status Ruangan -->
                <div class="bg-white rounded-2xl border border-surface-200/60 p-6 shadow-sm">
                    <h3 class="text-base font-semibold text-surface-900 mb-5">Status Ruangan</h3>
                    <div class="space-y-3">
                        <label
                            class="flex items-center justify-between p-3 rounded-xl border border-surface-200 hover:border-primary-300 cursor-pointer transition-all has-[:checked]:border-primary-500 has-[:checked]:bg-primary-50/50">
                            <div class="flex items-center gap-3">
                                <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                                <span class="text-sm font-medium text-surface-700">Aktif</span>
                            </div>
                            <input type="radio" name="status" value="available"
                                class="w-5 h-5 text-primary-600 border-surface-200 focus:ring-primary-500/40"
                                {{ old('status', 'available') === 'available' ? 'checked' : '' }}>
                        </label>

                        <label
                            class="flex items-center justify-between p-3 rounded-xl border border-surface-200 hover:border-primary-300 cursor-pointer transition-all has-[:checked]:border-primary-500 has-[:checked]:bg-primary-50/50">
                            <div class="flex items-center gap-3">
                                <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                                <span class="text-sm font-medium text-surface-700">Dalam Perbaikan</span>
                            </div>
                            <input type="radio" name="status" value="maintenance"
                                class="w-5 h-5 text-primary-600 border-surface-200 focus:ring-primary-500/40"
                                {{ old('status') === 'maintenance' ? 'checked' : '' }}>
                        </label>

                        <label
                            class="flex items-center justify-between p-3 rounded-xl border border-surface-200 hover:border-primary-300 cursor-pointer transition-all has-[:checked]:border-primary-500 has-[:checked]:bg-primary-50/50">
                            <div class="flex items-center gap-3">
                                <span class="w-3 h-3 rounded-full bg-surface-700/30"></span>
                                <span class="text-sm font-medium text-surface-700">Non-Aktif</span>
                            </div>
                            <input type="radio" name="status" value="unavailable"
                                class="w-5 h-5 text-primary-600 border-surface-200 focus:ring-primary-500/40"
                                {{ old('status') === 'unavailable' ? 'checked' : '' }}>
                        </label>
                    </div>
                </div>

                <!-- Foto Ruangan -->
                <div class="bg-white rounded-2xl border border-surface-200/60 p-6 shadow-sm">
                    <h3 class="text-base font-semibold text-surface-900 mb-1">Foto Ruangan</h3>
                    <p class="text-xs text-surface-700/50 mb-5">Unggah foto ruangan (Format JPG/PNG, maks 2MB).</p>

                    <div x-data="imageGallery()" class="space-y-4">
                        <!-- Upload Area -->
                        <label class="block w-full cursor-pointer">
                            <div class="border-2 border-dashed border-surface-200 rounded-xl p-6 text-center hover:border-primary-400 hover:bg-primary-50/30 transition-all">
                                <svg class="w-10 h-10 text-surface-200 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-sm text-surface-700/60 font-medium">Klik untuk unggah atau tarik file ke sini</p>
                                <p class="text-xs text-surface-700/40 mt-1">PNG, JPG up to 2MB (Maksimal 3 foto)</p>
                            </div>
                            <input type="file" name="photos[]" accept="image/*" multiple class="hidden" @change="handleFiles">
                        </label>

                        <!-- Preview Gallery -->
                        <div class="grid grid-cols-3 gap-3" x-show="previews.length > 0">
                            <template x-for="(src, index) in previews" :key="index">
                                <div class="relative group aspect-[4/3] rounded-lg overflow-hidden border border-surface-200">
                                    <img :src="src" class="w-full h-full object-cover">
                                    <button type="button" @click="removePhoto(index)" class="absolute top-1.5 right-1.5 w-6 h-6 rounded-full bg-red-500/80 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-600">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                    </button>
                                </div>
                            </template>
                            <!-- Empty Slots placeholer if less than 3 -->
                            <template x-for="i in (3 - previews.length)" :key="'empty-'+i">
                                <div class="aspect-[4/3] rounded-lg border-2 border-dashed border-surface-100 flex items-center justify-center bg-surface-50/50">
                                    <svg class="w-6 h-6 text-surface-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                </div>
                            </template>
                        </div>
                        
                        <!-- Alpine Component Script -->
                        <script>
                            document.addEventListener('alpine:init', () => {
                                Alpine.data('imageGallery', () => ({
                                    previews: [],
                                    files: [],
                                    handleFiles(event) {
                                        const selectedFiles = Array.from(event.target.files).slice(0, 3); // Max 3
                                        this.previews = [];
                                        this.files = selectedFiles;
                                        
                                        selectedFiles.forEach(file => {
                                            const reader = new FileReader();
                                            reader.onload = (e) => { this.previews.push(e.target.result); };
                                            reader.readAsDataURL(file);
                                        });
                                        
                                        // Create a new DataTransfer object to update the file input
                                        const dt = new DataTransfer();
                                        selectedFiles.forEach(file => dt.items.add(file));
                                        event.target.files = dt.files;
                                    },
                                    removePhoto(index) {
                                        this.previews.splice(index, 1);
                                        this.files.splice(index, 1);
                                        
                                        const dt = new DataTransfer();
                                        this.files.forEach(file => dt.items.add(file));
                                        document.querySelector('input[name="photos[]"]').files = dt.files;
                                    }
                                }))
                            })
                        </script>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-surface-200/60">
            <a href="{{ route('rooms.index') }}"
                class="px-6 py-2.5 text-sm font-medium text-surface-700 hover:text-surface-900 transition-colors">
                Batal
            </a>
            <button type="submit"
                class="inline-flex items-center gap-2 px-6 py-2.5 bg-primary-600 text-white text-sm font-semibold rounded-xl hover:bg-primary-700 transition-colors shadow-sm shadow-primary-600/20"
                onclick="
                        const checks = document.querySelectorAll('input[name=\'facility_items[]\']:checked');
                        const values = Array.from(checks).map(c => c.value).join(', ');
                        document.getElementById('facilities-hidden').value = values;
                    ">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Ruangan
            </button>
        </div>
    </form>
</x-app-layout>
