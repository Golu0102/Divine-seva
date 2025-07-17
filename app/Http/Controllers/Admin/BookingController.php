<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\BookingCompletedMail;
use App\Mail\BookingStatusConfirmedMail;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('pooja')->latest()->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required']);
        $booking = Booking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        // Email logic based on new status
        if ($booking->status == 'Confirmed' || $booking->status == 'Cancel') {
            Mail::to($booking->email)->send(new BookingStatusConfirmedMail($booking));
        } elseif ($booking->status == 'Completed') {
            Mail::to($booking->email)->send(new BookingCompletedMail($booking));
        }

        return back()->with('success', 'Booking status updated.');
    }
}
