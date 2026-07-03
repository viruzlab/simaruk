<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Models\Room;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display the reports dashboard.
     */
    public function index()
    {
        // For the 30-day period
        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now();

        // 1. Total Bookings (last 30 days)
        $totalBookings = Booking::whereBetween('created_at', [$startDate, $endDate])->count();
        
        // 2. Active Users (users who made a booking in last 30 days)
        $activeUsers = User::whereHas('bookings', function($q) use ($startDate, $endDate) {
            $q->whereBetween('created_at', [$startDate, $endDate]);
        })->count();
        
        // 3. Occupancy Rate (Assumption: 8 working hours/day)
        $totalRooms = Room::count();
        $totalPossibleHours = $totalRooms * 8 * 30; // 30 days * 8 hours
        
        $approvedBookings = Booking::where('status', 'approved')
            ->whereBetween('start_time', [$startDate, $endDate])
            ->get();
            
        $totalBookedHours = 0;
        $hourCounts = []; // for peak hours

        foreach ($approvedBookings as $booking) {
            $start = Carbon::parse($booking->start_time);
            $end = Carbon::parse($booking->end_time);
            $totalBookedHours += $start->diffInHours($end);
            
            // Track peak hours
            $hour = $start->format('H');
            $hourCounts[$hour] = ($hourCounts[$hour] ?? 0) + 1;
        }

        $occupancyRate = $totalPossibleHours > 0 ? min(100, round(($totalBookedHours / $totalPossibleHours) * 100)) : 0;
        
        // 4. Peak Hours
        $peakHours = 'Belum Ada Data';
        if (!empty($hourCounts)) {
            arsort($hourCounts);
            $peakHour = key($hourCounts);
            $endPeakHour = str_pad((int)$peakHour + 2, 2, '0', STR_PAD_LEFT);
            $peakHours = $peakHour . ':00 - ' . $endPeakHour . ':00';
        }
        
        // 5. Room Usage (Based on room_id)
        $bookingsWithRooms = Booking::with('room')
            ->whereBetween('start_time', [$startDate, $endDate])
            ->get();
            
        $roomUsageStats = [];
        $totalRoomUsageHours = 0;
        
        foreach ($bookingsWithRooms as $booking) {
            if ($booking->room) {
                $roomName = $booking->room->name ?? 'Ruang Tidak Diketahui';
                $hours = Carbon::parse($booking->start_time)->diffInHours($booking->end_time);
                $hours = $hours > 0 ? $hours : 1;
                
                $roomUsageStats[$roomName] = ($roomUsageStats[$roomName] ?? 0) + $hours;
                $totalRoomUsageHours += $hours;
            }
        }
        
        arsort($roomUsageStats); // Sort highest first
        
        $roomUsage = collect();
        foreach (array_slice($roomUsageStats, 0, 5) as $name => $hours) {
            $percentage = $totalRoomUsageHours > 0 ? round(($hours / $totalRoomUsageHours) * 100) : 0;
            $roomUsage->push((object) [
                'name' => $name,
                'hours' => $hours,
                'percentage' => $percentage
            ]);
        }

        // 6. Detailed log (with pagination)
        $bookingLogs = Booking::with(['room', 'user'])
            ->latest()
            ->paginate(10);

        // 7. Chart Data (Weekly for current month vs last month)
        // Group by week of the month (1-4)
        $currentMonthBookings = Booking::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->get();
            
        $lastMonthBookings = Booking::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->get();

        $currentMonthData = [0, 0, 0, 0];
        foreach ($currentMonthBookings as $booking) {
            $week = ceil(Carbon::parse($booking->created_at)->day / 7) - 1;
            if($week > 3) $week = 3;
            $currentMonthData[$week]++;
        }
        
        $lastMonthData = [0, 0, 0, 0];
        foreach ($lastMonthBookings as $booking) {
            $week = ceil(Carbon::parse($booking->created_at)->day / 7) - 1;
            if($week > 3) $week = 3;
            $lastMonthData[$week]++;
        }

        $chartData = [
            'labels' => ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
            'current_month' => $currentMonthData,
            'last_month' => $lastMonthData
        ];

        return view('reports.index', compact(
            'totalBookings', 
            'activeUsers', 
            'occupancyRate', 
            'peakHours',
            'roomUsage',
            'bookingLogs',
            'chartData'
        ));
    }
}
