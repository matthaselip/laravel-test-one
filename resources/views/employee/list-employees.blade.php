@extends('adminlte::page')
@section('title', 'Companies')
@section('content_header')
    <h1>Employees</h1>
@stop

@section('content')
    @include('layouts.error-success')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="customers-list" class="table">
                                <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Company</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                    @foreach($employees AS $employee)

                                        <tr>
                                            <td>{{ $employee->first_name }}</td>
                                            <td>{{ $employee->last_name }}</td>
                                            <td>{{ $employee->Company->name }}</td>
                                            <td>{{ $employee->email }}</td>
                                            <td>{{ $employee->phone }}</td>
                                            <td>
                                                <a href="{{ route('employees.show',['employee' => $employee->employees_id]) }}">
                                                    view
                                                </a> /
                                                <a href="" data-toggle="modal" data-target="#delete-employee-{{ $employee->employees_id }}">
                                                    delete
                                                </a> /
                                                <a href="{{ route('employees.edit',['employee' => $employee->employees_id]) }}">
                                                    edit
                                                </a>

                                                @include('employee.delete-modal')
                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <a class="btn btn-primary" href="{{ route('employees.create') }}">New Employee</a>
                            </div>
                            <div class="col-md-6">
                                {{ $employees->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection