<?php

namespace App\Http\Controllers;

use App\Models\CashBox;
use Illuminate\Http\Request;

class CashBoxController extends Controller
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
    public function create()
    {
        return view('cashboxes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:1000',
            'balance' => 'required|numeric',
        ]);

        CashBox::create([
            'name' => $request->name,
            'description' => $request->description,
            'balance' => $request->balance,
        ]);

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(CashBox $cashbox)
    {
        return view('cashboxes.show', [
            'cashbox' => $cashbox->load(['bookings' => function ($query) {
                $query->orderBy('booking_date', 'desc')->orderBy('id', 'desc');
            }]),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CashBox $cashBox)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CashBox $cashBox)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CashBox $cashBox)
    {
        //
    }
}
