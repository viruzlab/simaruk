<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMARUK - Sistem Peminjaman Ruangan Akademik</title>
    <link rel="icon" href="{{ asset('img/logo1.png') }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Additional landing page specific styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .bg-hero-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        /* FullCalendar Custom Tailwind Styling */
        .fc-theme-standard td,
        .fc-theme-standard th,
        .fc-theme-standard .fc-scrollgrid {
            border-color: #e2e8f0;
        }

        .fc-col-header-cell-cushion {
            padding: 12px 8px !important;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            color: #64748b;
        }

        .fc-daygrid-day-number {
            font-weight: 600;
            color: #334155;
            padding: 8px !important;
        }

        .fc-day-today {
            background-color: #f8fafc !important;
        }

        .fc-day-today .fc-daygrid-day-number {
            color: #4f46e5;
            background-color: #e0e7ff;
            border-radius: 9999px;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 4px;
        }

        .fc-event {
            border: none !important;
            border-radius: 6px !important;
            padding: 3px 6px !important;
            font-size: 0.75rem !important;
            font-weight: 600 !important;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            margin-bottom: 3px !important;
            transition: all 0.2s;
            cursor: pointer;
        }

        .fc-event:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .fc-h-event .fc-event-title-container {
            padding-bottom: 2px;
        }

        .fc-toolbar-title {
            font-size: 1.25rem !important;
            font-weight: 800 !important;
            color: #0f172a;
        }

        .fc-button-primary {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            color: #475569 !important;
            font-weight: 600 !important;
            text-transform: capitalize !important;
            padding: 0.5rem 1rem !important;
            transition: all 0.2s !important;
        }

        .fc-button-primary:hover {
            background-color: #f8fafc !important;
            color: #0f172a !important;
        }

        .fc-button-primary:not(:disabled).fc-button-active,
        .fc-button-primary:not(:disabled):active {
            background-color: #f1f5f9 !important;
            color: #0f172a !important;
            border-color: #cbd5e1 !important;
            box-shadow: none !important;
        }

        .fc-today-button {
            background-color: #f8fafc !important;
        }
    </style>
</head>

