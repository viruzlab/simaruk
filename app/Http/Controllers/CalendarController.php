<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        // Fetch all active bookings with their related room and user
        $bookings = Booking::with(['room', 'user'])
            ->whereIn('status', ['pending', 'approved'])
            ->get();

        $events = [];

        foreach ($bookings as $booking) {
            // Determine color based on activity type (purpose)
            $color = '#64748b'; // default slate (for others)
            $purpose = strtolower($booking->purpose);
            
            if (str_contains($purpose, 'seminar') && str_contains($purpose, 'workshop') || str_contains($purpose, 'kuliah umum')) {
                $color = '#8b5cf6'; // violet
            } elseif (str_contains($purpose, 'proposal')) {
                $color = '#3b82f6'; // blue
            } elseif (str_contains($purpose, 'tahap 1')) {
                $color = '#14b8a6'; // teal
            } elseif (str_contains($purpose, 'tahap 2')) {
                $color = '#10b981'; // emerald
            } elseif (str_contains($purpose, 'promosi')) {
                $color = '#f59e0b'; // amber
            } elseif (str_contains($purpose, 'rapat')) {
                $color = '#ec4899'; // pink
            }

            // Optional: fallback exact matching if they use the exact strings from dropdown
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
                'title' => $booking->activity_name ?: ($booking->room->name . ' - ' . $booking->user->name),
                'start' => $booking->start_time->format('Y-m-d\TH:i:s'),
                'end' => $booking->end_time->format('Y-m-d\TH:i:s'),
                'color' => $color,
                'extendedProps' => [
                    'purpose' => $booking->purpose,
                    'activity_name' => $booking->activity_name,
                    'status' => $booking->status,
                    'room' => $booking->room->name,
                    'user' => $booking->user->name,
                ]
            ];
        }

        return view('calendar.index', compact('events'));
    }
}
