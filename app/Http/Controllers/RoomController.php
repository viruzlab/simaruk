<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'floor' => 'nullable|string|max:50',
            'capacity' => 'required|integer|min:1',
            'facilities' => 'nullable|string',
            'photos' => 'nullable|array|max:3',
            'photos.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:available,unavailable,maintenance',
        ]);

        $photosArray = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                $photosArray[] = $file->store('rooms', 'public');
            }
        }
        $validated['photos'] = $photosArray;

        Room::create($validated);
        return redirect()->route('rooms.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'floor' => 'nullable|string|max:50',
            'capacity' => 'required|integer|min:1',
            'facilities' => 'nullable|string',
            'photos' => 'nullable|array|max:3',
            'photos.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:available,unavailable,maintenance',
        ]);

        $photosArray = $room->photos ?? [];

        // Hapus foto yang diminta untuk dihapus (remove_photos)
        if ($request->has('remove_photos')) {
            foreach ($request->remove_photos as $removePhoto) {
                if (($key = array_search($removePhoto, $photosArray)) !== false) {
                    Storage::disk('public')->delete($removePhoto);
                    unset($photosArray[$key]);
                }
            }
            $photosArray = array_values($photosArray); // reindex
        }

        // Tambahkan foto baru jika ada
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                if (count($photosArray) < 3) {
                    $photosArray[] = $file->store('rooms', 'public');
                }
            }
        }

        $validated['photos'] = $photosArray;

        $room->update($validated);
        return redirect()->route('rooms.index')->with('success', 'Ruangan berhasil diperbarui.');
    }

    public function destroy(Room $room)
    {
        if ($room->photos) {
            foreach ($room->photos as $photo) {
                Storage::disk('public')->delete($photo);
            }
        }
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Ruangan berhasil dihapus.');
    }
}
