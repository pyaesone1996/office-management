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
                        <h2 class="text-center">Company List</h2>
                        {{ $companies->links() }}
                        <div class="table-responsive">
                            <table id="demo-foo-addrow" class="table table-bordered m-t-30 table-hover contact-list"
                                data-paging="true" data-paging-size="7">
                                <thead>
                                    <tr style="text-align:center;vertical-align:middle;">
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Departments</th>
                                        <th>Address</th>
                                        <th>Starting Date</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    @foreach ($companies as $key => $company)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td style="width: 14%">
                                                {{ $company->company_name }}
                                            </td>
                                            <td>{{ $company->email }}</td>
                                            <td style="width: 19%">
                                                @foreach ($company->departments as $com_dept)
                                                    @foreach ($departments as $dept)
                                                        <p>
                                                            {{ $dept->id == $com_dept->id ? $dept->department_name . ' , ' : '' }}
                                                        </p>
                                                    @endforeach
                                                @endforeach
                                            </td>
                                            <td>
                                                <p class="text-center mb-2">{{ $company->address }}</p>
                                            </td>
                                            <td style="width: 15%">
                                                {{ $company->created_at->format('d-M-Y') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $companies->links() }}
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
