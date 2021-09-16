@extends('layouts.app')
@section('style')
    <style>
        td,
        th {
            vertical-align: middle !important;
        }

        .pagination {
            justify-content: end;
        }

    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Employees List</h2>
                        {{ $employees->links() }}
                        <div class="table-responsive">
                            <table id="demo-foo-addrow" class="table table-bordered m-t-30 table-hover contact-list"
                                data-paging="true" data-paging-size="7">
                                <thead>
                                    <tr style="text-align:center;vertical-align:middle;">
                                        <th>No</th>
                                        <th>Staff_id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Company</th>
                                        <th>Departments</th>
                                        <th>Address</th>

                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    @foreach ($employees as $key => $employee)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $employee->staff_id }}</td>
                                            <td style="width: 14%">
                                                {{ $employee->firstname . ' ' . $employee->lastname }}
                                            </td>

                                            <td>{{ $employee->phone }}</td>
                                            <td>{{ $employee->email }}</td>
                                            <td style="width: 19%">
                                                {{ $employee->company_id }}
                                            </td>
                                            <td>
                                                {{ $employee->department_id }}
                                            </td>
                                            <td style="width: 15%">
                                                {{ $employee->address }}
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
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
@section('script')
    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection
