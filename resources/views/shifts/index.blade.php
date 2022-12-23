@extends('layouts.appevent')
   
@section('content')
<div class="container">
    <div class="row">
        @include('shifts.popupAddShift')
    <div class="col">
            <div class="card">
              <div class="card-header">Shift listing by Employee</div>
                @csrf
              <div class="card-body">
                <div class="row">
                    <div class="col">
                        Department: 
                    </div>
                    <div class="col">
                        <input id="datepicker" width="276" />
                    </div>
                    <div class="col">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#popupAddShift">
                    Add shift
                    </button>
                    </div>
                </div>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Shift (break mins)</th>
                        <th scope="col">Start</th>
                        <th scope="col">End</th>
                        <th scope="col">Publish/Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($shift_list['data'] as  $item)
                        <tr>
                            <th scope="row">{{ $item->id}}</th>
                            <td>{{$users[$item->pivot->user_id]}}</td>
                            <td>{{ $item->name}} - ({{json_decode($item->options)->breaks}} mins)</td> 
                            <td>{{ $item->start}}</td>
                            <td>{{ $item->end}}</td>
                            <td><form class="form-inline">
                                @isset($item->published_at)
                                {{$item->published_at}}
                                @else
                                <button type="submit" class="btn btn-primary mb-2">Publish</button>
                                <button type="submit" class="btn btn-danger mb-2" disabled>Delete</button>
                                @endisset                                
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

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
    
</div>
<script>
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap5',
        format: 'dd/mm/yyyy',
    }).on("change",function(){
        getScheduleByDate();
    });

</script>
@endsection