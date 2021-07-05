<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::with('Company')->paginate(10);
        return view('employee.list-employees',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        return view('employee.create-employee',compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        try {
            $valid = $request->validated();
            $employee = new Employee($valid);
            $employee->save();
            return Redirect::route('employees.index')->with('success','Employee Saved');
        } catch(\Exception $e) {
            Log::error('Error saving employee '.$e->getMessage());
            return Redirect::back()->withErrors(['errors' => 'Failed to create a new employeee '.$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            return view('employee.view-employee',compact('employee'));
        } catch(ModelNotFoundException $e) {
            return Redirect::back()->withErrors(['errors' => 'Employee not found']);
        } catch(\Exception $e) {
            Log::error('error deleting employee '.$e->getMessage());
            return Redirect::back()->withErrors(['errors' => 'Error viewing employee']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $employee = Employee::with('Company')->findOrFail($id);
            $companies = Company::all();
            return view('employee.edit-employee',compact('employee','companies'));
        } catch(ModelNotFoundException $e) {
            return Redirect::back()->withErrors(['errors' => 'Employee not found']);
        } catch(\Exception $e) {
            Log::error('error editing employee '.$e->getMessage());
            return Redirect::back()->withErrors(['errors' => 'Error editing employee']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        try {
            $valid = $request->validated();
            $employee = Employee::findOrFail($id);
            $employee->fill($valid);
            $employee->save();
            return Redirect::route('employees.index')->with('success','Employee '.$employee->first_name.' updated');

        } catch(ModelNotFoundException $e) {
            return Redirect::back()->withErrors(['errors' => 'Employee not found']);
        } catch(\Exception $e) {
            Log::error('error deleting employee '.$e->getMessage());
            return Redirect::back()->withErrors(['errors' => 'Error updating employee']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();
            return Redirect::route('employees.index')->with('success','Employee Deleted');
        } catch(ModelNotFoundException $e) {
            return Redirect::back()->withErrors(['errors' => 'Employee not found']);
        } catch(\Exception $e) {
            Log::error('error deleting employee '.$e->getMessage());
            return Redirect::back()->withErrors(['errors' => 'Error deleting employee']);
        }
    }
}
