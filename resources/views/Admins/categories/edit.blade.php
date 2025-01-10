<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center items-center bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('admin.categories.update', $category->slug) }}" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" value="{{ $category->name }}" name="name" id="name" placeholder="Name" class="mt-1 block w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                {{-- <div class="mb-4">
                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                    <input type="text" name="slug" id="slug" placeholder="Slug" class="mt-1 block w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div> --}}
                
                <div class="mb-4">
                    <label for="icon" class="block text-sm font-medium text-gray-700">Icon</label>
                    <input type="file" name="icon" id="icon" class="mt-1 block w-full text-gray-700">
                </div>
                <div>
                    <button 
                    type="submit" 
                    class="w-full bg-blue-700 text-gray-100 py-2 px-4 rounded-full border border-transparent hover:bg-blue-600 hover:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Simpan Perubahan 
                </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
