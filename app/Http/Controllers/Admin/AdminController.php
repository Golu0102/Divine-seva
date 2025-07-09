<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Pooja;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function doLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt($request->only('username', 'password'))) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['Invalid credentials']);
    }


    public function logout()
    {
        Auth::guard('admin')->logout(); // ✅ logs out admin guard
        return redirect()->route('admin.login')->with('success', 'Logged out successfully');
    }

    public function dashboard()
    {
        $totalPoojas = Pooja::count();
        $totalBookings = Booking::count();
        $totalRevenue = Booking::join('poojas', 'poojas.id', '=', 'bookings.pooja_id')
            ->sum('poojas.price');

        // Chart: Bookings last 7 days
        $chartData = DB::table('bookings')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->where('created_at', '>=', now()->subDays(6))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->get();

        $chartDates = $chartData->pluck('date')->map(function ($d) {
            return \Carbon\Carbon::parse($d)->format('d M');
        })->toArray();

        $chartCounts = $chartData->pluck('count')->toArray();

        // Chart: Pooja-wise bookings
        $poojaStats = Booking::select('pooja_id', DB::raw('COUNT(*) as count'))
            ->groupBy('pooja_id')
            ->with('pooja:id,name')
            ->get()
            ->map(function ($booking) {
                return [
                    'label' => $booking->pooja->name ?? 'Unknown',
                    'count' => $booking->count
                ];
            });

        return view('admin.dashboard', compact(
            'totalPoojas',
            'totalBookings',
            'totalRevenue',
            'chartDates',
            'chartCounts',
            'poojaStats'
        ));
    }
}
