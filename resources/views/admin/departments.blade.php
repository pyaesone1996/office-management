@extends('layouts.admin')
@section('style')
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
    @include('admin.alert-message')
    <div class="container-fluid">

        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">New Department </h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">New Department </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-4">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Create New Department</h4>
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
                                <small class="text-muted">The “slug” is the URL-friendly version of the name.</small>
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

            <div class="col-lg-8">

                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-hover">

                            <tbody id="myTable">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Remark</th>
                                    <th>Count</th>
                                </tr>
                                @if (count($departments) > 0)
                                    @foreach ($departments as $key => $department)
                                        <div id="verticalcenter{{ $department->id }}" class="modal" tabindex="-1"
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
                                                                <input type="text" class="form-control" name="slug"
                                                                    id="slug" value="{{ $department->slug }}">
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
                                                        data-target="#verticalcenter{{ $department->id }}">Edit</a>
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

                        <div class="d-flex">
                            <p>{{ $departments->links() }}</p>

                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>


@endsection
