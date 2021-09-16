@extends('layouts.admin')
@section('style')
    <style>
        .pagination {
            justify-content: end;
            padding: 10px;
            margin: 0px;
        }

    </style>
@endsection

@section('admin')

    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Employee lists</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <a href="{{ route('admin-emplyoee-createform') }}" type="button"
                        class="btn btn-info btn-rounded m-t-10 text-white float-right">New Employee
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div>
                        {{ $employees->links() }}
                    </div>
                    <div class="table-responsive">
                        <table id="demo-foo-addrow" class="table table-bordered m-t-30 table-hover contact-list"
                            data-paging="true" data-paging-size="7">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Company</th>
                                    <th>Department</th>
                                    <th>Address</th>
                                    <th>Staff_Id</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @foreach ($employees as $key => $employee)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            {{ $employee->firstname . ' ' . $employee->lastname }}
                                        </td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->phone }}</td>
                                        <td>
                                            @foreach ($companies as $company)
                                                {{ $company->id == $employee->company_id ? $company->company_name : '' }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($departments as $department)
                                                {{ $department->id == $employee->department_id ? $department->department_name : '' }}
                                            @endforeach
                                        </td>
                                        <td>
                                            <p class="text-center mb-2">{{ $employee->address }}</p>
                                        </td>
                                        <td>
                                            {{ $employee->staff_id }}
                                        </td>
                                        <td>
                                            <a href="" class="btn btn-primary px-4 btn-sm my-1" data-toggle="modal"
                                                data-target="#verticalcenter{{ $employee->id }}">Edit</a>
                                            <a href="" class="btn btn-danger px-3 btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                    <div id="verticalcenter{{ $employee->id }}" class="modal" tabindex="-1"
                                        role="dialog" aria-labelledby="vcenter" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="vcenter">Edit
                                                        {{ $employee->firstname }}
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin-emplyoee-update', $employee->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <input type="hidden" name="role_id" value="2">
                                                        <div class="card-body">
                                                            <div class="row pt-3">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label
                                                                            class="control-label @error('firstname') border-danger @enderror">First
                                                                            Name</label>
                                                                        <input type="text" id="firstname"
                                                                            class="form-control"
                                                                            value="{{ $employee->firstname }}"
                                                                            name="firstname">
                                                                        @error('firstname')
                                                                            <p class="text-danger">
                                                                                <small>{{ $message }}</small>
                                                                            </p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <!--/span-->
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Last Name</label>
                                                                        <input type="text" id="lastname"
                                                                            class="form-control @error('lastname') border-danger @enderror"
                                                                            value="{{ $employee->lastname }}"
                                                                            name="lastname">
                                                                        @error('lastname')
                                                                            <p class="text-danger">
                                                                                <small>{{ $message }}</small>
                                                                            </p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <!--/span-->
                                                            </div>
                                                            <!--/row-->
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Company Name</label>
                                                                        <select
                                                                            class="form-control  @error('company_id') border-danger @enderror custom-select"
                                                                            id="company_id" name="company_id">
                                                                            @foreach ($companies as $company)
                                                                                <option
                                                                                    {{ $company->id == $employee->company_id ? 'selected' : '' }}
                                                                                    value="{{ $company->id }}">
                                                                                    {{ $company->company_name }}</option>
                                                                                {{ $company->id }}
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <!--/span-->
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Department</label>
                                                                        <select
                                                                            class="form-control  @error('department_id') border-danger @enderror custom-select"
                                                                            data-placeholder="Choose a Category"
                                                                            tabindex="1" name="department_id">
                                                                            @foreach ($departments as $department)
                                                                                <option
                                                                                    {{ $department->id == $employee->department_id ? 'selected' : '' }}
                                                                                    value="{{ $department->id }}">
                                                                                    {{ $department->department_name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <!--/span-->
                                                            </div>
                                                            <!--/row-->
                                                            <div class="row">
                                                                <!--/span-->
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label"
                                                                            for="email">Email</label>
                                                                        <input type="email" id="email" name="email"
                                                                            value="{{ $employee->email }}"
                                                                            class="form-control @error('email') border-danger @enderror">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label"
                                                                            for="phone">Phone</label>
                                                                        <input type="tel" id="phone" name="phone"
                                                                            value="{{ $employee->phone }}"
                                                                            class="form-control @error('phone') border-danger @enderror">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label"
                                                                            for="address">Address</label>
                                                                        <input type="text" id="address" name="address"
                                                                            value="{{ $employee->address }}"
                                                                            class="form-control @error('address') border-danger @enderror">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="password">Staff Id</label>
                                                                        <div class="input-group mb-3">
                                                                            <input
                                                                                class="form-control @error('staff_id') border-danger @enderror"
                                                                                type="text" name="staff_id" id="staff_id"
                                                                                value="{{ $employee->staff_id }}">
                                                                            <div class="input-group-prepend">
                                                                                <a onclick="generate()" type="button"
                                                                                    class="input-group-text"
                                                                                    id="generate-pwd">Generate</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/span-->
                                                            </div>
                                                            <!--/row-->
                                                        </div>
                                                        <div class="form-actions">
                                                            <div class="card-body">
                                                                <button type="submit" class="btn btn-success"> <i
                                                                        class="fa fa-check"></i> Save</button>
                                                                <button type="button" class="btn btn-dark">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        {{ $employees->links() }}
                    </div>
                    <div class="mr-auto p-2">
                        <a href="{{ url('employee/export') }}" class="btn btn-success text-center">Export Excel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
