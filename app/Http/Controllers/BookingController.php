<?php

namespace App\Http\Controllers;

use App\Mail\BookingSubmittedMail;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'pooja_id' => 'required|exists:poojas,id',
            'name'     => 'required|string|max:255',
            'mobile'   => 'required|string|max:15',
            'email'    => 'required|email',
            'address'  => 'required|string',
            'date'     => 'required|date',
            'time'     => 'required',
        ]);

       $booking = Booking::create([
            'pooja_id' => $request->pooja_id,
            'name'     => $request->name,
            'mobile'   => $request->mobile,
            'email'    => $request->email,
            'address'  => $request->address,
            'date'     => $request->date,
            'time'     => $request->time,
            'status'   => 'Pending',
        ]);

        // Send booking confirmation email
        Mail::to($booking->email)->send(new BookingSubmittedMail($booking));

        return redirect('/thank-you')->with('success', 'Booking submitted successfully!');
    }
}
