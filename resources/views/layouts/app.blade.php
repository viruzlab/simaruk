<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="SIMARUK - Dashboard Manajemen Ruangan">

        <title>{{ config('app.name', 'SIMARUK') }}</title>
        <link rel="icon" href="{{ asset('logo1.png') }}" type="image/png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" x-data="{ sidebarOpen: false }">
        <div class="min-h-screen bg-surface-100 flex">
            <!-- Sidebar -->
            @include('layouts.navigation')

            <!-- Main Content -->
            <div class="flex-1 lg:ml-64 flex flex-col min-h-screen">
                <!-- Top Bar -->
                <header class="sticky top-0 z-30 bg-white/80 backdrop-blur-xl border-b border-surface-200/50">
                    <div class="flex items-center justify-between px-4 sm:px-6 lg:px-8 h-16">
                        <!-- Mobile Hamburger -->
                        <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-xl text-surface-700 hover:bg-surface-100 transition-colors">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                        <!-- Page Heading -->
                        @isset($header)
                            <div class="flex-1 lg:flex-none">
                                {{ $header }}
                            </div>
                        @endisset

                        <!-- Right Section -->
                        <div class="flex items-center gap-3">
                            <!-- Notification Bell -->
                            @php
                                $notifications = auth()->user()->unreadNotifications;
                            @endphp
                            <div class="relative" x-data="{ 
                                open: false, 
                                count: {{ $notifications->count() }},
                                markAsRead() {
                                    if (this.count > 0) {
                                        fetch('{{ route('notifications.markRead') }}', {
                                            method: 'POST',
                                            headers: {
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                'Accept': 'application/json'
                                            }
                                        }).then(() => {
                                            this.count = 0;
                                        });
                                    }
                                }
                            }">
                                <button @click="open = !open; markAsRead()" class="relative p-2 rounded-xl text-surface-700 hover:bg-surface-100 transition-colors focus:outline-none">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                    <!-- Indicator -->
                                    <span x-show="count > 0" class="absolute top-1.5 right-1.5 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white" style="display: none;"></span>
                                </button>

                                <div x-show="open" @click.outside="open = false" x-transition style="display: none;"
                                     class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-xl border border-surface-200 py-3 z-50">
                                    <div class="px-4 pb-2 border-b border-surface-100 mb-2 flex justify-between items-center">
                                        <h3 class="text-sm font-bold text-surface-900">Notifikasi</h3>
                                    </div>
                                    <div class="max-h-64 overflow-y-auto">
                                        @if($notifications->count() > 0)
                                            @foreach($notifications as $notification)
                                                <div class="px-4 py-3 hover:bg-surface-50 border-b border-surface-100 last:border-0 transition-colors">
                                                    <p class="text-sm text-surface-800 font-medium">{{ $notification->data['message'] }}</p>
                                                    <p class="text-xs text-surface-500 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="px-4 py-6 text-center">
                                                <svg class="w-12 h-12 text-surface-200 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                                </svg>
                                                <p class="text-sm text-surface-500 font-medium">Belum ada notifikasi baru</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- User Avatar (mobile) -->
                            <div class="lg:hidden" x-data="{ open: false }">
                                <button @click="open = !open" class="w-9 h-9 rounded-full bg-primary-600 text-white flex items-center justify-center text-sm font-bold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </button>
                                <div x-show="open" @click.outside="open = false" x-transition
                                     class="absolute right-4 mt-2 w-48 bg-white rounded-xl shadow-xl border border-surface-200 py-2 z-50">
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-surface-700 hover:bg-surface-50">Profile</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Log Out</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="p-4 sm:p-6 lg:p-8 flex-1 animate-fade-in">
                    {{ $slot }}
                </main>

                <!-- Footer -->
                <x-footer />
            </div>
        </div>

        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false"
             class="fixed inset-0 bg-black/50 z-40 lg:hidden">
        </div>
    </body>
</html>
