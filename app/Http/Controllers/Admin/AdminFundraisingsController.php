<?php

namespace App\Http\Controllers\Admin;

use App\Models\Donatur;
use App\Models\Fundraising;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminFundraisingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fundraising = DB::table('fundraisings AS f')
            ->join('fundraisers AS fr', 'f.fundraiser_id', '=', 'fr.id')
            ->join('users AS u', 'fr.users_id', '=', 'u.id')
            ->join('categories AS c', 'f.category_id', '=', 'c.id')
            ->select('f.*', 'u.name AS user_name', 'c.name AS category_name')
            ->get();
        return view('Admins.fundraising.index', compact('fundraising'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $fundraising = DB::table('fundraisings AS f')
        ->join('fundraisers AS fr', 'f.fundraiser_id', '=', 'fr.id')
        ->join('users AS u', 'fr.users_id', '=', 'u.id')
        ->join('categories AS c', 'f.category_id', '=', 'c.id')
        ->select('f.*', 'u.name AS user_name', 'c.name AS category_name')
        ->where('f.id', $id)
        ->first();

        $active = $fundraising ? $fundraising->is_active : 0;
      
        $donaturs = Donatur::where('fundraising_id', $fundraising->id)->get();
        

        return view('Admins.fundraising.detail', compact('fundraising', 'donaturs', 'active'));
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
    public function update($id)
    {
        $fundraising = Fundraising::findOrFail($id);
        $fundraising->update([
                'is_active' => 1,
            ]);
            return redirect()->route('admin.fundraising.index')->with('success', 'Fundraising telah disetujui!');
        // return view('Admins.fundraising.detail');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
