@extends('layouts.appevent')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    You are Admin. Here are the base functions.
                    <ul>
                        <li>User Management : <a href="{{url('/admin/users')}}">Listing</a>
                        <li>Shift Management : <a href="{{url('/shiftTypes')}}">Shift Types</a>,
                        <a href="{{url('/timeoffTypes')}}">Timeoff Types</a>
                        <li>Department Management : <a href="{{url('/admin/departments')}}">Listing</a>
                        <li>System Configuration
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection