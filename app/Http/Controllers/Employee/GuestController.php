<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('employee.guest.index', [
            'title' => 'Guests'
        ]);
    }

    public function guests(Request $request)
    {
        $count = Guest::count();
        $params = [
            'limit' => $request->input('length', 10),
            'offset' => $request->input('start', 0),
            'order_by' => ['created_at' => 'desc'],
            'search' => $request->input('search.value', '')
        ];
        
        $query = Guest::query();
        
        if (!empty($params['search'])) {
            $query->where('first_name', 'like', '%'.$params['search'].'%')
                ->orWhere('last_name', 'like', '%'.$params['search'].'%')
                ->orWhere('email', 'like', '%'.$params['search'].'%')
                ->orWhere('phone_number', 'like', '%'.$params['search'].'%')
                ->orWhere('identity_number', 'like', '%'.$params['search'].'%');
            
        }
        
        $guests = $query->orderBy('created_at', 'desc')
            ->offset($params['offset'])
            ->limit($params['limit'])
            ->get();
        
        $filteredCnt = $query->count();
        
        $data = $guests->map(function ($guest, $index) {
            return [
                'no' => $index + 1,
                'id' => $guest->id,
                'full_name' => $guest->full_name,
                'email' => $guest->email,
                'phone_number' => $guest->phone_number,
                'identity_number' => $guest->identity_number,
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
