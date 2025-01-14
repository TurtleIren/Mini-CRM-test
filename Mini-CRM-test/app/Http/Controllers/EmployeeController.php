<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use App\Http\Requests\StoreEmployeeRequest;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $employees = Employee::with('company')->paginate(env('ROWS_PER_PAGE',10));
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $companies = Company::select('id', 'name')->get();
        return view('employees.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        //
        try {
            $data = $request->validated();
            Employee::create($data);

            return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('employees.index')->with('error', 'Failed to create employee: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Employee $employee)
    {
        $companies = Company::select('id', 'name')->get();
        return view('employees.edit', compact('employee', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(StoreEmployeeRequest $request, Employee $employee)
    {
        try {
            $data = $request->validated();
            $employee->update($data);

            return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('employees.index')->with('error', 'Failed to update employee: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();
            return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('employees.index')->with('error', 'Failed to delete employee: ' . $e->getMessage());
        }
    }
}
