<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Company Name</th>
            <th>Department Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Staff Id</th>
            <th>Address</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employees as $key => $employee)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $employee->firstname }}</td>
                <td>{{ $employee->lastname }}</td>
                <td>
                    @foreach ($companies as $company)
                        {{ $employee->company_id == $company->id ? $company->company_name : '' }}
                    @endforeach
                </td>
                <td>
                    @foreach ($departments as $dept)
                        {{ $employee->department_id == $dept->id ? $dept->department_name : '' }}
                    @endforeach
                </td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->phone }}</td>
                <td>{{ $employee->staff_id }}</td>
                <td>{{ $employee->address }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
