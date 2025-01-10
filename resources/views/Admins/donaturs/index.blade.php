<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Donaturs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- {{ __("wkwkwk") }} --}}
                    @forelse ($donaturs as $donaturs )
                        
                   
                    <div class="flex items-center justify-between border-b py-4">
                    <!-- User Info -->
                    <div class="flex items-center">
                        <img src="{{ asset('galangDanaImages/' . ($donaturs->user_avatar ?? '9.png')) }}" alt="User Image" class="w-24 h-24  object-cover mr-4">
                        <div>
                            <h3 class="font-semibold text-gray-800">{{ $donaturs->name }}</h3>
                            <p class="text-sm text-gray-500">Date <span class="font-medium">{{ $donaturs->created_at }}</span></p>
                        </div>
                    </div>

                    <div class="items-center">
                        <p>No Whatsapp</p>
                     <span>{{ $donaturs->nomer_hp }}</span>
                    </div>
                    <!-- Status and Actions -->
                    <div class="flex items-center space-x-3">
                        {{-- @if ($donaturs->is_active == 1)
                        <span class="text-xs font-medium text-white bg-green-500 px-2 py-1 rounded">Active</span>
                        @else
                        <span class="text-xs font-medium text-white bg-orange-500 px-2 py-1 rounded">PENDING</span>
                        @endif --}}

                        {{-- @if ($donaturs->is_active == 1)
                        <form action="{{ route('admin.fundraisers.destroy', $fundraisers->fundraiser_id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="bg-red-700 text-white px-4 py-1 rounded hover:bg-red-600">Hapus</button>
                        </form>
                        @else
                        <form action="{{ route('admin.fundraisers.update', $fundraisers->fundraiser_id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="bg-blue-700 text-white px-4 py-1 rounded hover:bg-blue-600">Setujui</button>
                        </form>
                        @endif --}}
                        <button class="bg-blue-700 text-white px-8 py-2 rounded-xl hover:bg-blue-600">Details</button>
                        
                    </div>
                    </div>
                    @empty
                    <p class="font-semibold text-l leading-tight text-gray-500 py-8 text-center">Belum ada donaturs</p>

                     @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
