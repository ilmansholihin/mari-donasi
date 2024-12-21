<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fundraisers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- {{ __("ini untuk form menambahkan permintaan jadi fundraisers!") }} --}}
                    @if ($fundraiser)
                        <!-- Cek status is_active -->
                        @if ($fundraiser->is_active == 0)
                            <div class="text-yellow-500 font-bold">
                                Permintaan Anda sedang menunggu persetujuan.
                            </div>
                            <!-- Tombol Cancel -->
                            <form action="{{ route('fundraisers.fundraisers.cancel') }}" method="POST" class="mt-4">
                                @csrf
                                <button type="submit" class="button-primary text-black px-4 py-2 rounded">
                                    Batalkan Permintaan
                                </button>
                            </form>
                        @elseif ($fundraiser->is_active == 1)
                            <div class="text-green-500 font-bold">
                                Permintaan Anda telah disetujui!
                            </div>
                        @endif
                    @else
                        <!-- Jika belum ada data fundraiser -->
                        <div class="text-gray-500">
                            Anda belum mengajukan permintaan fundraiser.
                        </div>

                        <!-- Tombol untuk mengajukan permintaan -->
                        <form action="{{ route('fundraisers.fundraisers.store') }}" method="POST">
                            @csrf
                            <button type="submit" class="button-primary text-black px-4 py-2 rounded mt-4">
                                Ajukan Permintaan Fundraiser
                            </button>
                        </form>
                    @endif
                    {{-- @if (session('success'))
                        <div class="mt-4 text-green-500">
                            {{ session('success') }}
                        </div>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
