<?php

namespace App\Http\Controllers\Fundraisers;

use App\Models\Donatur;
use App\Models\Category;
use App\Models\Fundraising;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class FundraisersFundraisingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $userId = Auth::id();
        $fundraisings = DB::table('fundraisings')
            ->join('fundraisers', 'fundraisings.fundraiser_id', '=', 'fundraisers.id')
            ->join('users', 'fundraisers.users_id', '=', 'users.id')
            ->join('categories', 'fundraisings.category_id', '=', 'categories.id')
            ->where('fundraisers.users_id', $userId)
            ->select('fundraisings.*',
                'users.name as user_name',
                'categories.name as category_name'
            )
            ->get();

        return view('Fundraisers.Fundraisings.index', compact('fundraisings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('Fundraisers.Fundraisings.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'thumbnail' => 'required|mimes:png,jpeg,jpg',
            'target_donasi' => 'required|numeric',
            'category' => 'required|numeric',
            'tentang' => 'required|string|min:3|max:255',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            // return redirect()->back();
        } 

        $thumbnailName = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('thumbnail'), $thumbnailName);
        }
        
        $fundraiser_id = DB::table('fundraisers')
                            ->where('users_id', Auth::id())
                            ->value('id');

        $fundraising = Fundraising::create([
            'name' => $request->name,   
            'thumbnail' => $thumbnailName,
            'target_donasi' => $request->target_donasi,
            'category_id' => $request->category,
            'fundraiser_id' => $fundraiser_id,
            'tentang' => $request->tentang,
            'is_active' => 0,
            
        ]);

        if ($fundraising) {
            return redirect()->route('fundraisers.fundraisings.index')->with('success', 'Data berhasil disimpan!');
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
        $fundraisings = DB::table('fundraisings')
            ->join('fundraisers', 'fundraisings.fundraiser_id', '=', 'fundraisers.id')
            ->join('users', 'fundraisers.users_id', '=', 'users.id')
            ->join('categories', 'fundraisings.category_id', '=', 'categories.id')
            ->where('fundraisings.slug', $slug)
            ->select(
                'fundraisings.*',
                'users.name as user_name',
                'categories.name as category_name'
            )
            ->first();
            $active = $fundraisings ? $fundraisings->is_active : 0;
            $finish = $fundraisings ? $fundraisings->has_finished : 0;

            $donaturs = Donatur::where('fundraising_id', $fundraisings->id)->get();

        return view('Fundraisers.Fundraisings.detail', compact('fundraisings', 'active', 'donaturs', 'finish'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
