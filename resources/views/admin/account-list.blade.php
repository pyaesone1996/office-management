@extends('layouts.admin')


@section('admin')
    @include('admin.alert-message')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Account List</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <a href="{{ route('admin-emplyoee-createform') }}" type="button"
                        class="btn btn-info m-t-10 text-white float-right">Add New User</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="table-responsive">
                        <table id="demo-foo-addrow" class="table table-bordered m-t-30 table-hover contact-list"
                            data-paging="true" data-paging-size="7">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Joined Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            {{ $user->name }}
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span
                                                class="badge  badge-pill
        
                                            @foreach ($roles as $role)
                                            {{ $user->hasRole('Admin') ? 'badge-danger' : ($user->hasRole('Employee') ? 'badge-warning text-white' : 'badge-success text-white') }}
                                            @endforeach ">
                                                @foreach ($roles as $role)
                                                    @php $name = $role->name @endphp
                                                    {{ $user->role->pluck('name')->contains($name) ? $name : '' }}
                                                @endforeach
                                            </span>
                                        </td>
                                        <td>
                                            <p class="text-center mb-2">{{ $user->created_at->format('d-M-Y') }}</p>
                                        </td>
                                        <td>
                                            <a href="{{ url('/admin/account/edit/' . $user->id) }}"
                                                class="btn btn-success px-4 btn-sm my-1">Edit</a>
                                            <a href="{{ url('/admin/account/delete/' . $user->id) }}"
                                                class="btn btn-danger px-3 btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>



@endsection
