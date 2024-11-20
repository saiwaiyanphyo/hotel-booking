<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.room.index', [
            'title' => 'Rooms'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roomTypes = RoomType::all();
        $statuses = ['available', 'occupied', 'reserved', 'maintenance'];
        return view('dashboard.room.create',
        ['title' => 'Create Room', 'roomTypes' => $roomTypes, 'statuses' => $statuses]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_type_id' => 'required',
            'room_number' => 'required',
            'status' => 'required|in:available,occupied,reserved,maintenance',
            ]);
        
        Room::create($request->all());
        
        return redirect()->route('admin.rooms.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        $roomTypes = RoomType::all();
        $statuses = ['available', 'occupied', 'reserved', 'maintenance'];
        return view('dashboard.room.edit',
        ['title' => 'Edit Room', 'room' => $room, 'roomTypes' => $roomTypes, 'statuses' => $statuses,'roomTypeId'=>$room->room_type_id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'room_type_id' => 'required',
            'room_number' => 'required',
            'status' => 'required|in:available,occupied,reserved,maintenance',
        ]);
        
        $room->update($request->all());
        
        return redirect()->route('admin.rooms.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        
        return redirect()->route('admin.rooms.index');
    }
    
    public function rooms(Request $request)
    {
        $count = Room::count();
        $params = [
            'limit' => $request->input('length', 10),
            'offset' => $request->input('start', 0),
            'order_by' => ['created_at' => 'desc'],
            'search' => $request->input('search.value', '')
        ];
        
        $query = Room::query()->with('roomType');
        
        if (!empty($params['search'])) {
            $query->where('room_number', 'like', '%'.$params['search'].'%')
                ->orWhere('status', 'like', '%'.$params['search'].'%')
                ->orWhereHas('roomType', function ($query) use ($params) {
                    $query->where('name', 'like', '%'.$params['search'].'%');
                });
        }
        
        $rooms = $query->orderBy('created_at', 'desc')
            ->offset($params['offset'])
            ->limit($params['limit'])
            ->get();
        
        $filteredCnt = $query->count();
        
        $data = $rooms->map(function ($room, $index) {
            return [
                'no' => $index + 1,
                'id' => $room->id,
                'room_number' => $room->room_number,
                'room_type' => $room->roomType->name,
                'status' => $room->status,
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