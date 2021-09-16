<?php

namespace App\Exports;

use App\Company;
use App\Department;
use App\Employee;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class EmployeesExport implements FromView
{
    public function view(): View
    {
        return view('exports.employees', [
            'employees' => Employee::all(),
            'companies' => Company::all(),
            'departments' => Department::all(),
        ]);
    }
}
