<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.room_types.index', [
            'title' => 'Room Types'
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.room_types.create', [
            'title' => 'Create Room Type'
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_night' => 'required|numeric',
            'max_occupancy' => 'required|numeric',
        ]);
        
        RoomType::create($request->all());
        
        return redirect()->route('admin.room-types.index');
        
    }
    
    /**
     * Display the specified resource.
     */
    public function show(RoomType $roomType)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoomType $roomType)
    {
        return view('dashboard.room_types.edit', [
            'title' => 'Edit Room Type',
            'roomType' => $roomType
        ]);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoomType $roomType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_night' => 'required|numeric',
            'max_occupancy' => 'required|numeric',
        ]);
        
        $roomType->update($request->all());
        
        return redirect()->route('admin.room-types.index');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomType $roomType)
    {
        $roomType->delete();
        
        return redirect()->route('admin.room-types.index');
    }
    
    public function roomTypes(Request $request)
    {
        $count = RoomType::count();
        $params = [
            'limit' => $request->input('length', 10),
            'offset' => $request->input('start', 0),
            'order_by' => ['created_at' => 'asc'],
            'search' => $request->input('search.value', '')
        ];
        
        $query = RoomType::query();
        
        if (!empty($params['search'])) {
            $query->where('name', 'like', '%'.$params['search'].'%');
        }
        
        $roomTypes = $query->orderBy('created_at', 'asc')
            ->offset($params['offset'])
            ->limit($params['limit'])
            ->get();
        
        $filteredCnt = $query->count();
        
        $data = $roomTypes->map(function ($roomType, $index) {
            return [
                'no' => $index + 1,
                'id' => $roomType->id,
                'name' => $roomType->name,
                'price_per_night' => $roomType->price_per_night,
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