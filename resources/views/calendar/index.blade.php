<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-surface-900 leading-tight">Kalender Kegiatan</h2>
    </x-slot>

    <!-- FullCalendar Core CSS & JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>

    <!-- Custom Tailwind Styling for FullCalendar -->
    <style>
        .fc-theme-standard td, .fc-theme-standard th, .fc-theme-standard .fc-scrollgrid {
            border-color: #e2e8f0; /* surface-200 */
        }
        .fc-col-header-cell-cushion {
            padding: 12px 8px !important;
            font-weight: 600;
            color: #475569; /* surface-600 */
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }
        .fc-daygrid-day-number {
            padding: 8px !important;
            font-weight: 500;
            color: #334155; /* surface-700 */
        }
        .fc .fc-daygrid-day.fc-day-today {
            background-color: #f8fafc; /* surface-50 */
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
            color: #0f172a; /* surface-900 */
        }
        .fc .fc-button-primary {
            background-color: #ffffff;
            border: 1px solid #cbd5e1;
            color: #475569;
            font-weight: 600;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            text-transform: capitalize;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            transition: all 0.2s;
        }
        .fc .fc-button-primary:hover {
            background-color: #f1f5f9;
            color: #0f172a;
            border-color: #94a3b8;
        }
        .fc .fc-button-primary:focus {
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
        }
        .fc .fc-button-primary:not(:disabled).fc-button-active, 
        .fc .fc-button-primary:not(:disabled):active {
            background-color: #6366f1; /* primary-500 */
            color: white;
            border-color: #6366f1;
        }
        /* Hide outline on focus for calendar wrapper */
        .fc-view-harness:focus, .fc-scrollgrid:focus, a.fc-daygrid-day-number:focus, a.fc-daygrid-event:focus {
            outline: none !important;
        }
    </style>

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-surface-700/50 mb-6">
        <a href="{{ route('dashboard') }}" class="hover:text-primary-600 transition-colors">Beranda</a>
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
        <span class="text-surface-900 font-medium">Kalender Kegiatan</span>
    </nav>

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-surface-900">Jadwal Peminjaman Ruangan</h1>
        <p class="text-sm text-surface-700/50 mt-1">Lihat agenda kegiatan yang disetujui, ditolak, maupun menunggu persetujuan pada kalender di bawah ini.</p>
    </div>

    <!-- Calendar Card -->
    <div class="bg-white rounded-2xl border border-surface-200/60 p-6 shadow-sm mb-10">
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

        <!-- FullCalendar Container -->
        <div id='calendar' class="min-h-[600px]"></div>
    </div>

    <!-- Event Detail Modal (Alpine.js) -->
    <div x-data="{ 
            open: false, 
            event: { title: '', start: '', end: '', purpose: '', status: '', room: '', user: '', color: '', activity_name: '' },
            showEvent(info) {
                const e = info.event;
                const startDate = e.start;
                const endDate = e.end;
                const startStr = startDate.toLocaleString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute:'2-digit' });
                
                let endStr = '-';
                if (endDate) {
                    const sameDay = startDate.getFullYear() === endDate.getFullYear() 
                                 && startDate.getMonth() === endDate.getMonth() 
                                 && startDate.getDate() === endDate.getDate();
                    if (sameDay) {
                        endStr = endDate.toLocaleString('id-ID', { hour: '2-digit', minute:'2-digit' });
                    } else {
                        endStr = endDate.toLocaleString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute:'2-digit' });
                    }
                }

                this.event = {
                    title: e.title,
                    start: startStr,
                    end: endStr,
                    purpose: e.extendedProps.purpose,
                    status: e.extendedProps.status,
                    room: e.extendedProps.room,
                    user: e.extendedProps.user,
                    activity_name: e.extendedProps.activity_name,
                    color: e.backgroundColor
                };
                this.open = true;
            }
        }"
        @open-event-modal.window="showEvent($event.detail)"
    >
        <!-- Modal Backdrop -->
        <div x-show="open" 
             x-transition.opacity 
             class="fixed inset-0 z-50 bg-surface-900/40 backdrop-blur-sm" 
             style="display: none;"></div>
        
        <!-- Modal Content -->
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0"
             style="display: none;">
            
            <div @click.outside="open = false" class="bg-white rounded-2xl shadow-xl border border-surface-200/60 w-full max-w-lg overflow-hidden">
                <div class="px-6 py-5 border-b border-surface-100 flex items-center justify-between" :style="'border-top: 4px solid ' + event.color">
                    <h3 class="text-lg font-bold text-surface-900" x-text="event.title"></h3>
                    <button @click="open = false" class="text-surface-400 hover:text-surface-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                
                <div class="p-6 space-y-4">
                    <div>
                        <p class="text-xs font-semibold text-surface-500 uppercase tracking-wider mb-1">Nama Kegiatan</p>
                        <p class="text-sm font-medium text-surface-900" x-text="event.activity_name || '-'"></p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-surface-500 uppercase tracking-wider mb-1">Ruangan</p>
                        <p class="text-sm font-medium text-surface-900" x-text="event.room"></p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-surface-500 uppercase tracking-wider mb-1">Peminjam</p>
                        <p class="text-sm font-medium text-surface-900" x-text="event.user"></p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-surface-500 uppercase tracking-wider mb-1">Waktu</p>
                        <p class="text-sm font-medium text-surface-900">
                            <span x-text="event.start"></span> s/d <span x-text="event.end"></span>
                        </p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-surface-500 uppercase tracking-wider mb-1">Tujuan</p>
                        <p class="text-sm text-surface-700 bg-surface-50 p-3 rounded-lg border border-surface-100 mt-1" x-text="event.purpose"></p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-surface-500 uppercase tracking-wider mb-1">Status</p>
                        <span class="inline-flex px-2.5 py-1 rounded-md text-xs font-bold text-white capitalize" 
                              :style="'background-color: ' + event.color"
                              x-text="event.status"></span>
                    </div>
                </div>
                
                <div class="px-6 py-4 bg-surface-50 border-t border-surface-100 flex justify-end">
                    <button @click="open = false" class="px-4 py-2 bg-white border border-surface-200 text-sm font-semibold text-surface-700 rounded-lg hover:bg-surface-100 transition-colors">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Initialize FullCalendar -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var eventsData = @json($events);

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id', // Indonesian localization
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
                    // Dispatch event to Alpine.js component to open modal
                    window.dispatchEvent(new CustomEvent('open-event-modal', { detail: info }));
                }
            });

            calendar.render();
        });
    </script>
</x-app-layout>
