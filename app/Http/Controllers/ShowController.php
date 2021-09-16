<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use App\Department;
use Illuminate\Http\Request;
use App\Exports\EmployeesExport;
use Maatwebsite\Excel\Facades\Excel;

class ShowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function companies()
    {
        $companies = Company::paginate(10);
        $departments = Department::all();

        return view('companies', compact('companies', 'departments'));
    }
    public function employees()
    {
        $companies = Company::all();
        $departments = Department::all();
        $employees = Employee::paginate(10);

        return view('employees', compact('companies', 'departments', 'employees'));
    }
    public function employeeExport()
    {
        return Excel::download(new EmployeesExport(), 'employees.xlsx');
    }
}
