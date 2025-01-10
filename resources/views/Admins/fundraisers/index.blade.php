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
                    @forelse ($fundraisers as $fundraisers )
                        
                   
                    <div class="flex items-center justify-between border-b py-4">
                    <!-- User Info -->
                    <div class="flex items-center">
                        <img src="{{ asset('avatar/' . ($fundraisers->user_avatar ?? 'default-avatar.png')) }}" alt="User Image" class="w-12 h-12 rounded-full object-cover mr-4">
                        <div>
                            <h3 class="font-semibold text-gray-800">{{ $fundraisers->user_name }}</h3>
                            <p class="text-sm text-gray-500">Date <span class="font-medium">{{ $fundraisers->created_at }}</span></p>
                        </div>
                    </div>

                    <div class="items-center">
                        <p>No Whatsapp</p>
                     <span>{{ $fundraisers->user_whatsapp }}</span>
                    </div>
                    <!-- Status and Actions -->
                    <div class="flex items-center space-x-3">
                        @if ($fundraisers->is_active == 1)
                        <span class="text-xs font-medium text-white bg-green-500 px-2 py-1 rounded">Active</span>
                        @else
                        <span class="text-xs font-medium text-white bg-orange-500 px-2 py-1 rounded">PENDING</span>
                        @endif

                        @if ($fundraisers->is_active == 1)
                        <form id="delete-form" action="{{ route('admin.fundraisers.destroy', $fundraisers->fundraiser_id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="button" onclick="confirmDelete()" class="bg-red-700 text-white px-4 py-1 rounded hover:bg-red-600">Hapus</button>
                        </form>
                        <script>
                            function confirmDelete() {
                                Swal.fire({
                                    title: 'Apakah Anda yakin?',
                                    text: "Data ini tidak dapat dikembalikan!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Ya, hapus!',
                                    cancelButtonText: 'Batal'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        document.getElementById('delete-form').submit();
                                    }
                                });
                            }
                        </script>

                        @else
                        <form action="{{ route('admin.fundraisers.update', $fundraisers->fundraiser_id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="bg-blue-700 text-white px-4 py-1 rounded hover:bg-blue-600">Setujui</button>
                        </form>
                        @endif
                        
                    </div>
                    </div>
                    @empty
                    <p class="font-semibold text-l text-gray-500 leading-tight py-8 text-center">Belum Ada fundraisers</p>

                     @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
