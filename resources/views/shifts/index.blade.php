@extends('layouts.appevent')
   
@section('content')
<div class="container">
    <div class="row">
    <div class="col">
            <div class="card">
                <div class="card-header">Shift listing by Employee</div>
                @csrf
                <div class="card-body">
                <div class="row">
    
                    <div class="col ">
                        @foreach($shift_list['data'] as  $item)
                        {{$users[$item->pivot->user_id]}} - {{ $item->name}}- {{ $item->start}} - {{ $item->end}} <br>
                    @endforeach
                    </div></div>
                    <div class="row">
                    <div class="col ">
                    @isset($data)
                        <form id="pagingForm" method="GET" action="{{ url('/shiftTypes') }}">
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
                    @endisset
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
</div>
@endsection