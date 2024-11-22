<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingRoom;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       
        return view('dashboard.home');
    }

    public function monthly_income(Request $request)
    {
        // Validate the request
        $request->validate([
            'date' => 'required|date_format:Y-m'
        ]);

        // Extract the month and year from the request
        $date = $request->input('date');
        $year = substr($date, 0, 4);
        $month = substr($date, 5, 2);

        // Query the database for records matching the selected month and year
        $data = Booking::whereYear('check_in_date', $year)
                       ->whereMonth('check_in_date', $month) // Eager load the room relationship
                       ->get();

        // Format the data for DataTables
        $formattedData = $data->map(function ($item, $index=0) {
            return [
                $index + 1,
                $item->check_in_date ? Carbon::parse($item->check_in_date)->format('F Y') : '',
                $item->total_price,
            ];
        });

        // Return the data as a JSON response
        return response()->json(['data' => $formattedData]);
    }
}