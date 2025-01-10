<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Fundraisings') }}
            </h2>

            <a href="{{ route('fundraisers.fundraisings.create') }}">
                <span class="inline-flex overflow-hidden rounded-full border bg-white shadow-sm">
                    <button
                        class="w-full text-xs bg-blue-700 text-gray-100 py-2 px-4 rounded-full border border-transparent hover:bg-blue-600 hover:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    >
                        Tambah Fundraising
                    </button>
                </span>
            </a>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @forelse ($fundraisings as $items )
                    <div class="flex items-center justify-between border-b py-6">
                        <!-- Info Utama -->
                        <div class="flex items-center gap-6">
                            <img src="{{ asset('thumbnail/' . ($items->thumbnail ?? '9.png')) }}" alt="User Image" class="w-24 h-24 object-cover rounded-lg">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">{{ $items->name }}</h3>
                                <p class="text-sm text-gray-500"><span class="font-medium">{{ $items->category_name }}</span></p>
                            </div>
                        </div>
                        
                        <!-- Data Statistik -->
                        <div class="flex gap-24">
                            <div class="text-center">
                                <p class="text-sm text-gray-600">Target Donasi</p>
                                <h3 class="text-lg font-semibold text-gray-800">Rp {{ $items->target_donasi }}</h3>
                            </div>
                            <div class="text-center">
                                <p class="text-sm text-gray-600">Donatur</p>
                                <h3 class="text-lg font-semibold text-gray-800">0</h3>
                            </div>
                            <div class="text-center">
                                <p class="text-sm text-gray-600">Fundraiser</p>
                                <h3 class="text-lg font-semibold text-gray-800">{{ $items->user_name }}</h3>
                            </div>
                        </div>

                        <!-- Aksi -->
                        <div class="flex gap-3">
                            <a href="{{ route('fundraisers.fundraisings.show', $items->slug) }}">
                                <button
                                    class="bg-blue-600 text-white text-xs py-2 px-8 mr-4 rounded-full hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2"
                                >
                                    Detail
                                </button>
                            </a>
                            
                            {{-- <a href="{{ route('admin.categories.edit', $items->slug) }}">
                                <button
                                    class="bg-green-500 text-white text-xs py-2 px-4 rounded-full hover:bg-green-400 focus:outline-none focus:ring-2 focus:ring-green-300 focus:ring-offset-2"
                                >
                                    Edit
                                </button>
                            </a> --}}

                            {{-- <form id="delete-form" action="{{ route('admin.categories.destroy', $items->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="bg-red-600 text-white text-xs py-2 px-4 rounded-full hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2" onclick="confirmDelete()"
                                >
                                    Hapus
                                </button>
                            </form> --}}
                        </div>
                    </div>

                    {{-- <script>
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
                    </script> --}}
                    @empty

                    <p class="font-semibold text-lg text-center py-8">Fundraising Kosong, silahkan ditambah</p>
                    
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
