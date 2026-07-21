@props([
    'name' => '',
    'value' => '',
    'placeholder' => 'Pilih Tanggal & Waktu',
    'id' => null,
    'required' => false,
])

@php
    $uid = $id ?? 'dtp_' . str_replace(['-', '.'], '_', uniqid('', true));
@endphp

<div
    x-data="datetimePicker_{{ $uid }}('{{ $value }}')"
    x-init="init()"
    @click.outside="cancelPicker()"
    class="relative w-full"
    id="{{ $uid }}_wrapper"
>
    {{-- Hidden input for form submission --}}
    <input type="hidden" name="{{ $name }}" :value="selectedDateTime" x-ref="hiddenInput">

    {{-- Trigger Input --}}
    <div @click="openPicker()" class="group cursor-pointer">
        <div class="flex items-center w-full rounded-xl border border-surface-200 bg-surface-50 shadow-sm
                    hover:border-primary-400 hover:shadow-md
                    focus-within:border-primary-500 focus-within:ring-2 focus-within:ring-primary-500/20
                    transition-all duration-200 py-2.5 px-4">
            <div class="flex-1 min-w-0">
                <span x-show="displayText" x-text="displayText" class="text-sm font-medium text-surface-900 truncate block"></span>
                <span x-show="!displayText" class="text-sm font-medium text-surface-400 block">{{ $placeholder }}</span>
            </div>
            <div class="flex items-center gap-2 ml-2 flex-shrink-0">
                <button type="button" x-show="displayText" @click.stop="clearValue()" class="p-0.5 text-surface-400 hover:text-red-500 transition-colors rounded-full hover:bg-red-50">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
                <svg class="w-5 h-5 text-surface-400 group-hover:text-primary-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- Picker Popup --}}
    <div x-show="isOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95 -translate-y-1" x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
         class="absolute z-50 mt-2 bg-white rounded-2xl shadow-2xl border border-surface-200/60 overflow-hidden" style="display:none; width: 320px;"
         :class="popupPosition === 'top' ? 'bottom-full mb-2' : ''"
         @click.stop>

        {{-- ===== HEADER ===== --}}
        <div class="bg-primary-600 text-white px-6 py-4">
            {{-- Date mode header --}}
            <div x-show="mode === 'date'">
                <p class="text-xs font-bold uppercase tracking-widest text-primary-200 mb-1">PILIH TANGGAL</p>
                <p class="text-xl font-bold" x-text="headerDateText"></p>
            </div>
            {{-- Time mode header --}}
            <div x-show="mode === 'time'" class="flex items-center gap-1">
                <span class="text-4xl font-bold cursor-pointer px-1 py-0.5 rounded-lg transition-colors"
                      :class="clockMode === 'hour' ? 'bg-white/20' : 'text-primary-200 hover:bg-white/10'"
                      @click="clockMode = 'hour'" x-text="String(tempHour).padStart(2, '0')"></span>
                <span class="text-4xl font-bold text-primary-200">:</span>
                <span class="text-4xl font-bold cursor-pointer px-1 py-0.5 rounded-lg transition-colors"
                      :class="clockMode === 'minute' ? 'bg-white/20' : 'text-primary-200 hover:bg-white/10'"
                      @click="clockMode = 'minute'" x-text="String(tempMinute).padStart(2, '0')"></span>
            </div>
            {{-- Mode toggle --}}
            <div class="flex items-center gap-3 mt-3">
                <button type="button" @click="mode = 'date'" class="p-1.5 rounded-lg transition-colors"
                        :class="mode === 'date' ? 'bg-white/20 text-white' : 'text-primary-200 hover:bg-white/10'">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </button>
                <button type="button" @click="mode = 'time'" class="p-1.5 rounded-lg transition-colors"
                        :class="mode === 'time' ? 'bg-white/20 text-white' : 'text-primary-200 hover:bg-white/10'">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </button>
            </div>
        </div>

        {{-- ===== CALENDAR VIEW ===== --}}
        <div x-show="mode === 'date'" class="p-4">
            {{-- Month / Year Navigation --}}
            <div class="flex items-center justify-between mb-4">
                <button type="button" @click="prevMonth()" class="p-1.5 rounded-lg text-surface-600 hover:bg-surface-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button type="button" @click="showYearSelector = !showYearSelector" class="text-sm font-bold text-surface-800 hover:text-primary-600 transition-colors flex items-center gap-1">
                    <span x-text="monthNames[viewMonth] + ' ' + viewYear"></span>
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <button type="button" @click="nextMonth()" class="p-1.5 rounded-lg text-surface-600 hover:bg-surface-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>

            {{-- Year Selector --}}
            <div x-show="showYearSelector" x-transition class="mb-4 max-h-48 overflow-y-auto rounded-xl border border-surface-200 bg-surface-50 p-2 grid grid-cols-4 gap-1">
                <template x-for="y in yearRange" :key="y">
                    <button type="button" @click="viewYear = y; showYearSelector = false; buildCalendar()"
                            class="px-2 py-1.5 text-xs font-semibold rounded-lg transition-colors"
                            :class="y === viewYear ? 'bg-primary-600 text-white' : 'text-surface-700 hover:bg-primary-50 hover:text-primary-700'">
                        <span x-text="y"></span>
                    </button>
                </template>
            </div>

            {{-- Day Headers --}}
            <div x-show="!showYearSelector" class="grid grid-cols-7 gap-0 mb-2">
                <template x-for="d in dayLabels" :key="d">
                    <div class="text-center text-[11px] font-bold text-surface-400 uppercase py-1" x-text="d"></div>
                </template>
            </div>

            {{-- Calendar Days --}}
            <div x-show="!showYearSelector" class="grid grid-cols-7 gap-0">
                <template x-for="(day, index) in calendarDays" :key="index">
                    <button type="button"
                            @click="day.date && selectDate(day)"
                            class="relative w-10 h-10 mx-auto flex items-center justify-center text-sm rounded-full transition-all duration-150"
                            :class="{
                                'cursor-default': !day.date,
                                'text-surface-300 cursor-default': day.date && !day.currentMonth,
                                'text-surface-700 hover:bg-primary-50 hover:text-primary-700 cursor-pointer font-medium': day.date && day.currentMonth && !day.isSelected && !day.isToday,
                                'text-primary-600 font-bold ring-1 ring-primary-300': day.isToday && !day.isSelected,
                                'bg-primary-600 text-white font-bold shadow-md shadow-primary-600/30': day.isSelected,
                            }"
                            :disabled="!day.date || !day.currentMonth">
                        <span x-text="day.date ? day.date.getDate() : ''"></span>
                    </button>
                </template>
            </div>
        </div>

        {{-- ===== CLOCK DIAL VIEW ===== --}}
        <div x-show="mode === 'time'" class="p-6 flex flex-col items-center">
            {{-- Clock Face --}}
            <div class="relative w-56 h-56 rounded-full bg-surface-100 border border-surface-200/60 mb-2"
                 x-ref="clockFace"
                 @mousedown.prevent="startClockDrag($event)"
                 @mousemove.prevent="onClockDrag($event)"
                 @mouseup.prevent="endClockDrag($event)"
                 @mouseleave.prevent="endClockDrag($event)"
                 @touchstart.prevent="startClockDrag($event)"
                 @touchmove.prevent="onClockDrag($event)"
                 @touchend.prevent="endClockDrag($event)">

                {{-- Center dot --}}
                <div class="absolute top-1/2 left-1/2 w-2 h-2 -mt-1 -ml-1 bg-primary-600 rounded-full z-10"></div>

                {{-- Clock hand --}}
                <div class="absolute z-[5]"
                     style="left: 50%; top: 50%;"
                     :style="'width: 2px; margin-left: -1px; height: ' + (clockMode === 'hour' ? '70px' : '80px') + '; transform-origin: top center; transform: rotate(' + handAngle + 'deg);'">
                    <div class="w-full h-full bg-primary-600 rounded-full"></div>
                    <div class="absolute -bottom-3 left-1/2 -ml-3 w-6 h-6 bg-primary-600 rounded-full"></div>
                </div>

                {{-- Hour numbers (outer ring 1-12) --}}
                <template x-if="clockMode === 'hour'">
                    <div>
                        <template x-for="h in 12" :key="'ho'+h">
                            <button type="button"
                                    @click="selectHour(h === 12 ? 0 : h)"
                                    class="absolute w-8 h-8 flex items-center justify-center text-xs font-bold rounded-full transition-colors z-10"
                                    :class="tempHour === (h === 12 ? 0 : h) ? 'bg-primary-600 text-white' : 'text-surface-800 hover:bg-primary-100'"
                                    :style="getClockNumberStyle(h, 12, 90)">
                                <span x-text="h"></span>
                            </button>
                        </template>
                        {{-- Inner ring 13-00 (24h) --}}
                        <template x-for="h in 12" :key="'hi'+h">
                            <button type="button"
                                    @click="selectHour(h === 12 ? 12 : h + 12)"
                                    class="absolute w-7 h-7 flex items-center justify-center text-[11px] font-semibold rounded-full transition-colors z-10"
                                    :class="tempHour === (h === 12 ? 12 : h + 12) ? 'bg-primary-600 text-white' : 'text-surface-500 hover:bg-primary-100'"
                                    :style="getClockNumberStyle(h, 12, 58)">
                                <span x-text="h === 12 ? '00' : h + 12"></span>
                            </button>
                        </template>
                    </div>
                </template>

                {{-- Minute numbers --}}
                <template x-if="clockMode === 'minute'">
                    <div>
                        <template x-for="m in 12" :key="'m'+m">
                            <button type="button"
                                    @click="selectMinute((m % 12) * 5)"
                                    class="absolute w-8 h-8 flex items-center justify-center text-xs font-bold rounded-full transition-colors z-10"
                                    :class="tempMinute === ((m % 12) * 5) ? 'bg-primary-600 text-white' : 'text-surface-800 hover:bg-primary-100'"
                                    :style="getClockNumberStyle(m, 12, 90)">
                                <span x-text="String((m % 12) * 5).padStart(2, '0')"></span>
                            </button>
                        </template>
                    </div>
                </template>
            </div>
        </div>

        {{-- ===== FOOTER BUTTONS ===== --}}
        <div class="flex items-center justify-between px-4 py-3 border-t border-surface-100 bg-surface-50/50">
            <button type="button" @click="clearPicker()" class="px-4 py-2 text-xs font-bold text-surface-500 hover:text-surface-700 uppercase tracking-wider transition-colors">
                CLEAR
            </button>
            <div class="flex items-center gap-2">
                <button type="button" @click="cancelPicker()" class="px-4 py-2 text-xs font-bold text-surface-500 hover:text-surface-700 uppercase tracking-wider transition-colors">
                    CANCEL
                </button>
                <button type="button" @click="confirmPicker()" class="px-4 py-2 text-xs font-bold text-primary-600 hover:text-primary-800 uppercase tracking-wider transition-colors">
                    OK
                </button>
            </div>
        </div>
    </div>
