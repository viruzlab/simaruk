<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('users.index') }}"
                class="p-2 -ml-2 text-surface-400 hover:text-surface-600 rounded-lg hover:bg-surface-100 transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="font-bold text-xl text-surface-900 leading-tight">Tambah Pengguna Baru</h2>
        </div>
    </x-slot>



    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-surface-500 mb-6">
        <a href="{{ route('dashboard') }}" class="hover:text-primary-600 transition-colors">Beranda</a>
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <a href="{{ route('users.index') }}" class="hover:text-primary-600 transition-colors">Manajemen Pengguna</a>
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-surface-900 font-medium">Tambah Pengguna</span>
    </nav>

    <!-- Page Title -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-surface-900">Buat Pengguna Baru</h1>
        <p class="text-sm text-surface-500 mt-1">Tambah pengguna baru ke dalam sistem SIMARUK.</p>
    </div>

    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column: Basic Info -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Information Card -->
                <div class="bg-white rounded-2xl border border-surface-200/60 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-surface-200/60 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center"
                            style="background: linear-gradient(135deg, #eef2ff, #e0e7ff);">
                            <svg class="w-4 h-4 text-indigo-600" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-surface-900">Informasi Dasar</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Nama -->
                            <div>
                                <label for="name" class="block text-sm font-semibold text-surface-700 mb-2">Nama
                                    Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                    class="w-full px-4 py-2.5 bg-surface-50 border border-surface-200 rounded-xl text-surface-900 focus:ring-2 focus:ring-primary-500/40 focus:border-primary-500 transition-all"
                                    placeholder="Masukkan nama lengkap">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Username -->
                            <div>
                                <label for="username" class="block text-sm font-semibold text-surface-700 mb-2">Username
                                    <span class="text-red-500">*</span></label>
                                <input type="text" name="username" id="username" value="{{ old('username') }}"
                                    required
                                    class="w-full px-4 py-2.5 bg-surface-50 border border-surface-200 rounded-xl text-surface-900 focus:ring-2 focus:ring-primary-500/40 focus:border-primary-500 transition-all"
                                    placeholder="Username unik">
                                @error('username')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- NIM/NIP -->
                            <div>
                                <label for="nim_nip"
                                    class="block text-sm font-semibold text-surface-700 mb-2">NIP</label>
                                <input type="text" name="nim_nip" id="nim_nip" value="{{ old('nim_nip') }}"
                                    class="w-full px-4 py-2.5 bg-surface-50 border border-surface-200 rounded-xl text-surface-900 focus:ring-2 focus:ring-primary-500/40 focus:border-primary-500 transition-all"
                                    placeholder="Opsional">
                                @error('nim_nip')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div>
                                <label for="phone" class="block text-sm font-semibold text-surface-700 mb-2">Nomor
                                    Telepon</label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                    class="w-full px-4 py-2.5 bg-surface-50 border border-surface-200 rounded-xl text-surface-900 focus:ring-2 focus:ring-primary-500/40 focus:border-primary-500 transition-all"
                                    placeholder="081234567890">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Department Details Card -->
                <div class="bg-white rounded-2xl border border-surface-200/60 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-surface-200/60 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center"
                            style="background: linear-gradient(135deg, #d1fae5, #a7f3d0);">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-surface-900">Detail Departemen</h3>
                    </div>
                    <div class="p-6">
                        <div>
                            <label for="study_program"
                                class="block text-sm font-semibold text-surface-700 mb-2">Program Studi / Unit</label>
                            <div class="relative">
                                <select name="study_program" id="study_program"
                                    class="w-full pl-4 pr-4 py-3 bg-surface-50 border border-surface-200 rounded-xl focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors appearance-none">
                                    <option value="">-- Pilih Program Studi / Unit --</option>
                                    @foreach ($studyPrograms as $program)
                                        <option value="{{ $program }}"
                                            {{ old('study_program') === $program ? 'selected' : '' }}>
                                            {{ $program }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('study_program')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Account Settings -->
            <div class="space-y-6">
                <!-- Account Settings Card -->
                <div class="bg-white rounded-2xl border border-surface-200/60 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-surface-200/60 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center"
                            style="background: linear-gradient(135deg, #fef3c7, #fde68a);">
                            <svg class="w-4 h-4 text-amber-600" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-surface-900">Pengaturan Akun</h3>
                    </div>
                    <div class="p-6 space-y-5">
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-semibold text-surface-700 mb-2">Password
                                <span class="text-red-500">*</span></label>
                            <input type="password" name="password" id="password" required minlength="8"
                                class="w-full px-4 py-2.5 bg-surface-50 border border-surface-200 rounded-xl text-surface-900 focus:ring-2 focus:ring-primary-500/40 focus:border-primary-500 transition-all"
                                placeholder="Minimal 8 karakter">
                            @error('password')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div>
                            <label for="role" class="block text-sm font-semibold text-surface-700 mb-2">Peran
                                (Role) <span class="text-red-500">*</span></label>
                            <select name="role" id="role" required
                                class="w-full px-4 py-2.5 bg-surface-50 border border-surface-200 rounded-xl text-surface-900 focus:ring-2 focus:ring-primary-500/40 focus:border-primary-500 transition-all">
                                <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User Biasa
                                </option>
                                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrator
                                </option>
                            </select>
                            @error('role')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Telegram Chat ID -->
                        <div>
                            <label for="telegram_chat_id" class="block text-sm font-semibold text-surface-700 mb-2">Telegram Chat ID</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-surface-400" viewBox="0 0 24 24" fill="currentColor"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>
                                </div>
                                <input type="text" name="telegram_chat_id" id="telegram_chat_id" value="{{ old('telegram_chat_id') }}"
                                    class="w-full pl-10 pr-4 py-2.5 bg-surface-50 border border-surface-200 rounded-xl text-surface-900 focus:ring-2 focus:ring-primary-500/40 focus:border-primary-500 transition-all"
                                    placeholder="Contoh: 123456789">
                            </div>
                            <p class="text-xs text-surface-500 mt-1.5">Opsional. Chat ID dari Telegram untuk menerima notifikasi.</p>
                            @error('telegram_chat_id')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex gap-3">
                    <a href="{{ route('users.index') }}"
                        class="flex-1 text-center px-5 py-2.5 text-sm font-semibold text-surface-700 bg-white border border-surface-300 rounded-xl hover:bg-surface-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="flex-1 px-5 py-2.5 text-sm font-bold text-white rounded-xl transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5"
                        style="background: linear-gradient(135deg, #4f46e5, #7c3aed);">
                        Buat Pengguna
                    </button>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
