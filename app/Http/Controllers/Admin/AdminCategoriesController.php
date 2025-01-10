<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return view('Admins.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admins.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'name' => 'required',
            'icon' => 'required|mimes:png,jpeg,jpg',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            // return redirect()->back();
        } 

        $iconName = null;
        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $iconName = time() . '.' . $icon->getClientOriginalExtension();
            $icon->move(public_path('icons'), $iconName);
        }

        $categories = Category::create([
            'name' => $request->name,   
            'icon' => $iconName,
            
        ]);

        if ($categories) {
            return redirect()->route('admin.categories.index')->with('success', 'Data berhasil disimpan!');
        } else {
            Alert::error('Gagal!', 'Produk gagal ditambahkan!');
            return redirect()->back();
        }

        

    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $categories = Category::all()->findOrFail($slug);
        return view('Admins.categories.detail', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('Admins.categories.edit', compact('category'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'icon' => 'nullable|mimes:png,jpeg,jpg', // Ikon opsional
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back();
        }

        $iconName = $category->icon; // Gunakan ikon lama sebagai default
        if ($request->hasFile('icon')) {
            // Hapus file lama jika ada
            if ($category->icon && file_exists(public_path('icons/' . $category->icon))) {
                unlink(public_path('icons/' . $category->icon));
            }

            // Upload file baru
            $icon = $request->file('icon');
            $iconName = time() . '.' . $icon->getClientOriginalExtension();
            $icon->move(public_path('icons'), $iconName);
        }

        // Update data kategori
        $updated = $category->update([
            'name' => $request->name,
            'icon' => $iconName,
        ]);

        if ($updated) {
            Alert::success('Berhasil!', 'Kategori berhasil diperbarui!');
            return redirect()->route('admin.categories.index');
        } else {
            Alert::error('Gagal!', 'Kategori gagal diperbarui!');
            return redirect()->back();
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $category = Category::findOrFail($id);
        $oldPath = public_path('icons/' . $category->icon);
        
        if (File::exists($oldPath)) {
            File::delete($oldPath);
        }
        
        $category->delete();

        if ($category) {
            return redirect()->route('admin.categories.index')->with('success', 'Data berhasil dihapus!');
        } else {
            Alert::error('Gagal!', 'Kategori gagal dihapus!');
            return redirect()->back();
        }
    }

}
