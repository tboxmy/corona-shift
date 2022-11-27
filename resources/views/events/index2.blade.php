@extends('layouts.appevent')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">EVENTS</div>
                @csrf
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @include('events.tablestub')
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.onload = startup();
    
    function startup() {
        var url = "/events/getShifts";        
        let messages = {
        id:1,
        title: 'Title info',
        body: 'This is the content'
        }
        var data = JSON.stringify(messages);
        fetch(url, {            
            method: 'post',
            body: data,
            headers:{
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).then((response)=> {
            console.log('Received response');            
            // console.log(response.json());
            return response.json();            
        }).then((data)=>{
            // if(res.status === 201 || res.status === 200){                
                console.log('Post success');
                console.log(data);
                addRows();
        }).catch((error)=> {
            console.log('Post Error');
            console.log(error);
        })
    };

    function addRows(){
        var table=document.getElementById('employee');
        var rowCount=table.rows.length;
        var cellCount=table.rows[0].cells.length;
        var row=table.insertRow(rowCount++);
        console.log(rowCount);
        for(var i=0; i<cellCount; i++){
            var cell='cell'+i;
            cell=row.insertCell(i);
            var copycel=document.getElementById('col'+i).innerHTML;
            cell.innerHTML=copycel;
        }
        var startRow = i-1;
        console.log(rowCount); 
        var row2=table.insertRow(rowCount);
        var cellCount2=cellCount-1;
        for(var i=0; i<=cellCount2; i++){            
            var cell='cell'+ (i+startRow);
            cell=row2.insertCell(i);
            console.log( i+startRow);
            var copycel=document.getElementById('col'+ (i+startRow)).innerHTML;
            cell.innerHTML=copycel;
        }
    }
</script>
@endsection