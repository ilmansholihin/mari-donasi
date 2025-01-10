<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Fundraisings') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center items-center bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <form action="{{ route('fundraisers.fundraisings.store') }}" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" placeholder="Name" class="mt-1 block w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div class="mb-4">
                <label for="thumbnail" class="block text-sm font-medium text-gray-700">Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail" required class="mt-1 block w-full text-gray-700">
                </div>
                
                <div class="mb-4">
                <label for="target_amount" class="block text-sm font-medium text-gray-700">Target Amount</label>
                <input type="number" name="target_donasi" id="target_amount" placeholder="Rp." class="mt-1 block w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div class="mb-4">
                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                <select id="category" name="category" class="mt-1 block w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @foreach ($categories as $categories )
                        <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                    @endforeach
                    
                    <!-- Tambahkan opsi lainnya jika diperlukan -->
                </select>
                </div>
                
                <div class="mb-4">
                <label for="about" class="block text-sm font-medium text-gray-700">About</label>
                <textarea id="about" name="tentang" rows="4" placeholder="Describe the fundraiser" class="mt-1 block w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                
                <div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Tambah fundraising baru
                </button>
                </div>
             </form>

        </div>
    </div>
</x-app-layout>




