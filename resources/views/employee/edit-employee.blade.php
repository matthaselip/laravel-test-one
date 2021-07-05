@extends('adminlte::page')
@section('title', 'Companies')
@section('content_header')
    <h1>Edit Employee {{ $employee->employees_id }}</h1>
@stop

@section('content')
    @include('layouts.error-success')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('employees.update',['employee' => $employee->employees_id]) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            @include('employee.form')
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection