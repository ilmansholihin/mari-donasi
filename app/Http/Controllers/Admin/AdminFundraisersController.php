<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fundraisers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminFundraisersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fundraisers = DB::table('fundraisers')
        ->join('users', 'fundraisers.users_id', '=', 'users.id')
        ->select(
            'fundraisers.id as fundraiser_id',
            'fundraisers.is_active',
            'fundraisers.created_at',
            'users.name as user_name',
            'users.email as user_email',
            'users.avatar as user_avatar',
            'users.whatsapp as user_whatsapp'
        )
        ->get();

    return view('Admins.fundraisers.index', compact('fundraisers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $fundraiser_id)
    {
         //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, $fundraiser_id)
    {
        // Cari fundraiser berdasarkan ID
        $fundraiser = Fundraisers::find($fundraiser_id);

        if ($fundraiser) {
            // Update is_active menjadi 1
            $fundraiser->update([
                'is_active' => 1,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Fundraiser berhasil disetujui!');
        }

        // Jika tidak ditemukan, kembalikan pesan error
        return redirect()->back()->with('error', 'Fundraiser tidak ditemukan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($fundraiser_id)
    {
        // Cari fundraiser berdasarkan ID
        $fundraiser = Fundraisers::find($fundraiser_id);

        if ($fundraiser) {
            // Hapus fundraiser
            $fundraiser->delete();

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Fundraiser berhasil dihapus!');
        }

        // Jika fundraiser tidak ditemukan
        return redirect()->back()->with('error', 'Fundraiser tidak ditemukan.');
    }
}
