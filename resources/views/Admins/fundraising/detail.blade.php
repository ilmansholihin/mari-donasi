<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Details Fundraisings') }}
            </h2>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> --}}
                {{-- conatiner section --}}
                <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
                    <!-- Status -->
                    <div class="mb-4">
                        
                        @if ( $active == 1 )
                             {{-- disini buat pengkondisian jika fundraising is_active = 0 maka.. --}}
                        <div class="bg-green-500 text-white text-center font-semibold py-2  rounded mx-auto">
                            Fundraising telah aktif dan dapat menerima donasi
                        </div>
                        @else
                        <div class="flex">
                            <div class="bg-red-500 text-white text-center font-semibold py-2 m-2 w-[80%] left-0 rounded mx-auto">
                            Fundraising belum aktif tunggu verivikasi superadmin
                            </div>
                            <form action="{{ route('admin.fundraising.update', $fundraising->id) }}" method="POST">
                                @csrf
                                @method('PUT') <!-- Pastikan metode PUT digunakan untuk update -->
                                <button class="bg-blue-500 text-white text-center font-semibold w-[100%] m-2 py-2 px-4 rounded mx-auto">
                                    Setujui
                                </button>
                            </form>

                        </div>
                        
                        @endif
                       
                        
                        
                    </div> 

                    <!-- Campaign Information -->
                    <div class="flex items-center mb-4">
                    <!-- Image -->
                    <div class="w-48 h-48 rounded overflow-hidden">
                        <img src="{{ asset('thumbnail/' . ($fundraising->thumbnail ?? 'default.png')) }}" alt="Campaign Image" class="object-cover w-full h-full">
                    </div>
                    <!-- Details -->
                    <div class="ml-4 flex-grow">
                        <h2 class="text-lg font-semibold">{{ $fundraising->user_name }}</h2>
                        <p class="text-sm text-gray-500">{{ $fundraising->category_name }}</p>
                    </div>
                    <!-- Actions -->
                    <div class="space-x-2">
                        {{-- @if ( $active == 1 )
                            <div></div>
                        @else
                            <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-4 rounded">Edit</button>
                            <button class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-4 rounded">Delete</button>
                        @endif --}}
                        
                    </div>
                    </div>

                    <!-- Progress -->
                    <div class="mb-4">
                    <div class="flex justify-between text-sm font-semibold mb-1">
                        <span id="funded">Rp {{ $fundraising->donasi_terkumpul }} Funded</span>
                        <span id="goal">Rp {{ $fundraising->target_donasi }} Goal</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-4">
                        <!-- Width diatur secara dinamis dengan style -->
                        <div id="progress-bar" class="bg-blue-500 h-4 rounded-full " style="width: 2%;"></div>
                    </div>
                    </div>
                    <script>
                        // Total dana dan target
                        const fundedAmount = {{ $fundraising->donasi_terkumpul }}; // Rp 1.000.000
                        const goalAmount = {{ $fundraising->target_donasi }}; // Rp 50.000.000

                        // Hitung persentase
                        const percentage = Math.min((fundedAmount / goalAmount) * 100, 100); // Maksimum 100%

                        // Update progress bar
                        const progressBar = document.getElementById("progress-bar");
                        progressBar.style.width = `${percentage}%`;
                    </script>


                    <!-- Donor List -->
                    <div>
                    <h3 class="text-lg font-semibold mb-2">Donaturs</h3>
                    @forelse ($donaturs as $donaturs )
                    <div class="flex justify-between mb-2 mx-4 border-b-2 items-end">
                        <div class="mb-2">
                            <h3 class="text-lg text-gray-800 font-semibold mb-2">Rp {{ $donaturs->total_donasi }} </h3>
                            <p class="text-gray-500">{{ $donaturs->name }}</p>
                        </div>
                        <p class="text-sm text-gray-300">{{ $donaturs->notes }}</p>
                    </div>
                        {{-- <p class="text-gray-500 text-sm">{{ $donaturs->name }}</p> --}}
                    @empty
                        <p class="text-gray-500 text-sm">belum ada yang memberikan donasi.</p>
                    @endforelse
                    
                    </div>
                </div>
                {{-- container end section --}}
            {{-- </div> --}}
        </div>
    </div>
</x-app-layout>