<body
    class="antialiased bg-surface-50 text-surface-900 selection:bg-primary-500 selection:text-white flex flex-col min-h-screen">

    <!-- Navigation -->
    <nav
        class="fixed w-full z-50 transition-all duration-300 bg-white/80 backdrop-blur-md border-b border-surface-200/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="/" class="flex-shrink-0 flex items-center">
                    <img src="{{ asset('img/logo2.png') }}" alt="SIMARUK Logo"
                        class="w-40 sm:w-48 lg:w-56 h-auto object-contain drop-shadow-sm origin-left">
                </a>

                <!-- Right Nav -->
                <div class="flex items-center gap-4">


                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="inline-flex items-center justify-center px-6 py-2.5 bg-surface-900 hover:bg-surface-800 text-white text-sm font-bold rounded-xl transition-all shadow-sm">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-sm font-bold text-surface-700 hover:text-primary-600 transition-colors hidden sm:block">
                                Masuk
                            </a>

                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="flex-grow">
        <div class="relative bg-gradient-hero pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
            <!-- Background decorative elements -->
            <div class="absolute inset-0 bg-hero-pattern opacity-50"></div>
            <div
                class="absolute top-0 -left-4 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-blob">
            </div>
            <div
                class="absolute top-0 -right-4 w-72 h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute -bottom-8 left-20 w-72 h-72 bg-indigo-500 rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-blob animation-delay-4000">
            </div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
                <div class="flex justify-center -mb-12 -mt-20 lg:-mt-36 relative z-20">
                    <img src="{{ asset('img/logo1.png') }}" alt="SIMARUK Icon"
                        class="w-64 h-64 sm:w-80 sm:h-80 lg:w-96 lg:h-96 object-contain drop-shadow-2xl animate-pulse-slow scale-110">
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-7xl font-black text-white tracking-tight leading-tight mb-8">
                    Sistem Informasi Manajemen <br class="hidden sm:block">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-violet-400">
                        Ruangan & Kegiatan
                    </span>
                </h1>
                <p class="mt-4 max-w-2xl text-lg sm:text-xl text-surface-200 mx-auto font-medium leading-relaxed mb-10">
                    SIMARUK mempermudah proses peminjaman ruangan akademik. Cek ketersediaan, ajukan peminjaman, dan
                    pantau persetujuan dalam satu platform terpadu.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-surface-900 bg-white rounded-xl hover:bg-surface-50 transition-all shadow-xl hover:-translate-y-1">
                        Mulai Pinjam Sekarang
                    </a>

                </div>
            </div>

            <!-- Bottom wave/curve separator -->
            <div class="absolute bottom-0 w-full overflow-hidden leading-[0]">
                <svg class="relative block w-[calc(100%+1.3px)] h-[50px] lg:h-[100px]" data-name="Layer 1"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path
                        d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.08,130.83,119.45,189.5,109.28Z"
                        fill="#f8fafc"></path>
                </svg>
            </div>
        </div>

        <!-- Custom Tailwind Styling for FullCalendar -->
        <style>
            .fc-theme-standard td,
            .fc-theme-standard th,
            .fc-theme-standard .fc-scrollgrid {
                border-color: #e2e8f0;
                /* surface-200 */
            }

            .fc-col-header-cell-cushion {
                padding: 12px 8px !important;
                font-weight: 600;
                color: #475569;
                /* surface-600 */
                text-transform: uppercase;
                font-size: 0.75rem;
                letter-spacing: 0.05em;
            }

            .fc-daygrid-day-number {
                padding: 8px !important;
                font-weight: 500;
                color: #334155;
                /* surface-700 */
            }

            .fc .fc-daygrid-day.fc-day-today {
                background-color: #f8fafc;
                /* surface-50 */
            }

            .fc-daygrid-event {
                border-radius: 6px;
                padding: 2px 4px;
                font-size: 0.75rem;
                font-weight: 600;
                border: none;
                box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
                transition: transform 0.1s ease-in-out;
                cursor: pointer;
            }

            .fc-daygrid-event:hover {
                transform: translateY(-1px);
                opacity: 0.9;
            }

            .fc .fc-toolbar-title {
                font-size: 1.25rem;
                font-weight: 700;
                color: #0f172a;
                /* surface-900 */
            }

            .fc .fc-button-primary {
                background-color: #ffffff;
                border-color: #e2e8f0;
                color: #334155;
                font-weight: 600;
                text-transform: capitalize;
                transition: all 0.2s;
                border-radius: 8px;
            }

            .fc .fc-button-primary:hover,
            .fc .fc-button-primary:not(:disabled).fc-button-active,
            .fc .fc-button-primary:not(:disabled):active {
                background-color: #f1f5f9;
                /* surface-100 */
                border-color: #cbd5e1;
                /* surface-300 */
                color: #0f172a;
            }

            .fc .fc-button-primary:focus {
                box-shadow: 0 0 0 2px rgba(14, 165, 233, 0.2);
                /* primary-500 */
            }
        </style>
        <!-- Calendar Section -->
        <div id="kalender" class="py-24 bg-white relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-base font-bold text-primary-600 tracking-wide uppercase">Jadwal Real-time</h2>
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-surface-900 sm:text-4xl">
                        Pantau Kegiatan Kampus
                    </p>
                    <p class="mt-4 max-w-2xl text-lg text-surface-600 mx-auto">
                        Lihat jadwal penggunaan ruangan akademik secara transparan sebelum Anda mengajukan permohonan.
                    </p>
                </div>

                <div class="bg-white p-6 rounded-3xl border border-surface-200/60 shadow-xl overflow-hidden">
                    <!-- Legend -->
                    <div class="flex flex-wrap gap-4 mb-6 text-sm font-medium">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-violet-500"></span>
                            <span class="text-surface-700">Seminar/Workshop/Kuliah</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-blue-500"></span>
                            <span class="text-surface-700">Sidang Proposal</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-teal-500"></span>
                            <span class="text-surface-700">Sidang Tahap 1</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                            <span class="text-surface-700">Sidang Tahap 2</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                            <span class="text-surface-700">Sidang Promosi</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-pink-500"></span>
                            <span class="text-surface-700">Rapat</span>
                        </div>
                    </div>

                    <!-- Calendar Container -->
                    <div id="calendar" class="min-h-[600px]"></div>
                </div>
            </div>
        </div>

        <!-- Calendar Modal (Alpine Component) -->
        <div x-data="{ open: false, event: {} }"
            @open-event-modal.window="
                    event = $event.detail.event;
                    open = true;
                 ">

            <!-- Backdrop -->
            <div x-show="open" x-transition.opacity class="fixed inset-0 z-50 bg-surface-900/40 backdrop-blur-sm"
                style="display: none;"></div>

            <!-- Modal Content -->
            <div x-show="open" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0" style="display: none;">

                <div @click.outside="open = false"
                    class="bg-white rounded-2xl shadow-xl border border-surface-200/60 w-full max-w-lg overflow-hidden">
                    <div class="px-6 py-5 border-b border-surface-100 flex items-center justify-between"
                        :style="'border-top: 4px solid ' + event.backgroundColor">
                        <h3 class="text-lg font-bold text-surface-900" x-text="event.title"></h3>
                        <button @click="open = false"
                            class="text-surface-400 hover:text-surface-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="p-6 space-y-4">
                        <div>
                            <p class="text-xs font-semibold text-surface-500 uppercase tracking-wider mb-1">Ruangan</p>
                            <p class="text-sm font-medium text-surface-900" x-text="event.extendedProps?.room"></p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-surface-500 uppercase tracking-wider mb-1">Peminjam
                            </p>
                            <p class="text-sm font-medium text-surface-900" x-text="event.extendedProps?.user"></p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-surface-500 uppercase tracking-wider mb-1">Waktu</p>
                            <p class="text-sm font-medium text-surface-900">
                                <span
                                    x-text="new Date(event.start).toLocaleString('id-ID', {day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit'})"></span>
                                s/d
                                <span
                                    x-text="new Date(event.end).toLocaleString('id-ID', {hour: '2-digit', minute: '2-digit'})"></span>
                            </p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-surface-500 uppercase tracking-wider mb-1">Tujuan</p>
                            <p class="text-sm text-surface-700 bg-surface-50 p-3 rounded-lg border border-surface-100 mt-1"
                                x-text="event.extendedProps?.purpose"></p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-surface-500 uppercase tracking-wider mb-1">Status</p>
                            <span class="inline-flex px-2.5 py-1 rounded-md text-xs font-bold text-white capitalize"
                                :style="'background-color: ' + event.backgroundColor"
                                x-text="event.extendedProps?.status"></span>
                        </div>
                    </div>

                    <div class="px-6 py-4 bg-surface-50 border-t border-surface-100 flex justify-end">
                        <button @click="open = false"
                            class="px-4 py-2 bg-white border border-surface-200 text-sm font-semibold text-surface-700 rounded-lg hover:bg-surface-100 transition-colors">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer Component -->
    <x-footer />

    <!-- FullCalendar Script -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var eventsData = @json($events ?? []);

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                buttonText: {
                    today: 'Hari Ini',
                    month: 'Bulan',
                    week: 'Minggu',
                    day: 'Hari'
                },
                events: eventsData,
                displayEventTime: true,
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: false,
                    hour12: false
                },
                eventClick: function(info) {
                    info.jsEvent.preventDefault();
                    window.dispatchEvent(new CustomEvent('open-event-modal', {
                        detail: info
                    }));
                }
            });

            calendar.render();
        });
    </script>
</body>

</html>
