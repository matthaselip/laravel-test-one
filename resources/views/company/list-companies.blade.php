@extends('adminlte::page')
@section('title', 'Companies')
@section('content_header')
    <h1>Companies</h1>
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Logo</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($companies AS $company)
                                    <tr>
                                        <td>{{ $company->name }}</td>
                                        <td>{{ $company->email }}</td>
                                        <th>{{ $company->logo}}</th>
                                        <td>
                                            <a href="{{ route('companies.show',['company' => $company->companies_id]) }}">
                                                view
                                            </a> /
                                            <a href="" data-toggle="modal" data-target="#delete-company-{{ $company->companies_id }}">
                                                delete
                                            </a> /
                                            <a href="{{ route('companies.edit',['company' => $company->companies_id]) }}">
                                                edit
                                            </a>

                                            @include('company.delete-modal')
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('companies.create') }}" class="btn btn-primary">New Company</a>
                        </div>
                        <div class="col-md-6">
                            {{ $companies->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection