<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-surface-900 leading-tight">Manajemen Pengguna</h2>
    </x-slot>

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-surface-500 mb-6">
        <a href="{{ route('dashboard') }}" class="hover:text-primary-600 transition-colors">Beranda</a>
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
        <span class="text-surface-900 font-medium">Manajemen Pengguna</span>
    </nav>

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-surface-900">Daftar Pengguna</h1>
            <p class="text-sm text-surface-500 mt-1">Kelola data seluruh admin dan pengguna dalam sistem informasi.</p>
        </div>
        <a href="{{ route('users.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white rounded-xl shadow-sm shadow-primary-600/20 transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5" style="background: linear-gradient(135deg, #4f46e5, #7c3aed);">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Pengguna
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl flex items-center gap-2" role="alert">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
    @endif
    
    @if(session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center gap-2" role="alert">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span class="text-sm font-medium">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Stat Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Total Users -->
        <div class="bg-white rounded-2xl border border-surface-200/60 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #eef2ff, #e0e7ff);">
                <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-surface-900">{{ $users->total() }}</p>
                <p class="text-xs text-surface-500 font-medium">Total Pengguna</p>
            </div>
        </div>
        <!-- Admin Count -->
        <div class="bg-white rounded-2xl border border-surface-200/60 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #fef3c7, #fde68a);">
                <svg class="w-6 h-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-surface-900">{{ App\Models\User::where('role', 'admin')->count() }}</p>
                <p class="text-xs text-surface-500 font-medium">Administrator</p>
            </div>
        </div>
        <!-- User Count -->
        <div class="bg-white rounded-2xl border border-surface-200/60 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #d1fae5, #a7f3d0);">
                <svg class="w-6 h-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-surface-900">{{ App\Models\User::where('role', 'user')->count() }}</p>
                <p class="text-xs text-surface-500 font-medium">User Biasa</p>
            </div>
        </div>
        <!-- New This Month -->
        <div class="bg-white rounded-2xl border border-surface-200/60 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #ede9fe, #ddd6fe);">
                <svg class="w-6 h-6 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-surface-900">{{ App\Models\User::whereMonth('created_at', now()->month)->count() }}</p>
                <p class="text-xs text-surface-500 font-medium">Baru (Bulan Ini)</p>
            </div>
        </div>
    </div>

    <!-- User Table -->
    <div class="bg-white rounded-2xl border border-surface-200/60 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-50 border-b border-surface-200/60">
                        <th class="px-6 py-4 text-xs font-bold text-surface-500 uppercase tracking-wider">Pengguna</th>
                        <th class="px-6 py-4 text-xs font-bold text-surface-500 uppercase tracking-wider">NIM/NIP</th>
                        <th class="px-6 py-4 text-xs font-bold text-surface-500 uppercase tracking-wider">Program Studi</th>
                        <th class="px-6 py-4 text-xs font-bold text-surface-500 uppercase tracking-wider">Peran</th>
                        <th class="px-6 py-4 text-xs font-bold text-surface-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-surface-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200/60">
                    @forelse($users as $user)
                        <tr class="hover:bg-surface-50/50 transition-colors">
                            <!-- User Info -->
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm text-white" style="background: linear-gradient(135deg, {{ $user->role === 'admin' ? '#4f46e5, #7c3aed' : '#0ea5e9, #06b6d4' }});">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <a href="{{ route('users.show', $user) }}" class="text-sm font-semibold text-surface-900 hover:text-primary-600 transition-colors">{{ $user->name }}</a>
                                        <p class="text-xs text-surface-500 mt-0.5">{{ '@' . $user->username }}</p>
                                    </div>
                                </div>
                            </td>
                            <!-- NIM/NIP -->
                            <td class="px-6 py-4">
                                <span class="text-sm text-surface-700 font-mono">{{ $user->nim_nip ?? '-' }}</span>
                            </td>
                            <!-- Study Program -->
                            <td class="px-6 py-4">
                                <span class="text-sm text-surface-600">{{ $user->study_program ?? '-' }}</span>
                            </td>
                            <!-- Role Badge -->
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold
                                    {{ $user->role === 'admin' ? 'bg-amber-100 text-amber-700' : 'bg-sky-100 text-sky-700' }}">
                                    @if($user->role === 'admin')
                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                                    @endif
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <!-- Status -->
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Active
                                </span>
                            </td>
                            <!-- Actions -->
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('users.show', $user) }}" class="p-2 text-surface-400 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-colors" title="Detail">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    </a>
                                    <a href="{{ route('users.edit', $user) }}" class="p-2 text-surface-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                    </a>
                                    @if(auth()->id() !== $user->id)
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-surface-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="w-14 h-14 text-surface-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                    <h3 class="text-sm font-semibold text-surface-900">Belum ada pengguna</h3>
                                    <p class="text-sm text-surface-500 mt-1">Data pengguna akan muncul di sini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($users->hasPages())
        <div class="px-6 py-4 border-t border-surface-200/60 bg-surface-50 flex items-center justify-between">
            <p class="text-xs text-surface-500">Menampilkan {{ $users->firstItem() }} - {{ $users->lastItem() }} dari {{ $users->total() }} pengguna</p>
            {{ $users->links() }}
        </div>
        @else
        <div class="px-6 py-3 border-t border-surface-200/60 bg-surface-50">
            <p class="text-xs text-surface-500">Menampilkan {{ $users->total() }} pengguna</p>
        </div>
        @endif
    </div>
</x-app-layout>
