<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Fundraisings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- <div class="p-6 text-gray-900"> --}}
                    {{-- {{ __("wkwkwk") }} --}}
                    @forelse ($fundraising as $fundraisings )
                        
                   
                    <div class="flex items-center bg-white shadow-lg rounded-lg overflow-hidden">
                        <img src="{{ asset('thumbnail/' . ($fundraisings->thumbnail ?? 'default.png')) }}" alt="Image" class="w-24 h-24 object-cover">
                        <div class="flex-grow p-4">
                            <h3 class="text-lg font-bold">{{ $fundraisings->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $fundraisings->category_name }}</p>
                            <div class="flex justify-between items-center mt-2">
                            <p class="text-sm"><strong>Target Amount:</strong> Rp {{ $fundraisings->target_donasi }}</p>
                            <p class="text-sm"><strong>Donaturs:</strong> 0</p>
                            <p class="text-sm"><strong>Fundraiser:</strong> {{ $fundraisings->user_name }}</p>
                            </div>
                        </div>
                        <div class="p-4">
                            {{-- <form action="{{ route('admin.fundraising.show', $fundraisings->id) }}" method="POST"> --}}
                                {{-- @method('put')
                                @csrf --}}
                                <a href="{{ route('admin.fundraising.show', $fundraisings->id) }}">
                                    <button class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">
                                View Details
                                </button>
                            </a>
                                
                            {{-- </form> --}}
                        </div>
                    </div>

                    @empty
                    <p class="font-semibold text-l text-gray-500 leading-tight py-8 text-center">Belum Ada fundraising</p>

                     @endforelse
                {{-- </div> --}}
            </div>
        </div>
    </div>
</x-app-layout>
