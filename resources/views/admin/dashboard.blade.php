@extends('layouts.admin')
@section('style')
    <link href="{{ asset('admin/assets/node_modules/css-chart/css-chart.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/assets/node_modules/css-chart/css-chart.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/pages/easy-pie-chart.css') }}">
    <style>
        p.icon-css {
            top: 50%;
            left: 50%;
            font-size: 32px;
            color: #A6B7BF;
            transform: translate(-15px, -24px);
            position: absolute;
        }

        .chart {
            position: relative;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .company_list,
        .department_lis {
            padding: 5px;
            max-height: 450px;
            overflow-y: scroll;
        }

        .company_list::-webkit-scrollbar,
        .department_lis::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .company_list,
        .department_lis {
            -ms-overflow-style: none;
            scrollbar-width: none;

        }

    </style>
@endsection
@section('admin')
    <div class="container-fluid">

        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Dashboard</h4>
            </div>
        </div>
        <div class="row mb-4">

            <div class="col-lg-3 col-md-6">
                <div class="bg-white py-2 px-3">
                    <div class="row">
                        <div class="col">
                            <h1 class="font-light mt-sm-3">{{ count($users) }}
                            </h1>
                            <h6 class="text-dark">Login Account</h6>
                        </div>
                        <div class="col text-right align-self-center">
                            <div class="chart easy-pie-chart-6" data-percent="{{ count($users) }}">
                                <p class="icon-css">
                                    <i class="mdi mdi-account-circle"></i>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="bg-white py-2 px-3">
                    <div class="row">
                        <div class="col">
                            <h1 class="font-light mt-sm-3">{{ count($companies) }}</h1>
                            <h6 class="text-dark">Total Companies</h6>
                        </div>
                        <div class="col text-right align-self-center">
                            <div class="chart easy-pie-chart-4" data-percent="{{ count($companies) }}">
                                <p class="icon-css">
                                    <i class="mdi mdi-briefcase-check"></i>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="bg-white py-2 px-3">
                    <div class="row">
                        <div class="col">
                            <h1 class="font-light mt-sm-3">{{ count($departments) }}</h1>
                            <h6 class="text-dark text-break">Total Department</h6>
                        </div>
                        <div class="col text-right align-self-center">
                            <div class="chart easy-pie-chart-6" data-percent="{{ count($departments) }}">
                                <p class="icon-css">
                                    <i class="mdi mdi-star-circle"></i>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="bg-white py-2 px-3">
                    <div class="row">
                        <div class="col">
                            <h1 class="font-light mt-sm-3">{{ count($employees) }}</h1>
                            <h6 class="text-dark">Total Employees</h6>
                        </div>
                        <div class="col text-right align-self-center">
                            <div class="chart easy-pie-chart-5" data-percent="{{ count($employees) }}">
                                <p class="icon-css">
                                    <i class="mdi mdi-receipt"></i>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="company_list">
                        <div class=" card-title">
                            <h4 class="p-2">Company Lists</h4>
                        </div>
                        <table class="table table-bordered table-hover">
                            <tbody id="myTable">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Departments</th>

                                </tr>
                                @if (count($companies) > 0)
                                    @foreach ($companies as $key => $company)
                                        <div id="verticalcenter{{ $company->id }}" class="modal" tabindex="-1"
                                            role="dialog" aria-labelledby="vcenter" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="vcenter">Edit Company</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="/admin/company/update/{{ $company->id }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('put')
                                                            <div class="form-group">
                                                                <label for="company_name">Name</label>
                                                                <input type="text"
                                                                    class="form-control @error('company_name') border-danger @enderror"
                                                                    name="company_name" id="company_name"
                                                                    value="{{ $company->company_name }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <p class="py-2">Department</p>

                                                                @foreach ($departments as $department)
                                                                    <div>
                                                                        <input type="checkbox"
                                                                            id="{{ $company->id . '-' . $department->slug }}"
                                                                            value="{{ $department->id }}"
                                                                            name="departments[]" @foreach ($company->departments as $old_departments)
                                                                        {{ $old_departments->id == $department->id ? 'checked' : '' }}
                                                                @endforeach >
                                                                <label
                                                                    for="{{ $company->id . '-' . $department->slug }}">
                                                                    {{ $department->department_name }}
                                                                </label>
                                                            </div>


                                    @endforeach

                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ $company->email }}">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea name="address" id="address" class="form-control"
                            rows="5">{{ $company->address }}</textarea>
                    </div>
                    <input type="submit" class="btn btn-success" value="Update">
                    </form>

                </div>

            </div>

        </div>

    </div>

    <tr>
        <td>{{ $key + 1 }}</td>
        <td>
            {{ $company->company_name }}
            <p class="action mb-0 mt-1">
                <a href="" class="text-primary" data-toggle="modal"
                    data-target="#verticalcenter{{ $company->id }}">Edit</a>
                <a href="{{ route('admin-delete-company', $company->id) }}" class="text-danger">Delete</a>
            </p>
        </td>
        <td> {{ $company->email }} </td>
        <td> {{ $company->departments->count() }} </td>
    </tr>
    @endforeach
    @endif

    </tbody>

    </table>
    </div>
    </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="department_lis">
                <div class=" card-title">
                    <h4 class="p-2">Department Lists</h4>
                </div>
                <table class="table table-bordered table-hover table-responsive">
                    <tbody>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Remark</th>
                            <th>Count</th>
                        </tr>
                        @if (count($departments) > 0)
                            @foreach ($departments as $key => $department)
                                <div id="department{{ $department->id }}" class="modal" tabindex="-1"
                                    role="dialog" aria-labelledby="vcenter" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="vcenter">Edit Department</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/admin/department/update/{{ $department->id }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <div class="form-group">
                                                        <label for="department_name">Department Name</label>
                                                        <input type="text"
                                                            class="form-control @error('department_name') border-danger @enderror"
                                                            name="department_name" id="department_name"
                                                            value="{{ $department->department_name }}">
                                                        @error('department_name')
                                                            <small id="department_name" class="form-text text-muted">
                                                                Please Fill Unique Category Name.
                                                            </small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="slug">Slug</label>
                                                        <input type="text" class="form-control" name="slug" id="slug"
                                                            value="{{ $department->slug }}">
                                                        <small class="text-muted">
                                                            The “slug” is the URL-friendly version of the name.
                                                        </small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="remark">Remark</label>
                                                        <textarea name="remark" id="remark" class="form-control"
                                                            rows="5">{{ $department->remark }}</textarea>
                                                        <small class="text-muted">
                                                            The remark is just optional ,sometime you may show it.
                                                        </small>
                                                    </div>
                                                    <input type="submit" class="btn btn-primary" value="Update">
                                                    <button type="button" class="btn btn-info waves-effect"
                                                        data-dismiss="modal">Close</button>
                                                </form>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        {{ $department->department_name }}
                                        <p class="action mb-0 mt-1">
                                            <a href="" class="text-primary" data-toggle="modal"
                                                data-target="#department{{ $department->id }}">Edit</a>
                                            <a href="{{ url('/admin/department/delete/' . $department->id) }}"
                                                class="text-danger">Delete</a>
                                        </p>
                                    </td>
                                    <td> {{ $department->slug }} </td>
                                    <td> {{ $department->remark }} </td>
                                    <td> {{ $department->companies->count() }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    </div>

    </div>
@endsection
@section('javascript')
    <script src="{{ asset('admin/assets/node_modules/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js') }}">
    </script>
    <script src="{{ asset('admin/assets/node_modules/jquery.easy-pie-chart/easy-pie-chart.init.js') }}"></script>
@endsection
