<?php

namespace App\Http\Controllers\Employee;


use App\Http\Controllers\Controller;
use App\Models\Room;
use Auth;

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
     
        $room_count = $this->employeeRoomCount();
        $all_room_count=$this->allRoomCount();
        $booking_count=$this->bookingCount();
        
       
       
        return view('employee.home')->with([
            'room_count' => $room_count,
            'all_room_count' => $all_room_count,
            'room_percentage' => $this->employeeRoomPercentage(),
            'booking_count' => $booking_count
        ]); 
    }

    public function employeeRoomCount(){
        $user = Auth::user();
        $room_count = 0;
        foreach ($user->bookings as $booking) {
            $room_count += $booking->rooms->count();
        }
        return $room_count;
    }

    public function allRoomCount(){
        return Room::count();
    }

    public function employeeRoomPercentage(){
        
        $room_count = $this->employeeRoomCount();
        $all_room_count=$this->allRoomCount();
        if($all_room_count==0){
            return 0;
        }
        $room_percentage=($room_count/$all_room_count)*100;
        $room_percentage=number_format($room_percentage, 2, '.', '');   
        return $room_percentage;
    }

    public function bookingCount(){
        $user = Auth::user();
        return $user->bookings->count();
    }


}