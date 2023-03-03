@extends('layouts.appevent')

@section('content')
<div class="container">
    <div class="row justify-content-center visually-hidden" >
        <div class="col ">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
    @include('widgets.todayRow')
    @include('widgets.defaultList')

    </div>
    <div class="row">
        <div class="col-3 ">
            <input id="datepicker" width="276" />
        </div>
        <div class="col ">
            <p id="userShifts">display shift for selected date.</p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col ">
        @if($user->userProfile->role == 'planner')
        @include('widgets.featuresList')
        @endif
        </div>
    </div>
    
</div>
<script>
    $}('#datepicker').datepicker({
        uiLibrary: 'bootstrap5',
        format: 'dd/mm/yyyy',
    }).on("change",function(){
        getScheduleByDate();
    });

    function getScheduleByDate() {
        let url = "/userShiftByDate";        
        var startDate = $("#datepicker").val();
        let messages = {        
        start: startDate,
        }
        let data = JSON.stringify(messages);
        let element = document.getElementById("userShifts");
        fetch(url, {            
            method: 'post',
            body: data,
            headers:{
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).then((response)=> {       
            // console.log(response.json());
            return response.json();            
        }).then((data)=>{
            // if(res.status === 201 || res.status === 200){
            strContent = "";
            data.data.forEach(function(item){
                console.log(item);
                strContent = strContent + "<p>" + item.department_code + ": " + item.start 
                + " - " + item.end + "<p>";
            });
            element.innerHTML = strContent;
            
        }).catch((error)=> {
            console.log('Post Error');
            console.log(error);
        })
    };
</script>
@endsection
