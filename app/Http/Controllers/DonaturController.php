<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\Donatur;
use App\Models\Category;
use App\Models\Fundraising;
use Illuminate\Http\Request;
use App\Helpers\MidtransHelper;
use Illuminate\Support\Facades\DB;

class DonaturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $fundraisings = DB::table('fundraisings')
        ->leftJoin('fundraisers', 'fundraisings.fundraiser_id', '=', 'fundraisers.id')
        ->leftJoin('users', 'fundraisers.users_id', '=', 'users.id')
        ->where('fundraisings.is_active', 1)
        ->select(
            'fundraisings.id as fundraising_id',
            'fundraisings.name as fundraising_name',
            'fundraisings.slug',
            'fundraisings.target_donasi',
            'fundraisings.donasi_terkumpul',
            'fundraisings.thumbnail',
            'users.name as fundraiser_name'
        )
        ->get();

        // Ambil semua kategori
        $categories = Category::all();

        return view('Donaturs.index', compact('fundraisings', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
         $fundraising = Fundraising::findOrFail($id);
        //  $finish = $fundraising ? $fundraising->has_finished : 0;
         return view('Donaturs.create', compact('fundraising'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'nomer_hp' => 'required|string|max:15',
            'total_donasi' => 'nullable|numeric|min:1000',
            'custom_total_donasi' => 'nullable|numeric|min:1000',
            'notes' => 'nullable|string',
        ]);

        $total_donasi = $request->custom_total_donasi ?: $request->total_donasi;
        if (!$total_donasi) {
            return back()->withErrors(['total_donasi' => 'Silakan pilih atau masukkan jumlah donasi.']);
        }

        // Buat entri donatur
        $donatur = Donatur::create([
            'name' => $request->name,
            'nomer_hp' => $request->nomer_hp,
            'fundraising_id' => $id,
            'total_donasi' => $total_donasi,
            'notes' => $request->notes,
            'status' => 'pending',
            'bukti' => null,
        ]);

        // Konfigurasi transaksi untuk Midtrans
         MidtransHelper::config();
        $transactionDetails = [
            'transaction_details' => [
                'order_id' => 'DON-' . $donatur->id,
                'gross_amount' => $total_donasi,
            ],
            'customer_details' => [
                'first_name' => $donatur->name,
                'phone' => $donatur->nomer_hp,
            ],
        ];

        $snapToken =  Snap::getSnapToken($transactionDetails);

        // Arahkan ke halaman pembayaran
        return redirect()->route('donaturs.payment', ['id' => $donatur->id, 'snapToken' => $snapToken]);
    }
    public function payment($id, $snapToken)
    {
        $donatur = Donatur::findOrFail($id);
        $fundraising = Fundraising::findOrFail($donatur->fundraising_id);

        return view('donaturs.payment', compact('donatur', 'fundraising', 'snapToken'));
    }

    public function handleNotification(Request $request)
    {
        $notification = $request->all();

        if (isset($notification['transaction_status']) && $notification['transaction_status'] === 'settlement') {
            $orderId = str_replace('DON-', '', $notification['order_id']);
            $donatur = Donatur::findOrFail($orderId);

            // Perbarui status dan donasi terkumpul
            $donatur->update(['status' => 'success']);

            $fundraising = Fundraising::findOrFail($donatur->fundraising_id);
            $fundraising->update([
                'donasi_terkumpul' => $fundraising->donasi_terkumpul + $donatur->total_donasi,
            ]);
        }

        return response()->json(['message' => 'Notification received'], 200);
    }

    public function success(Request $request)
    {
        $validatedData = $request->validate([
            'donatur_id' => 'required|integer',
            'total_donasi' => 'required|numeric',
            'fundraising_id' => 'required|integer',
            'result' => 'required|array',
        ]);

        // Update tabel fundraising
        $fundraising = Fundraising::find($validatedData['fundraising_id']);
        if ($fundraising) {
            $fundraising->donasi_terkumpul += $validatedData['total_donasi'];
            $fundraising->save();
        } else {
            return response()->json([
                'message' => 'Fundraising tidak ditemukan',
            ], 404);
        }

        // Update tabel donatur
        $donatur = Donatur::find($validatedData['donatur_id']);
        if ($donatur) {
            $donatur->status = 'success';
            $donatur->save();
        } else {
            return response()->json([
                'message' => 'Donatur tidak ditemukan',
            ], 404);
        }

        return response()->json(['message' => 'Data berhasil diperbarui'], 200);
    }






    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        // $fundraising = Fundraising::findOrFail($id);
        // return view('Donaturs.detail', compact('fundraising'));
         $fundraising = DB::table('fundraisings')
            ->join('fundraisers', 'fundraisings.fundraiser_id', '=', 'fundraisers.id')
            ->join('users', 'fundraisers.users_id', '=', 'users.id')
            ->join('categories', 'fundraisings.category_id', '=', 'categories.id')
            ->where('fundraisings.slug', $slug)
            ->select(
                'fundraisings.*',
                'users.name as user_name',
                 'users.avatar as user_avatar', 
                'categories.name as category_name'
            )
            ->first();
            // $active = $fundraisings ? $fundraisings->is_active : 0;
            $finish = $fundraising->has_finished;

            $donaturs = Donatur::where('fundraising_id', $fundraising->id)
                   ->where('status', 'success')
                   ->get();
            $donatursCount = Donatur::where('fundraising_id', $fundraising->id)
                    ->where('status', 'success')        
                    ->count();


        return view('Donaturs.detail', compact('fundraising', 'donaturs', 'donatursCount', 'finish'));
    }

    public function showCategory($slug)
    {
        // $slug = $request->get('slug');
        $fundraisings = DB::table('fundraisings')
    ->join('categories', 'fundraisings.category_id', '=', 'categories.id')
    ->join('fundraisers', 'fundraisings.fundraiser_id', '=', 'fundraisers.id')
    ->join('users', 'fundraisers.users_id', '=', 'users.id')
    ->where('fundraisings.is_active', 1)
    ->where('categories.slug', $slug)
    ->select(
        'fundraisings.*',
        'categories.name as category_name',
        'categories.slug as category_slug',
        'users.name as fundraiser_name', // Nama fundraiser dari tabel users
        'users.email as fundraiser_email', // Email fundraiser
        'users.whatsapp as fundraiser_whatsapp' // WhatsApp fundraiser
    )
    ->get();

    $categori = Category::where('slug', $slug)->firstOrFail();
        return view('Donaturs.category.index', compact('fundraisings', 'categori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donatur $donatur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Donatur $donatur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donatur $donatur)
    {
        //
    }
}
