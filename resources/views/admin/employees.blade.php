@extends('layouts.admin')
@section('admin')
    @include('admin.alert-message')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Employee Registration Form</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <a href="{{ route('admin-emplyoee') }}" class="btn btn-info d-none d-lg-block m-l-15"><i
                            class="fa fa-plus-circle"></i>
                        Employee List</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{ route('admin-create-emplyoee') }}" method="POST">
                        @csrf
                        <input type="hidden" name="role_id" value="2">
                        <div class="card-body">
                            <div class="row pt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label @error('firstname') border-danger @enderror">First
                                            Name</label>
                                        <input type="text" id="firstname" class="form-control" placeholder="First Name"
                                            name="firstname">
                                        @error('firstname')
                                            <p class="text-danger"><small>{{ $message }}</small></p>
                                        @enderror
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Last Name</label>
                                        <input type="text" id="lastname"
                                            class="form-control @error('lastname') border-danger @enderror"
                                            placeholder="Last Name" name="lastname">
                                        @error('lastname')
                                            <p class="text-danger"><small>{{ $message }}</small></p>
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
                                            id="company_id" name="company_id" onchange="giveSelection(this.value)">
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
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
                                            data-placeholder="Choose a Category" tabindex="1" name="department_id"
                                            id="sel2">
                                            @foreach ($companies as $company)
                                                @foreach ($company->departments as $department)
                                                    <option value="{{ $department->id }}"
                                                        data-option="{{ $company->id }}">
                                                        {{ $department->department_name }}
                                                    </option>
                                                @endforeach
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
                                        <label class="control-label" for="email">Email</label>
                                        <input type="email" id="email" name="email"
                                            class="form-control @error('email') border-danger @enderror">
                                    </div>
                                    @error('email')
                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="phone">Phone</label>
                                        <input type="tel" id="phone" name="phone"
                                            class="form-control @error('phone') border-danger @enderror">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="address">Address</label>
                                        <input type="text" id="address" name="address"
                                            class="form-control @error('address') border-danger @enderror">
                                    </div>
                                    @error('address')
                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Staff Id</label>
                                        <div class="input-group mb-3">
                                            <input class="form-control @error('staff_id') border-danger @enderror"
                                                type="text" name="staff_id" id="staff_id">
                                            <div class="input-group-prepend">
                                                <a onclick="generate()" type="button" class="input-group-text"
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
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                <button type="button" class="btn btn-dark">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('javascript')
    <script>
        var company = document.querySelector('#company_id');
        var sel2 = document.querySelector('#sel2');
        var options2 = sel2.querySelectorAll('option');

        function giveSelection(selValue) {
            sel2.innerHTML = '';
            for (var i = 0; i < options2.length; i++) {
                if (options2[i].dataset.option === selValue) {
                    sel2.appendChild(options2[i]);
                }
            }
        }
        giveSelection(company.value);

        const password = document.querySelector('#staff_id');

        // Generate Password
        function generate() {
            var passwd = '';
            var chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            for (i = 1; i < 5; i++) {
                var c = Math.floor(Math.random() * chars.length + 1);
                passwd += chars.charAt(c)
            };
            document.getElementById('staff_id').value = passwd;
        }
        // Click once generate
        $(function() {
            $("#generate-pwd").click();
        });
    </script>

@endsection
