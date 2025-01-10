<?php

namespace App\Http\Controllers\Fundraisers;

use App\Models\Fundraisers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FundraisersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fundraiser = Fundraisers::where('users_id', Auth::id())->first();
        return view('fundraisers.index', compact('fundraiser'));
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
         // Simpan data ke tabel fundraisers
        Fundraisers::create([
            'users_id'  => Auth::id(), // Ambil ID user yang sedang login
            'is_active' => 0, // Set is_active menjadi 0
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Permintaan fundraiser berhasil diajukan!');
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
    public function cancel()
    {
            // Cari fundraiser berdasarkan user yang login
        $fundraiser = Fundraisers::where('users_id', Auth::id())->first();

        if ($fundraiser) {
            // Hapus data fundraiser
            $fundraiser->delete();

            return redirect()->back()->with('success', 'Permintaan fundraiser berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Permintaan fundraiser tidak ditemukan.');
    }
}
