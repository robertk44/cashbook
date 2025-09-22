<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\CashBox;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\ImageManager;

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
        $categories = Category::orderBy('name')->get();
        return view('bookings.create', [
            'categories' => $categories,
            'cashbox' => $cashbox,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CashBox $cashbox, Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:1000',
            'amount_type' => 'required|in:income,outgoing',
            'amount' => 'required|numeric|min:0.01',
            'receipt_image' => 'nullable|file|mimes:jpeg,jpg,png,gif,bmp,svg|max:20480',
            'booking_date' => 'required|date',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $receipt_img_path = null;
        if ($request->hasFile('receipt_image')) {
            $file = $request->file('receipt_image');
            $extension = strtolower($file->getClientOriginalExtension());

            if (in_array($extension, ['png', 'jpg', 'jpeg'])) {
                $manager = ImageManager::imagick();
                $image = $manager->read($file->getRealPath());
                $width = $image->width();
                $height = $image->height();
                if ($width > $height && $width > 2000) {
                    $image->scale(width: 2000);
                } elseif ($height >= $width && $height > 2000) {
                    $image->scale(height: 2000);
                }

                $jpegEncoder = new JpegEncoder(quality: 70);
                $encoded = $image->encode($jpegEncoder);
                $filename = uniqid() . '.jpg';
                $path = 'receipts/' . $filename;
                Storage::disk('public')->put($path, (string) $encoded);
                $receipt_img_path = $path;
            } else {
                return back()->withErrors(['receipt_image' => 'The receipt image must be a PNG or JPG file.']);
            }
        }

        $amount = $request->amount;
        if ($request->amount_type === 'outgoing') {
            $amount = -$request->amount;
        }

        Booking::create([
            'description' => $request->description,
            'amount' => $amount,
            'receipt_image' => $receipt_img_path,
            'booking_date' => $request->booking_date,
            'cash_box_id' => $cashbox->id,
            'category_id' => $request->category_id,
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
