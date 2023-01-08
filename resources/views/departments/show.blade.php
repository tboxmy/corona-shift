@extends('layouts.appevent')
   
@section('content')
<div class="container">
    <div class="row">
        <div class="col "><h1>Department Details</h1>
            <p>{{$department->name}}
            <p>{{$department->code}}
            <p>{{$department->description}}
            <p>{{$department->region}}
            <p>
                @if($department->is_shift)
                YES @else NO
                @endif            
            <p>Manager: @if($department->managedBy)
               {{$department->managedBy->name}} ({{$department->managedBy->email}})
               @endif
            <p><a href="{{ url($data['back'])}}">BACK</a>
        </div>
    </div>
</div>
@endsection