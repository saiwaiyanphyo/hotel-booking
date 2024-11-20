<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingRoom;
use App\Models\Guest;
use App\Models\Room;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('employee.booking.index', [
            'title' => 'Bookings',
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = Room::where('status', 'available')->get();
        $statuses = ['booked', 'checked_in', 'checked_out', 'cancelled'];
        $paymentStatuses = ['paid', 'unpaid'];
        return view('employee.booking.create', [
            'title' => 'Create Booking',
            'rooms' => $rooms,
            'statuses' => $statuses,
            'paymentStatuses' => $paymentStatuses,
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'check_in_date' => 'required',
            'rooms' => 'required|array',
            'rooms.*.room_id' => 'required|exists:rooms,id',
            'status' => 'required|in:booked,checked_in,checked_out,cancelled',
            'payment_status' => 'required|in:paid,unpaid',
            'address' => 'required|string',
            'identity_number' => 'required|string',
        ]);
        
        
        list($check_in_date, $check_out_date) = explode(' to ', $data['check_in_date']);
        $check_in_date = date('Y-m-d', strtotime($check_in_date));
        $check_out_date = date('Y-m-d', strtotime($check_out_date));
        $totalDate = (strtotime($check_out_date) - strtotime($check_in_date)) / (60 * 60 * 24);
        
        $rooms = Room::with('roomType')->whereIn('id', array_column($data['rooms'], 'room_id'))->get();
        
        $totalPrice = $rooms->sum(fn($room) => $room->roomType->price_per_night) * $totalDate;
        
        $guest = Guest::where('email', $data['email'])->first();
        
        if (!$guest) {
            $guest = Guest::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'address' => $data['address'],
                'identity_number' => $data['identity_number'],
            ]);
        } else {
            $guest->update([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone_number' => $data['phone_number'],
                'address' => $data['address'],
                'identity_number' => $data['identity_number'],
            ]);
        }
        
        
        $booking = Booking::create([
            'guest_id' => $guest->id,
            'employee_id' => auth()->id(),
            'total_price' => $totalPrice,
            'check_in_date' => $check_in_date,
            'check_out_date' => $check_out_date,
            'status' => $data['status'],
            'payment_status' => $data['payment_status'],
        ]);
        
        foreach ($rooms as $room) {
            BookingRoom::create([
                'booking_id' => $booking->id,
                'room_id' => $room->id,
                'price' => $room->roomType->price_per_night * $totalDate,
            ]);
            
            $room->update(['status' => 'occupied']);
        }
        
        return redirect()->route('employee.bookings.index');
        
        
        
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
        $booking->load('guest');
        $paymentStatuses = ['paid', 'unpaid'];
        $statuses = ['booked', 'checked_in', 'checked_out', 'cancelled'];
        return view('employee.booking.edit', [
            'title' => 'Edit Booking',
            'booking' => $booking,
            'paymentStatuses' => $paymentStatuses,
            'statuses' => $statuses,
        ]);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:guests,email,'.$booking->guest_id,
            'phone_number' => 'required|string',
            'identity_number' => 'required|string',
            'address' => 'required|string',
            'status' => 'required|in:booked,checked_in,checked_out,cancelled',
            'payment_status' => 'required|in:paid,unpaid',
        ]);
        
        
        $guest = Guest::where('email', $data['email'])->first();
        
        if (!$guest) {
            $guest = Guest::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'address' => $data['address'],
                'identity_number' => $data['identity_number'],
            ]);
        } else {
            $guest->update([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone_number' => $data['phone_number'],
                'address' => $data['address'],
                'identity_number' => $data['identity_number'],
            ]);
        }
        
        $booking->update([
            'guest_id' => $guest->id,
            'status' => $data['status'],
            'payment_status' => $data['payment_status'],
        ]);
        
        
        return redirect()->route('employee.bookings.index');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        
        return redirect()->route('employee.bookings.index');
    }
    
    public function bookings(Request $request)
    {
        $count = Booking::count();
        $params = [
            'limit' => $request->input('length', 10),
            'offset' => $request->input('start', 0),
            'order_by' => ['created_at' => 'desc'],
            'search' => $request->input('search.value', '')
        ];
        
        $query = Booking::query()->with('guest');
        
        if (!empty($params['search'])) {
            $query->where('status', 'like', '%'.$params['search'].'%')
                ->orWhereHas('guest', function ($query) use ($params) {
                    $query->where('name', 'like', '%'.$params['search'].'%');
                    $query->orWhere('email', 'like', '%'.$params['search'].'%');
                });
        }
        
        $bookings = $query->orderBy('created_at', 'desc')
            ->offset($params['offset'])
            ->limit($params['limit'])
            ->get();
        
        $filteredCnt = $query->count();
        
        $data = $bookings->map(function ($booking, $index) {
            return [
                'no' => $index + 1,
                'id' => $booking->id,
                'guest_email' => $booking->guest->email,
                'total_price' => $booking->total_price,
                'check_in_date' => $booking->check_in_date->format('Y-m-d'),
                'check_out_date' => $booking->check_out_date->format('Y-m-d'),
                'status' => $booking->status,
                'payment_status' => $booking->payment_status,
            ];
        });
        
        return [
            'data' => $data,
            'recordsTotal' => $count,
            'draw' => $request->input('draw', 0),
            'recordsFiltered' => $filteredCnt,
        ];
    }
}
