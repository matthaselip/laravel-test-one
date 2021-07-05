@extends('adminlte::page')
@section('title', 'Companies')
@section('content_header')
    <h1>View Employee</h1>
@stop

@section('content')
    @include('layouts.error-success')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Employee #{{ $employee->employees_id }}</h2>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">First Name: {{ $employee->first_name }}</li>
                            <li class="list-group-item">Last Name: {{ $employee->last_name }}</li>
                            <li class="list-group-item">Company: {{ $employee->Company->name }}</li>
                            <li class="list-group-item">Email: {{ $employee->email }}</li>
                            <li class="list-group-item">Phone: {{ $employee->phone }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection