<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CalendarController;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

Route::get('/', function () {
    $bookings = Booking::with(['room', 'user'])
        ->whereIn('status', ['pending', 'approved'])
        ->get();
    $events = [];

    foreach ($bookings as $booking) {
        $color = '#64748b'; 
        $purpose = strtolower($booking->purpose);
        
        if (str_contains($purpose, 'seminar') && str_contains($purpose, 'workshop') || str_contains($purpose, 'kuliah umum')) {
            $color = '#8b5cf6';
        } elseif (str_contains($purpose, 'proposal')) {
            $color = '#3b82f6';
        } elseif (str_contains($purpose, 'tahap 1')) {
            $color = '#14b8a6';
        } elseif (str_contains($purpose, 'tahap 2')) {
            $color = '#10b981';
        } elseif (str_contains($purpose, 'promosi')) {
            $color = '#f59e0b';
        } elseif (str_contains($purpose, 'rapat')) {
            $color = '#ec4899';
        }

        $exactMatch = [
            'Seminar/Workshop/Kuliah Umum' => '#8b5cf6',
            'Sidang Seminar Proposal Tesis/Disertasi' => '#3b82f6',
            'Sidang Ujian Tahap 1 Tesis/Disertasi' => '#14b8a6',
            'Sidang Ujian Tahap 2' => '#10b981',
            'Sidang Promosi Doktor' => '#f59e0b',
            'Rapat' => '#ec4899',
        ];

        if (array_key_exists($booking->purpose, $exactMatch)) {
            $color = $exactMatch[$booking->purpose];
        }

        $events[] = [
            'id' => $booking->id,
            'title' => $booking->activity_name ?: (($booking->room?->name ?? 'Unknown Room') . ' - ' . ($booking->user?->name ?? 'Unknown User')),
            'start' => $booking->start_time->format('Y-m-d\TH:i:s'),
            'end' => $booking->end_time->format('Y-m-d\TH:i:s'),
            'color' => $color,
            'extendedProps' => [
                'purpose' => $booking->purpose,
                'activity_name' => $booking->activity_name,
                'status' => $booking->status,
                'room' => $booking->room?->name ?? 'Unknown Room',
                'user' => $booking->user?->name ?? 'Unknown User',
            ]
        ];
    }

    return view('welcome', compact('events'));
});

Route::get('/dashboard', function () {
    $totalRooms = Room::count();
    $availableRooms = Room::where('status', 'available')->count();
    $totalBookings = Booking::count();

    if (auth()->user()->role === 'admin') {
        $pendingBookings = Booking::where('status', 'pending')->count();
        $approvedBookings = Booking::where('status', 'approved')->count();
        $rejectedBookings = Booking::where('status', 'rejected')->count();
        $recentBookings = Booking::with(['user', 'room'])->latest()->take(5)->get();
        $todaySchedule = Booking::with(['user', 'room'])
            ->where('status', 'approved')
            ->whereDate('start_time', Carbon::today())
            ->orderBy('start_time')
            ->get();
            
        // Dynamic Activities for Admin
        $activityStats = Booking::select('purpose', \Illuminate\Support\Facades\DB::raw('count(*) as count'))
            ->groupBy('purpose')
            ->orderByDesc('count')
            ->take(5)
            ->get();
            
        $colors = ['bg-primary-600', 'bg-sky-500', 'bg-accent-500', 'bg-amber-400', 'bg-emerald-500'];
        $activities = [];
        $totalPurposeCount = $activityStats->sum('count');
        foreach($activityStats as $index => $stat) {
            $pct = $totalPurposeCount > 0 ? round(($stat->count / $totalPurposeCount) * 100) : 0;
            $color = $colors[$index % count($colors)];
            $activities[] = [
                'name' => $stat->purpose,
                'color' => $color,
                'dot' => $color,
                'pct' => $pct
            ];
        }
    } else {
        $totalBookings = Booking::where('user_id', auth()->id())->count();
        $pendingBookings = Booking::where('user_id', auth()->id())->where('status', 'pending')->count();
        $approvedBookings = Booking::where('user_id', auth()->id())->where('status', 'approved')->count();
        $rejectedBookings = Booking::where('user_id', auth()->id())->where('status', 'rejected')->count();
        $recentBookings = Booking::with('room')->where('user_id', auth()->id())->latest()->take(5)->get();
        $todaySchedule = Booking::with('room')
            ->where('user_id', auth()->id())
            ->where('status', 'approved')
            ->whereDate('start_time', Carbon::today())
            ->orderBy('start_time')
            ->get();
    }

    // Weekly booking stats (Mon-Sun)
    $startOfWeek = Carbon::now()->startOfWeek();
    $weeklyStats = [];
    for ($i = 0; $i < 7; $i++) {
        $day = $startOfWeek->copy()->addDays($i);
        $weeklyStats[] = Booking::whereDate('start_time', $day)->count();
    }
    
    if (!isset($activities)) {
        $activities = [];
    }

    return view('dashboard', compact(
        'totalRooms', 'availableRooms', 'totalBookings',
        'pendingBookings', 'approvedBookings', 'rejectedBookings',
        'recentBookings', 'todaySchedule', 'weeklyStats', 'activities'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Notifications
    Route::post('/notifications/mark-read', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json(['success' => true]);
    })->name('notifications.markRead');

    // Admin Routes
    Route::middleware('admin')->group(function () {
        Route::resource('rooms', RoomController::class)->except(['index', 'show']);
        Route::patch('/bookings/{booking}/approve', [BookingController::class, 'approve'])->name('bookings.approve');
        Route::patch('/bookings/{booking}/reject', [BookingController::class, 'reject'])->name('bookings.reject');
        
        // User Management
        Route::resource('users', App\Http\Controllers\UserController::class);
        
        // Reports
        Route::get('/reports', [App\Http\Controllers\ReportController::class, 'index'])->name('reports.index');
        
        // Settings / Study Programs
        Route::resource('study-programs', App\Http\Controllers\StudyProgramController::class)->only(['store', 'destroy']);
    });

    // Public/User Routes for Rooms
    Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
    Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');
    
    // User Bookings
    Route::resource('bookings', BookingController::class)->except(['edit', 'update']);
    
    // Calendar
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
});

require __DIR__.'/auth.php';
