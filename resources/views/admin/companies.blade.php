@extends('layouts.admin')
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .action {
            opacity: 0;
            transition: visibility 0s, opacity 0.5s linear;
        }

        tr:hover .action {
            opacity: 1;
            cursor: pointer;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple,
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #ddd !important;
        }

    </style>

@endsection

@section('admin')

    <div class="container-fluid">

        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Company Registration </h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">New Company </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-4">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Company Registration </h4>
                        <form action="/admin/company" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="company_name">Name</label>
                                <input type="text" class="form-control @error('company_name') border-danger @enderror"
                                    name="company_name" id="company_name">
                                @error('company_name')
                                    <small id="company_name" class="form-text text-muted">Please Fill Unique Company.</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="department">Department</label>
                                <a type="button" data-toggle="modal" data-target="#departmentForm" class="float-right">
                                    + Add More
                                </a>
                                <select id="department" class="js-example-basic-multiple form-control" name="departments[]"
                                    multiple="multiple">
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->department_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" id="address" class="form-control" rows="5"></textarea>
                            </div>
                            <input type="submit" class="btn btn-success" value="Add">
                        </form>

                    </div>
                </div>

            </div>

            <div class="col-lg-8">

                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-hover">

                            <tbody id="myTable">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Departments</th>
                                    <th>Address</th>
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
                                                                <label for="{{ $company->id . '-' . $department->slug }}">
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
        <td> {{ $company->address }} </td>

    </tr>
    @endforeach
    @endif


    </tbody>

    </table>

    <div class="d-flex">
        <p>{{ $companies->links() }}</p>
    </div>

    </div>
    </div>

    <div id="departmentForm" class="modal" tabindex="-1" role="dialog" aria-labelledby="vcenter"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="vcenter">Create Department</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="/admin/department" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="department_name">Department Name</label>
                            <input type="text" class="form-control @error('department_name') border-danger @enderror"
                                name="department_name" id="department_name">
                            @error('department_name')
                                <small id="department_name" class="form-text text-muted">
                                    Please Fill Unique Category Name.
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" name="slug" id="slug">
                            <small class="text-muted">The “slug” is the URL-friendly version of the
                                name.</small>
                        </div>
                        <div class="form-group">
                            <label for="description">Remark</label>
                            <textarea name="remark" id="remark" class="form-control" rows="5"></textarea>
                            <small class="text-muted">The remark is just optional ,sometime you may show
                                it.</small>
                        </div>
                        <input type="submit" class="btn btn-success" value="Add">
                    </form>

                </div>

            </div>

        </div>

    </div>

    </div>

    </div>

    </div>


@endsection

@section('javascript')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection
