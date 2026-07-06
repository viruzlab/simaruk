<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-surface-900 leading-tight">Pengaturan</h2>
    </x-slot>

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-surface-900">Pengaturan Akun & Sistem</h1>
        <p class="text-sm text-surface-500 mt-1">Kelola preferensi akun Anda dan pengaturan sistem.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Sidebar Navigation (Optional for settings, but we can just stack them for now or use a 2-column layout) -->
        <div class="lg:col-span-8 space-y-6">
            
            <!-- Update Profile Information Card -->
            <div class="bg-white rounded-2xl border border-surface-200/60 shadow-sm overflow-hidden" id="profile-info">
                <div class="px-6 py-4 border-b border-surface-200/60 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background: linear-gradient(135deg, #eef2ff, #e0e7ff);">
                        <svg class="w-4 h-4 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-surface-900">Informasi Profil</h3>
                        <p class="text-xs text-surface-500">Perbarui informasi profil dan username akun Anda.</p>
                    </div>
                </div>
                <div class="p-6">
                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                        @csrf
                    </form>

                    <form method="post" action="{{ route('profile.update') }}" class="space-y-5 max-w-xl">
                        @csrf
                        @method('patch')

                        <div>
                            <label for="name" class="block text-sm font-semibold text-surface-700 mb-2">Nama Lengkap</label>
                            <input id="name" name="name" type="text" class="w-full px-4 py-2.5 bg-surface-50 border border-surface-200 rounded-xl text-surface-900 focus:ring-2 focus:ring-primary-500/40 focus:border-primary-500 transition-all" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                            @error('name') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="username" class="block text-sm font-semibold text-surface-700 mb-2">Username</label>
                            <input id="username" name="username" type="text" class="w-full px-4 py-2.5 bg-surface-50 border border-surface-200 rounded-xl text-surface-900 focus:ring-2 focus:ring-primary-500/40 focus:border-primary-500 transition-all" value="{{ old('username', $user->username) }}" required autocomplete="username" />
                            @error('username') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="telegram_chat_id" class="block text-sm font-semibold text-surface-700 mb-2">Telegram Chat ID <span class="font-normal text-surface-500">(Opsional)</span></label>
                            <input id="telegram_chat_id" name="telegram_chat_id" type="text" class="w-full px-4 py-2.5 bg-surface-50 border border-surface-200 rounded-xl text-surface-900 focus:ring-2 focus:ring-primary-500/40 focus:border-primary-500 transition-all" value="{{ old('telegram_chat_id', $user->telegram_chat_id) }}" placeholder="Contoh: 123456789" />
                            <p class="mt-2 text-xs text-surface-500">
                                Isi dengan Chat ID Anda untuk menerima notifikasi peminjaman. Dapatkan Chat ID dengan mengirim pesan <b>/start</b> ke bot <b>@userinfobot</b> di aplikasi Telegram Anda.
                            </p>
                            @error('telegram_chat_id') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex items-center gap-4 pt-2">
                            <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-bold text-white bg-primary-600 rounded-xl hover:bg-primary-700 transition-all shadow-sm hover:shadow hover:-translate-y-0.5">
                                Simpan Perubahan
                            </button>

                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm font-medium text-emerald-600">
                                    Tersimpan.
                                </p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Update Password Card -->
            <div class="bg-white rounded-2xl border border-surface-200/60 shadow-sm overflow-hidden" id="password-update">
                <div class="px-6 py-4 border-b border-surface-200/60 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background: linear-gradient(135deg, #fef3c7, #fde68a);">
                        <svg class="w-4 h-4 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-surface-900">Ubah Password</h3>
                        <p class="text-xs text-surface-500">Pastikan akun Anda menggunakan password panjang dan acak agar tetap aman.</p>
                    </div>
                </div>
                <div class="p-6">
                    <form method="post" action="{{ route('password.update') }}" class="space-y-5 max-w-xl">
                        @csrf
                        @method('put')

                        <div>
                            <label for="current_password" class="block text-sm font-semibold text-surface-700 mb-2">Password Saat Ini</label>
                            <input id="current_password" name="current_password" type="password" class="w-full px-4 py-2.5 bg-surface-50 border border-surface-200 rounded-xl text-surface-900 focus:ring-2 focus:ring-primary-500/40 focus:border-primary-500 transition-all" autocomplete="current-password" />
                            @error('current_password', 'updatePassword') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-semibold text-surface-700 mb-2">Password Baru</label>
                            <input id="password" name="password" type="password" class="w-full px-4 py-2.5 bg-surface-50 border border-surface-200 rounded-xl text-surface-900 focus:ring-2 focus:ring-primary-500/40 focus:border-primary-500 transition-all" autocomplete="new-password" />
                            @error('password', 'updatePassword') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-surface-700 mb-2">Konfirmasi Password Baru</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" class="w-full px-4 py-2.5 bg-surface-50 border border-surface-200 rounded-xl text-surface-900 focus:ring-2 focus:ring-primary-500/40 focus:border-primary-500 transition-all" autocomplete="new-password" />
                            @error('password_confirmation', 'updatePassword') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex items-center gap-4 pt-2">
                            <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-bold text-surface-700 bg-white border border-surface-300 rounded-xl hover:bg-surface-50 transition-colors shadow-sm">
                                Perbarui Password
                            </button>

                            @if (session('status') === 'password-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm font-medium text-emerald-600">
                                    Berhasil diperbarui.
                                </p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete User Card -->
            <div class="bg-white rounded-2xl border border-red-200/60 shadow-sm overflow-hidden" id="account-delete">
                <div class="px-6 py-4 border-b border-red-100 bg-red-50/30 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center bg-red-100">
                        <svg class="w-4 h-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-red-800">Hapus Akun</h3>
                        <p class="text-xs text-red-600/80">Sekali akun dihapus, semua sumber daya dan datanya akan dihapus secara permanen.</p>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-sm text-surface-600 mb-5 max-w-xl">
                        Sebelum menghapus akun Anda, mohon unduh data atau informasi apa pun yang ingin Anda simpan.
                    </p>

                    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-bold text-white bg-red-600 rounded-xl hover:bg-red-700 transition-all shadow-sm hover:shadow hover:-translate-y-0.5">
                        Hapus Akun Permanen
                    </button>

                    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                            @csrf
                            @method('delete')

                            <h2 class="text-lg font-medium text-surface-900">
                                Apakah Anda yakin ingin menghapus akun Anda?
                            </h2>

                            <p class="mt-1 text-sm text-surface-600">
                                Sekali akun dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Masukkan password Anda untuk mengkonfirmasi bahwa Anda ingin menghapus akun ini secara permanen.
                            </p>

                            <div class="mt-6">
                                <label for="password" class="sr-only">Password</label>
                                <input id="password" name="password" type="password" class="w-full px-4 py-2.5 bg-surface-50 border border-surface-200 rounded-xl text-surface-900 focus:ring-2 focus:ring-red-500/40 focus:border-red-500 transition-all" placeholder="Password" />
                                @error('password', 'userDeletion') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div class="mt-6 flex justify-end gap-3">
                                <button type="button" x-on:click="$dispatch('close')" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-bold text-surface-700 bg-white border border-surface-300 rounded-xl hover:bg-surface-50 transition-colors shadow-sm">
                                    Batal
                                </button>

                                <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-bold text-white bg-red-600 rounded-xl hover:bg-red-700 transition-all shadow-sm">
                                    Hapus Akun
                                </button>
                            </div>
                        </form>
                    </x-modal>
                </div>
            </div>
        </div>

        <!-- Right Sidebar (Admin Only - Study Programs) -->
        <div class="lg:col-span-4">
            @if(auth()->user()->role === 'admin')
            <div class="bg-white rounded-2xl border border-surface-200/60 shadow-sm overflow-hidden sticky top-6" id="study-programs">
                <div class="px-6 py-4 border-b border-surface-200/60 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background: linear-gradient(135deg, #d1fae5, #a7f3d0);">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                        </div>
                        <h3 class="font-semibold text-surface-900">Program Studi / Unit</h3>
                    </div>
                </div>
                
                <!-- Add New Study Program Form -->
                <div class="p-4 border-b border-surface-100 bg-surface-50/50">
                    <form action="{{ route('study-programs.store') }}" method="POST">
                        @csrf
                        <div class="flex flex-col gap-2">
                            <label for="name" class="text-xs font-semibold text-surface-600">Tambah Program Studi / Unit Baru</label>
                            <div class="flex gap-2">
                                <input type="text" name="name" id="name" required class="flex-1 px-3 py-2 text-sm bg-white border border-surface-200 rounded-lg text-surface-900 focus:ring-2 focus:ring-emerald-500/40 focus:border-emerald-500 transition-all" placeholder="Nama program studi / unit...">
                                <button type="submit" class="px-4 py-2 text-sm font-bold text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 transition-colors shadow-sm">
                                    Tambah
                                </button>
                            </div>
                            @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            @if (session('status') === 'study-program-created')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="mt-1 text-xs font-medium text-emerald-600">
                                    Program studi berhasil ditambahkan.
                                </p>
                            @endif
                            @if (session('status') === 'study-program-deleted')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="mt-1 text-xs font-medium text-emerald-600">
                                    Program studi berhasil dihapus.
                                </p>
                            @endif
                        </div>
                    </form>
                </div>

                <!-- Study Programs List -->
                <div class="overflow-y-auto max-h-[400px] scrollbar-thin">
                    <ul class="divide-y divide-surface-100">
                        @forelse($studyPrograms as $sp)
                        <li class="px-5 py-3 flex items-center justify-between hover:bg-surface-50 transition-colors group">
                            <span class="text-sm font-medium text-surface-700">{{ $sp->name }}</span>
                            <form action="{{ route('study-programs.destroy', $sp) }}" method="POST" onsubmit="return confirm('Hapus program studi ini?');" class="opacity-0 group-hover:opacity-100 transition-opacity">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-surface-400 hover:text-red-500 hover:bg-red-50 rounded transition-colors" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        </li>
                        @empty
                        <li class="px-5 py-8 text-center text-sm text-surface-500">
                            Belum ada program studi.
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
            @else
            <!-- Placeholder for non-admins -->
            <div class="bg-surface-50 rounded-2xl border border-surface-200 border-dashed p-6 text-center h-full flex flex-col items-center justify-center">
                <svg class="w-10 h-10 text-surface-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                <p class="text-sm font-medium text-surface-500">Profil Anda sudah terverifikasi.</p>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
