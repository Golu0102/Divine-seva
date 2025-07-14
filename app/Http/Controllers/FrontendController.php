<?php


namespace App\Http\Controllers;

use App\Models\Pandit;
use App\Models\Pooja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    // Show all available poojas on homepage
    public function index()
    {
        $poojas = Pooja::with('pandit')->where('is_active', true)->get();
        $pandits = Pandit::all();
        return view('frontend.index', compact('poojas', 'pandits'));
    }

    public function allPoojas()
    {
        $poojas = Pooja::with('pandit')->latest()->get();
        return view('frontend.all-poojas', compact('poojas'));
    }

    public function bookForm()
    {
        $poojas = Pooja::where('is_active', '1')->get();
        $pandits = Pandit::all();

        return view('frontend.book-pooja', compact('poojas', 'pandits'));
    }



    public function view($id)
    {
        $pooja = Pooja::with('pandit')->findOrFail($id);
        return view('frontend.pooja', compact('pooja'));
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'message' => 'required|string|max:1000',
        ]);

        // You can send this via mail or store in DB
        Mail::raw("Message from {$request->name} ({$request->email}):\n\n{$request->message}", function ($mail) {
            $mail->to('rajshekhardivya39@gmail.com')->subject('New Contact Message');
        });

        return back()->with('success', 'Thank you for contacting us!');
    }

    public function services()
    {
        $poojas = Pooja::where('is_active', true)->get();
        return view('frontend.services', compact('poojas'));
    }
}
