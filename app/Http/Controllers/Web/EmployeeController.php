<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.employee.index',[
            'title' => 'Employees',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.employee.create',
        ['title' => 'Create Employee']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees',
            'phone_number' => 'required',
            'password' => 'required',
        ]);
        
        $data['password'] = bcrypt($data['password']);
        
        Employee::create($data);
        
        return redirect()->route('admin.employees.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('dashboard.employee.edit', [
            'title' => 'Edit Employee',
            'employee' => $employee,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees,email,'.$employee->id,
            'phone_number' => 'required',
            'password' => 'nullable',
        ]);
        
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        
        $employee->update($data);
        
        return redirect()->route('admin.employees.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
        $employee->delete();
        return redirect()->route('admin.employees.index');
    }
    
    public function employees(Request $request)
    {
       
        $count = Employee::count();
        $params = [
            'limit' => $request->input('length', 10),
            'offset' => $request->input('start', 0),
            'order_by' => ['created_at' => 'asc'],
            'search' => $request->input('search.value', '')
        ];
        
        $query = Employee::query();
        
        if (!empty($params['search'])) {
            $query->where('name', 'like', '%'.$params['search'].'%')
                ->orWhere('email', 'like', '%'.$params['search'].'%')
                ->orWhere('phone_number', 'like', '%'.$params['search'].'%');
        }
        
        $employees = $query->orderBy('created_at', 'asc')
            ->offset($params['offset'])
            ->limit($params['limit'])
            ->get();
        
        $filteredCnt = $query->count();
        
        $data = $employees->map(function ($employee, $index) {
            return [
                'no' => $index + 1,
                'id' => $employee->id,
                'name' => $employee->name,
                'email' => $employee->email,
                'phone_number' => $employee->phone_number,
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