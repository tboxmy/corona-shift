@extends('layouts.appevent')
   
@section('content')
<div class="container">
    <div class="row">
        <div class="col ">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            @include('admin.user.userList')
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col ">
        <form id="pagingForm" method="GET" action="{{ url('/admin/users') }}">
        <input type="hidden" name="length" value="{{$data['length']??10}}">
        @if(isset($data['start']) )            
        <input type="hidden" name="start" value="{{$data['start']+$data['length']}}">
        @else
        <input type="hidden" name="start" value="{{$data['start']??0}}">
        @endif
        Prev 
        @if(($data['start']+$data['length']) <= $data['recordsTotal'])
        <input class="btn btn-primary btn-sm  waves-effect waves-light" type="submit" value="Next">
        @endif
        </form>
    </div>
    </div>
</div>
@endsection