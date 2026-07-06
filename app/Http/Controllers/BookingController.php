<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Notifications\BookingStatusNotification;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $bookings = Booking::with(['user', 'room'])->latest()->get();
            $totalPending = Booking::where('status', 'pending')->count();
            $totalApproved = Booking::where('status', 'approved')->count();
            $totalRejected = Booking::where('status', 'rejected')->count();
        } else {
            $bookings = Booking::with('room')->where('user_id', auth()->id())->latest()->get();
            $totalPending = Booking::where('user_id', auth()->id())->where('status', 'pending')->count();
            $totalApproved = Booking::where('user_id', auth()->id())->where('status', 'approved')->count();
            $totalRejected = Booking::where('user_id', auth()->id())->where('status', 'rejected')->count();
        }

        return view('bookings.index', compact('bookings', 'totalPending', 'totalApproved', 'totalRejected'));
    }

    public function create(Request $request)
    {
        $room_id = $request->get('room_id');
        $rooms = Room::where('status', 'available')->get();
        return view('bookings.create', compact('rooms', 'room_id'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'start_time' => 'required|date|after_or_equal:today',
            'end_time' => 'required|date|after:start_time',
            'purpose' => 'required|string',
            'activity_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'participants_count' => 'required|integer|min:1',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending';

        // Check for schedule overlap
        $overlap = Booking::with('user')->where('room_id', $validated['room_id'])
            ->whereIn('status', ['pending', 'approved'])
            ->where(function ($query) use ($validated) {
                $query->where('start_time', '<', $validated['end_time'])
                      ->where('end_time', '>', $validated['start_time']);
            })
            ->first();

        if ($overlap) {
            $booker = $overlap->user ? $overlap->user->name : 'Seseorang';
            $activityName = $overlap->activity_name ?: $overlap->purpose;
            $timeStart = \Carbon\Carbon::parse($overlap->start_time)->format('H:i');
            $timeEnd = \Carbon\Carbon::parse($overlap->end_time)->format('H:i');
            
            return back()->withInput()->withErrors([
                'start_time' => "Ruangan ini sudah dibooking oleh {$booker} untuk kegiatan '{$activityName}' (pukul {$timeStart} - {$timeEnd}). Silakan pilih waktu atau ruangan lain."
            ]);
        }

        $booking = Booking::create($validated);

        // Notify admins
        $admins = \App\Models\User::where('role', 'admin')->get();
        \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\BookingStatusNotification(
            $booking, 
            'Pengajuan baru dari ' . auth()->user()->name . " untuk kegiatan '" . $booking->activity_name . "' menunggu persetujuan."
        ));

        return redirect()->route('bookings.index')->with('success', 'Pengajuan peminjaman berhasil dibuat, menunggu persetujuan.');
    }

    public function show(Booking $booking)
    {
        if (auth()->user()->role !== 'admin' && $booking->user_id !== auth()->id()) {
            abort(403);
        }
        return view('bookings.show', compact('booking'));
    }

    public function approve(Request $request, Booking $booking)
    {
        $booking->update([
            'status' => 'approved',
            'admin_notes' => $request->admin_notes
        ]);

        $booking->user->notify(new BookingStatusNotification($booking, 'Peminjaman ruangan Anda telah disetujui.'));

        return redirect()->back()->with('success', 'Peminjaman disetujui.');
    }

    public function reject(Request $request, Booking $booking)
    {
        $booking->update([
            'status' => 'rejected',
            'admin_notes' => $request->admin_notes
        ]);

        $booking->user->notify(new BookingStatusNotification($booking, 'Peminjaman ruangan Anda ditolak.'));

        return redirect()->back()->with('success', 'Peminjaman ditolak.');
    }

    public function destroy(Booking $booking)
    {
        if (auth()->user()->role !== 'admin' && $booking->user_id !== auth()->id()) {
            abort(403);
        }
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Peminjaman dibatalkan.');
    }
}
