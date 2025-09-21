<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\CashBox;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CashBox $cashbox)
    {
        return view('bookings.create', ['cashbox' => $cashbox]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CashBox $cashbox, Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:1000',
            'amount' => 'required|numeric|min:0.01',
            'booking_date' => 'required|date',
        ]);

        $amount = $request->amount;
        if ($request->amount_type === 'outgoing') {
            $amount = -$request->amount;
        }

        Booking::create([
            'description' => $request->description,
            'amount' => $amount,
            'booking_date' => $request->booking_date,
            'cash_box_id' => $cashbox->id,
        ]);

        $cashbox->balance += $amount;
        $cashbox->save();

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
