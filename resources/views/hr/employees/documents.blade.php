@extends('layouts.app')

@section('content')

<div class="container" id="employee_container">
    <div class="row">
        <div class="col-md-12">
            <br>
            @include('hr.employees.menu')
            <br>
        </div>
        <div class="col-md-12">
            @include('status', ['errors' => $errors->all()])
        </div>
        <div class="col-md-12 mb-3">
            <div class="row d-flex align-items-center">
                <div class="col-md-3">
                    <h3 class="mb-0">{{ $employee->name }}</h3>
                </div>
                <div class="col-md-9">
                    <h4 class="mb-0">Documents</h4>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    @include('hr.employees.sidebar')
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>something</h4>
                                </div>
                                <div class="card-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime odio quidem praesentium animi quasi perferendis, culpa amet non iure optio provident perspiciatis! Iure excepturi consequatur aut eveniet impedit nesciunt pariatur.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
