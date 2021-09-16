<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Company;
use App\Employee;
use App\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\EmployeesExport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'admin:Admin']);
    }
    public function dashboard()
    {
        $companies = Company::all();
        $departments = Department::all();
        $employees = Employee::all();
        $users = User::all();

        return view('admin.dashboard', compact('companies', 'departments', 'employees', 'users'));
    }

    public function employee()
    {
        $companies = Company::all();
        $departments = Department::all();

        return view('admin.employees', compact('companies', 'departments'));
    }

    public function createEmployee(Request $request)
    {
        request()->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'staff_id' => ['required', 'unique:employees'],
        ]);

        $role = Role::where('id', request('role_id'))->get();
        $emplyoee = new Employee();
        $emplyoee->firstname = $request->firstname;
        $emplyoee->lastname = $request->lastname;
        $emplyoee->company_id = $request->company_id;
        $emplyoee->department_id = $request->department_id;
        $emplyoee->email = $request->email;
        $emplyoee->phone = $request->phone;
        $emplyoee->staff_id = $request->staff_id;
        $emplyoee->address = $request->address;
        $emplyoee->save();

        $emplyoee->role()->attach($role);

        return back()->with('success', 'Your Data Is Added!');
    }

    public function updateEmployee(Request $request, $id)
    {
        $emplyoee = Employee::find($id);
        $emplyoee->firstname = $request->firstname;
        $emplyoee->lastname = $request->lastname;
        $emplyoee->company_id = $request->company_id;
        $emplyoee->department_id = $request->department_id;
        $emplyoee->email = $request->email;
        $emplyoee->phone = $request->phone;
        $emplyoee->staff_id = $request->staff_id;
        $emplyoee->address = $request->address;
        $emplyoee->save();

        return back()->with('update', 'Your Data Is Updated!');
    }

    public function deleteEmployee($id)
    {
        $emplyoee = Employee::find($id);
        $emplyoee->delete();

        return back()->with('delete', 'Your Data Is Updated!');
    }

    public function listEmployee()
    {
        $employees = Employee::paginate(10);
        $companies = company::all();
        $departments = Department::all();
        return view('admin.employee-list', compact('employees', 'companies', 'departments'));
    }

    public function changedept(Request $request)
    {
        $companies = Company::all();
        $departments = Department::whereIn('id', $request->company_id)->get();
        return view('admin.employees', compact('companies', 'departments'));
    }

    public function department()
    {
        $departments = Department::paginate(10);
        return view('admin.departments', compact('departments'));
    }
    public function account()
    {
        $roles = Role::all();
        return view('admin.account', compact('roles'));
    }

    public function createAccount(Request $request)
    {
        $role = Role::where('id', request('role_id'))->get();
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $user->role()->attach($role);
        return back()->with('success', 'Your Data Is Added!');
    }

    public function listAccount()
    {
        $users = User::all();
        $roles = Role::all();

        return view('admin.account-list', compact('users', 'roles'));
    }

    public function editAccount($id)
    {
        $user =  User::findorFail($id);
        $roles = Role::all();
        return view('admin.account-edit', compact('user', 'roles'));
    }
    public function updateAccount(Request $request, $id)
    {
        $user =  User::findorFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        if ($request->role_id) {
            $role = Role::where('id', request('role_id'))->get();
            $user->roles()->attach($role);
        }
        return back()->with('update', 'Your Data Is Added!');
    }
    public function deleteAccount($id)
    {
        $user =  User::findorFail($id);
        $user->delete();

        return back()->with('delete', 'Your Data Is Added!');
    }

    public function createDepartment(Request $request)
    {
        request()->validate([
            'department_name' => ['required', 'unique:departments'],
        ]);
        $department = new Department();
        $department->department_name = $request->department_name;
        $department->slug = request('slug') ? Str::slug(request('slug'), '-') : Str::slug(request('department_name'), '-');
        $department->remark = $request->remark;
        $department->save();

        return back()->with('success', 'Your Data Is Added!');
    }
    public function updateDepartment(Request $request, $id)
    {
        $department = Department::findorFail($id);
        $department->department_name = request('department_name');
        $department->slug = request('slug') ? Str::slug(request('slug'), '-') : $department->slug;
        $department->remark = request('remark') ? request('remark') : $department->remark;
        $department->save();

        return back()->with('update', 'Your Data Is Updated!');
    }
    public function deleteDepartment($id)
    {
        $department = Department::findorFail($id);
        $department->delete();

        return back()->with('delete', 'Your Data Was Deleted!');
    }

    public function company()
    {
        $departments = Department::all();
        $companies = Company::paginate(10);
        return view('admin.companies', compact('companies', 'departments'));
    }

    public function createCompany(Request $request)
    {
        request()->validate([
            'company_name' => ['required', 'unique:companies'],
        ]);
        $company = new Company();
        $company->company_name = $request->company_name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->save();

        $company->departments()->sync(request('departments'));

        return back()->with('success', 'Your Data Is Added!');
    }

    public function updateCompany(Request $request, $id)
    {
        $company = Company::findorFail($id);
        $company->company_name = $request->company_name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->save();

        if (request()->departments) {
            $company->departments()->sync(request('departments'));
        }

        return back()->with('update', 'Your Data Is Added!');
    }
    public function deleteCompany($id)
    {
        $company = Company::findorFail($id);
        $company->delete();

        return back()->with('delete', 'Your Data Is Added!');
    }
}
