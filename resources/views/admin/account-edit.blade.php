@extends('layouts.admin')
@section('admin')

    <div class="container-fluid">

        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">EDIT ACCOUNT</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Update Form</li>
                    </ol>
                    <a href="{{ route('admin-account') }}" class="btn btn-info d-none d-lg-block m-l-15"><i
                            class="fa fa-plus-circle"></i>
                        Create New</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal form-material" method="POST"
                            action="{{ url('admin/account/update/' . $user->id) }}">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <label for="name">Username</label>
                                <input type="text" class="form-control @error('name') border-danger @enderror" id="name"
                                    name="name" value="{{ $user->name }}">
                                @error('name')
                                    <p class="text-danger"><small>{{ $message }}</small></p>
                                @enderror
                            </div>

                            <label for="email">Email</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">@</span>
                                </div>
                                <input type="email" class="form-control @error('email') border-danger @enderror" id="email"
                                    name="email" value="{{ $user->email }}">
                            </div>
                            @error('email')
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror

                            <label for="password">Passwrod</label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="password" name="password" id="password"
                                    value="Enter the password">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="far fa-eye"
                                            id="togglePassword"></i></span>
                                </div>
                                <div class="input-group-prepend">
                                    <a onclick="generate()" type="button" class="input-group-text"
                                        id="generate-pwd">Generate</a>
                                </div>
                            </div>
                            @error('password')
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                            <div class="form-group">
                                <label for="gender">Role</label>
                                <select name="role_id" id="role_id"
                                    class="form-control @error('role_id') border-danger @enderror">
                                    <option value="" disabled selected>Choose For Role</option>
                                    @foreach ($roles as $role)
                                        <option {{ $user->role->pluck('name')->contains($role->name) ? 'selected' : '' }}
                                            value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <p class="text-danger"><small>{{ $message }}</small></p>
                                @enderror
                            </div>

                            <input type="submit" value="Create" class="btn btn-success">

                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@section('javascript')
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        // Show Password  button
        togglePassword.addEventListener('click', function(e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });

        // Generate Password
        function generate() {
            var passwd = '';
            var chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            for (i = 1; i < 18; i++) {
                var c = Math.floor(Math.random() * chars.length + 1);
                passwd += chars.charAt(c)
            };
            document.getElementById('password').value = passwd;
        }
        // Click once generate
        $(function() {
            $("#generate-pwd").click();
        });
    </script>
@endsection
