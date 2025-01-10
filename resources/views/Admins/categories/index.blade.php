<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kategori') }}
            </h2>

            <a href="{{ route('admin.categories.create') }}">
                <span class="inline-flex overflow-hidden rounded-full border bg-white shadow-sm">
                    <button
                        class="iw-full text-xs bg-blue-700 text-gray-100 py-2 px-4 rounded-full border border-transparent hover:bg-blue-600 hover:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    >
                        Tambah Kategori
                    </button>
                </span>
            </a>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- {{ __("wkwkwk") }} --}}
                    @forelse ($categories as $items )
                        
                   
                    <div class="flex items-center justify-between border-b py-4">
                        <!-- User Info -->
                        <div class="flex items-center">
                            <img src="{{ asset('icons/' . ($items->icon ?? '9.png')) }}" alt="User Image" class="w-24 h-24 object-cover mr-4">
                            <div>
                                <h3 class="font-semibold text-gray-800">{{ $items->name }}</h3>
                                <p class="text-sm text-gray-500">Dibuat <span class="font-medium">{{ $items->created_at }}</span></p>
                            </div>
                        </div>
                        <div class="flex flex-row">
                            <a href="{{ route('admin.categories.show', $items->id) }} " class="px-2">
                                <button
                                    class="w-full bg-blue-700 text-xs text-gray-100 py-2 px-4 rounded-full border border-transparent hover:bg-blue-600 hover:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                >
                                    Detail
                                </button>
                            </a>
                      
                            <a href="{{ route('admin.categories.edit', $items->slug) }}" class="px-2">
                                <button
                                    class="w-full bg-green-600 text-xs text-gray-100 py-2 px-4 rounded-full border border-transparent hover:bg-green-500 hover:border-green-200 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2"
                                >
                                    Edit
                                </button>
                            </a>

                        <form id="delete-form" action="{{ route('admin.categories.destroy', $items->id) }}" method="POST" class="px-2">
                            @csrf
                            @method('DELETE')
                             <button type="button"
                                class="w-full bg-red-700 text-xs text-gray-100 py-2 px-4 rounded-full border border-transparent hover:bg-red-600 hover:border-red-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" onclick="confirmDelete()"
                            >
                                Hapus
                            </button>
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
                        
                        </div>
                        <!-- Button Detail Kategori -->
                        
                    </div>


                    @empty

                    <p class="font-semibold text-gray-800 text-l leading-tight py-8 text-center">Kategori Kosong, silahkan ditambah</p>
                    
                     @endforelse
                </div>
            </div>
        </div>
    </div>
   
</x-app-layout>
