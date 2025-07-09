<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'pooja_id' => 'required|exists:poojas,id',
            'name'     => 'required|string|max:255',
            'mobile'   => 'required|string|max:15',
            'address'  => 'required|string',
            'date'     => 'required|date',
            'time'     => 'required',
        ]);

        Booking::create([
            'pooja_id' => $request->pooja_id,
            'name'     => $request->name,
            'mobile'   => $request->mobile,
            'address'  => $request->address,
            'date'     => $request->date,
            'time'     => $request->time,
            'status'   => 'Pending',
        ]);

        return redirect('/thank-you')->with('success', 'Booking submitted successfully!');
    }
}