</div>

@once
@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    // We register a factory so each instance is unique
});
</script>
@endpush
@endonce

<script>
function datetimePicker_{{ $uid }}(initialValue) {
    return {
        isOpen: false,
        mode: 'date',
        clockMode: 'hour',
        isDragging: false,
        showYearSelector: false,
        popupPosition: 'bottom',

        // Current viewed month/year in calendar
        viewMonth: new Date().getMonth(),
        viewYear: new Date().getFullYear(),

        // Temp selections (committed on OK)
        tempDate: null,
        tempHour: 8,
        tempMinute: 0,

        // Confirmed values
        selectedDateTime: initialValue || '',
        displayText: '',

        // Calendar grid data
        calendarDays: [],

        dayLabels: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
        monthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        shortDays: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],

        get headerDateText() {
            if (!this.tempDate) {
                const now = new Date();
                return this.formatHeaderDate(now);
            }
            return this.formatHeaderDate(this.tempDate);
        },

        get handAngle() {
            if (this.clockMode === 'hour') {
                return (this.tempHour % 12) * 30;
            }
            return this.tempMinute * 6;
        },

        get yearRange() {
            const currentYear = new Date().getFullYear();
            const years = [];
            for (let y = currentYear - 5; y <= currentYear + 10; y++) {
                years.push(y);
            }
            return years;
        },

        init() {
            if (initialValue) {
                this.parseInitialValue(initialValue);
            } else {
                this.tempDate = null;
                this.tempHour = 8;
                this.tempMinute = 0;
            }
            this.buildCalendar();
        },

        parseInitialValue(val) {
            if (!val) return;
            try {
                // Handle "2026-07-21T10:00" format
                const d = new Date(val);
                if (!isNaN(d.getTime())) {
                    this.tempDate = new Date(d.getFullYear(), d.getMonth(), d.getDate());
                    this.tempHour = d.getHours();
                    this.tempMinute = d.getMinutes();
                    this.viewMonth = d.getMonth();
                    this.viewYear = d.getFullYear();
                    this.updateDisplay();
                }
            } catch(e) {}
        },

        openPicker() {
            // Check if popup should go up or down
            const wrapper = document.getElementById('{{ $uid }}_wrapper');
            if (wrapper) {
                const rect = wrapper.getBoundingClientRect();
                const spaceBelow = window.innerHeight - rect.bottom;
                this.popupPosition = spaceBelow < 480 ? 'top' : 'bottom';
            }

            // If we have a selected value, parse it back to temp
            if (this.selectedDateTime) {
                this.parseInitialValue(this.selectedDateTime);
            }
            this.isOpen = true;
            this.mode = 'date';
            this.showYearSelector = false;
            this.buildCalendar();
        },

        cancelPicker() {
            this.isOpen = false;
        },

        clearPicker() {
            this.tempDate = null;
            this.tempHour = 8;
            this.tempMinute = 0;
            this.selectedDateTime = '';
            this.displayText = '';
            this.isOpen = false;
            this.dispatchChange();
        },

        clearValue() {
            this.clearPicker();
        },

        confirmPicker() {
            if (!this.tempDate) {
                // If no date selected, use today
                const now = new Date();
                this.tempDate = new Date(now.getFullYear(), now.getMonth(), now.getDate());
            }
            this.updateDisplay();
            this.isOpen = false;
            this.dispatchChange();
        },

        updateDisplay() {
            if (!this.tempDate) {
                this.displayText = '';
                this.selectedDateTime = '';
                return;
            }
            const d = this.tempDate;
            const year = d.getFullYear();
            const month = String(d.getMonth() + 1).padStart(2, '0');
            const day = String(d.getDate()).padStart(2, '0');
            const hour = String(this.tempHour).padStart(2, '0');
            const minute = String(this.tempMinute).padStart(2, '0');

            // For form submission (datetime-local format)
            this.selectedDateTime = `${year}-${month}-${day}T${hour}:${minute}`;

            // For display
            const dayName = this.shortDays[d.getDay()];
            const monthName = this.monthNames[d.getMonth()];
            this.displayText = `${dayName}, ${d.getDate()} ${monthName} ${year} — ${hour}:${minute}`;
        },

        dispatchChange() {
            // Dispatch input event for Alpine x-model binding
            const hiddenInput = this.$refs.hiddenInput;
            if (hiddenInput) {
                hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
                hiddenInput.dispatchEvent(new Event('change', { bubbles: true }));
            }
            // Dispatch custom event
            this.$dispatch('datetime-change', { value: this.selectedDateTime });
        },

        formatHeaderDate(d) {
            const dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const shortMonths = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            return `${dayNames[d.getDay()]}, ${d.getDate()} ${shortMonths[d.getMonth()]}`;
        },

        // ===== Calendar Methods =====
        buildCalendar() {
            const firstDay = new Date(this.viewYear, this.viewMonth, 1);
            const lastDay = new Date(this.viewYear, this.viewMonth + 1, 0);
            const startDay = firstDay.getDay(); // 0=Sun

            const days = [];
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            // Previous month days
            const prevMonthLastDay = new Date(this.viewYear, this.viewMonth, 0).getDate();
            for (let i = startDay - 1; i >= 0; i--) {
                const d = new Date(this.viewYear, this.viewMonth - 1, prevMonthLastDay - i);
                days.push({
                    date: d,
                    currentMonth: false,
                    isToday: false,
                    isSelected: this.isSameDay(d, this.tempDate)
                });
            }

            // Current month days
            for (let i = 1; i <= lastDay.getDate(); i++) {
                const d = new Date(this.viewYear, this.viewMonth, i);
                days.push({
                    date: d,
                    currentMonth: true,
                    isToday: this.isSameDay(d, today),
                    isSelected: this.isSameDay(d, this.tempDate)
                });
            }

            // Next month days to fill grid
            const remaining = 42 - days.length;
            for (let i = 1; i <= remaining; i++) {
                const d = new Date(this.viewYear, this.viewMonth + 1, i);
                days.push({
                    date: d,
                    currentMonth: false,
                    isToday: false,
                    isSelected: this.isSameDay(d, this.tempDate)
                });
            }

            this.calendarDays = days;
        },

        isSameDay(d1, d2) {
            if (!d1 || !d2) return false;
            return d1.getFullYear() === d2.getFullYear() &&
                   d1.getMonth() === d2.getMonth() &&
                   d1.getDate() === d2.getDate();
        },

        selectDate(day) {
            if (!day.date || !day.currentMonth) return;
            this.tempDate = new Date(day.date);
            this.buildCalendar();
            // Auto switch to time mode after selecting date
            setTimeout(() => { this.mode = 'time'; this.clockMode = 'hour'; }, 200);
        },

        prevMonth() {
            this.viewMonth--;
            if (this.viewMonth < 0) {
                this.viewMonth = 11;
                this.viewYear--;
            }
            this.buildCalendar();
        },

        nextMonth() {
            this.viewMonth++;
            if (this.viewMonth > 11) {
                this.viewMonth = 0;
                this.viewYear++;
            }
            this.buildCalendar();
        },

        // ===== Clock Dial Methods =====
        getClockNumberStyle(num, total, radius) {
            const angle = ((num % total) * 360 / total) - 90;
            const rad = angle * (Math.PI / 180);
            const cx = 112; // half of 224px (w-56 = 14rem = 224px)
            const cy = 112;
            const x = cx + radius * Math.cos(rad) - 16;
            const y = cy + radius * Math.sin(rad) - 16;
            return `left: ${x}px; top: ${y}px;`;
        },

        selectHour(h) {
            this.tempHour = h;
            // Auto switch to minutes
            setTimeout(() => { this.clockMode = 'minute'; }, 200);
        },

        selectMinute(m) {
            this.tempMinute = m;
        },

        startClockDrag(e) {
            this.isDragging = true;
            this.handleClockInteraction(e);
        },

        onClockDrag(e) {
            if (!this.isDragging) return;
            this.handleClockInteraction(e);
        },

        endClockDrag(e) {
            if (this.isDragging) {
                this.isDragging = false;
                if (this.clockMode === 'hour') {
                    setTimeout(() => { this.clockMode = 'minute'; }, 300);
                }
            }
        },

        handleClockInteraction(e) {
            const clock = this.$refs.clockFace;
            if (!clock) return;

            const rect = clock.getBoundingClientRect();
            const cx = rect.left + rect.width / 2;
            const cy = rect.top + rect.height / 2;

            let clientX, clientY;
            if (e.touches && e.touches.length > 0) {
                clientX = e.touches[0].clientX;
                clientY = e.touches[0].clientY;
            } else {
                clientX = e.clientX;
                clientY = e.clientY;
            }

            const dx = clientX - cx;
            const dy = clientY - cy;
            let angle = Math.atan2(dy, dx) * (180 / Math.PI) + 90;
            if (angle < 0) angle += 360;

            const distance = Math.sqrt(dx * dx + dy * dy);
            const maxR = rect.width / 2;

            if (this.clockMode === 'hour') {
                let hour = Math.round(angle / 30) % 12;
                // Inner ring (13-00) if distance is less than 60% of radius
                if (distance < maxR * 0.6) {
                    hour = hour === 0 ? 12 : hour + 12;
                } else {
                    hour = hour === 0 ? 0 : hour;
                }
                this.tempHour = hour;
            } else {
                let minute = Math.round(angle / 6) % 60;
                // Snap to nearest 5
                minute = Math.round(minute / 5) * 5;
                if (minute === 60) minute = 0;
                this.tempMinute = minute;
            }
        },
    };
}
</script>
