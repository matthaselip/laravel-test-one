@extends('adminlte::page')
@section('title', 'Companies')
@section('content_header')
    <h1>View Company</h1>
@stop

@section('content')
    @include('layouts.error-success')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h2>Company #{{ $company->companies_id }}</h2>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">Name: {{ $company->name }}</li>
                            <li class="list-group-item">Email: {{ $company->email }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                @if(!is_null($company->logo))
                    <div class="card">
                        <div class="card-body">
                            <img style="max-width: 400px; max-height: 400px" src="{{ asset('storage/'.$company->logo) }}" />
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @if($company->Employees()->exists())
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h2>Employees</h2>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach($company->Employees()->get() AS $employee)
                                    <li class="list-group-item">{{ $employee->first_name }} {{ $employee->last_name }} - {{ $employee->email }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection