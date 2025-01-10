<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Fundraisers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- {{ __("wkwkwk") }} --}}
                    @foreach ($fundraisers as $fundraisers )
                        
                   
                    <div class="flex items-center justify-between border-b py-4">
                    <!-- User Info -->
                    <div class="flex items-center">
                        <img src="https://via.placeholder.com/50" alt="User Image" class="w-12 h-12 rounded-full object-cover mr-4">
                        <div>
                        <h3 class="font-semibold text-gray-800">{{ $fundraisers->user_name }}</h3>
                        <p class="text-sm text-gray-500">Date <span class="font-medium">2024-04-17 00:56:14</span></p>
                        </div>
                    </div>
                    <!-- Status and Actions -->
                    <div class="flex items-center space-x-3">
                        @if ($fundraisers->is_active == 1)
                        <span class="text-xs font-medium text-white bg-green-500 px-2 py-1 rounded">Active</span>
                        @else
                        <span class="text-xs font-medium text-white bg-orange-500 px-2 py-1 rounded">PENDING</span>
                        @endif

                        @if ($fundraisers->is_active == 1)
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
                        @endif
                        
                    </div>
                    </div>
                     @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
