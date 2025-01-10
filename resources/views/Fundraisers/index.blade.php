<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fundraisers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="flex items-center max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" bg-white rounded-lg shadow-md p-12 text-center w-full  max-w-full">
                            <div class="flex justify-center mb-4">
                            <div class="bg-gray-200 p-3 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-8 h-8 text-gray-700" viewBox="0 0 16 16">
                                <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 0 8a8 8 0 0 1 8-8zm0 4.146a1.48 1.48 0 0 0-1.481 1.482c0 .816.664 1.481 1.481 1.481.816 0 1.482-.665 1.482-1.481 0-.818-.666-1.482-1.482-1.482zm2.832 9.353a.5.5 0 0 0 .342-.636l-1.25-4.5a.5.5 0 0 0-.342-.364L8 8.41l-1.582.589a.5.5 0 0 0-.342.364l-1.25 4.5a.5.5 0 0 0 .684.578l1.482-.555c.18-.067.368-.067.548 0l1.482.555a.5.5 0 0 0 .342.636z"/>
                                </svg>
                            </div>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-800">Tebarkan Kebaikan</h2>
                            <p class="text-sm text-gray-600 mt-2">
                            Jadilah bagian dari kami untuk membantu mereka yang membutuhkan dana tambahan
                            </p>
                            <div class="mt-4">
                            {{-- {{ __("ini untuk form menambahkan permintaan jadi fundraisers!") }} --}}
                                @if ($fundraiser)
                                    <!-- Cek status is_active -->
                                    @if ($fundraiser->is_active == 0)
                                        <button class="bg-yellow-500 text-white px-4 py-2 rounded-full font-semibold shadow ">
                                            PENDING
                                        </button>

                                        <!-- Tombol Cancel -->
                                        <form action="{{ route('fundraisers.fundraisers.cancel') }}" method="POST" class="mt-4">
                                            @csrf
                                            <button class="bg-red-500 text-white px-4 py-2 rounded-full font-semibold shadow hover:bg-red-600">
                                                Batalkan!
                                            </button>
                                        </form>
                                    @elseif ($fundraiser->is_active == 1)
                                        <form action="{{ route('fundraisers.fundraisings.create') }}">
                                            <button class="bg-blue-500 text-white px-4 py-2 rounded-full font-semibold shadow hover:bg-blue-600">
                                                Buat galangan dana
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <!-- Tombol untuk mengajukan permintaan -->
                                    <form action="{{ route('fundraisers.fundraisers.store') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-full font-semibold shadow hover:bg-blue-600">
                                            Menjadi Fundraisers
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
        </div>
    </div>
</x-app-layout>
