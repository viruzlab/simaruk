<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('rooms.index') }}" class="text-gray-500 hover:text-gray-700">
                &larr; Kembali
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Ruangan: ') . $room->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex flex-col md:flex-row">
                <div class="md:w-1/2">
                    <img class="w-full h-full object-cover min-h-[300px]" 
                         src="{{ !empty($room->photos) ? asset('storage/'.$room->photos[0]) : 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80&w=1200' }}" 
                         alt="{{ $room->name }}">
                </div>
                <div class="md:w-1/2 p-8">
                    <div class="mb-4">
                        <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $room->status === 'available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($room->status) }}
                        </span>
                    </div>
                    
                    <h3 class="text-3xl font-bold text-gray-900 mb-4">{{ $room->name }}</h3>
                    
                    <div class="space-y-4 text-gray-700">
                        <p class="text-lg">
                            <strong class="font-semibold text-gray-900">Kapasitas:</strong> 
                            {{ $room->capacity }} Orang
                        </p>
                        <div>
                            <strong class="font-semibold text-gray-900 block mb-1">Fasilitas:</strong>
                            <p class="bg-gray-50 p-4 rounded-lg text-gray-600 whitespace-pre-line">{{ $room->facilities ?: 'Tidak ada deskripsi fasilitas.' }}</p>
                        </div>
                    </div>

                    <div class="mt-8 pt-8 border-t border-gray-200">
                        @if($room->status === 'available')
                            <a href="{{ route('bookings.create', ['room_id' => $room->id]) }}" class="block w-full text-center px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition duration-150 ease-in-out">
                                Ajukan Peminjaman Ruangan Ini
                            </a>
                        @else
                            <button disabled class="block w-full text-center px-6 py-3 bg-gray-400 text-white font-semibold rounded-lg shadow-md cursor-not-allowed">
                                Ruangan Sedang Tidak Tersedia
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
