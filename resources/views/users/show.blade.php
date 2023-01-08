@extends('layouts.appevent')
   
@section('content')
<div class="container">
    <div class="row">
        <div class="col "><h1>User Details</h1>
            <p>{{$profile->user->name}}
            <p>{{$profile->user->email}}
            <p>{{$profile->role}}
            <p>{{$profile->hourly_rate}} ({{$profile->currency}})
            <p>{{$profile->description}}
            <p>
                @foreach($profile->departments as $dept)
                <p>{{$dept->name}} ({{$dept->code}})
                @endforeach
            <p><a href="{{ url($data['back'])}}">BACK</a>
        </div>
    </div>
</div>
@endsection