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
                    [<<]<span id="currentDate"></span>[>>]
                    @include('events.tablestub')
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.onload = startup();
    var today = null;
    var displayDates = null;

    function startup() {
        let url = "/departmentStaff";
        // var month = today.getMonth()+1;
        // var day = today.getDay();
        today = shortDate();
        console.log(today);
        updateTableNav(); 
        let messages = {
        id:1,
        title: 'Title info',
        body: 'This is the content',
        dept: 'hq',
        }
        let data = JSON.stringify(messages);
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
                data.data.forEach(function(item){
                    // console.log(item);                    
                    console.log(item.name);
                    addRows(item);
                });
                console.log(data);                
        }).catch((error)=> {
            console.log('Post Error');
            console.log(error);
        })
    };

    function addRows(item){    
        var table=document.getElementById('employee');
        var rowCount=table.rows.length;
        var cellCount=table.rows[0].cells.length;
        var row=table.insertRow(rowCount++);
        console.log('process item.');
        for(var i=0; i<cellCount; i++){
            var cellId='cell'+i;
            cell=row.insertCell(i);
            // var copycel=document.getElementById('col'+i).innerHTML;
            var copycel=document.getElementById('col'+i).innerHTML;          
            cell.innerHTML=copycel;
            cell.id = item.id+cellId;
            if(i==0){
                var namecel = document.getElementById(item.id+'cell0');
                namecel.innerHTML = item.name;
                namecel.className = "border";
                namecel.rowSpan = "2";
            }
            if(i==2 || i==3){
                // Example of shift
                cell.className = "table-primary";             
                cell.innerHTML = '12Hrs<br>08:00';
            }
        }
        var startRow = i;
        // console.log(rowCount); 
        var row2=table.insertRow(rowCount);
        var cellCount2=cellCount-1;
        for(var i=0; i<cellCount2; i++){            
            var cellId='cell'+ (i+startRow);
            cell=row2.insertCell(i);            
            var copycel=document.getElementById('col'+ (i+startRow)).innerHTML;
            // cell.innerHTML=copycel;
            cell.id = item.id+cellId;
            if(i==3){
                // Example of timeoff
                cell.className = "table-info";             
                cell.innerHTML = 'AL';
            }
        }
    }

    function shortDate(choice=null){        
        var today = new Date();
        if(choice!=null){
            today = choice;
        }
        today.toISOString().split('T')[0];
        var month = today.getMonth()+1;
        var day = today.getDate();
        var result = day+'-'+month;   
        return result;
    }
    function currentDate(){
        var currentDateTime = new Date();
        currentDateTime.toISOString().split('T')[0];
        return currentDateTime;
    }

    function updateTableNav(startDate=null){        
        let row=document.getElementById('currentDate');
        row.innerHTML=' ['+shortDate()+'] ';
        today = currentDate();
        displayDates = new Array();
        for(i=0; i<7; i++){
            let itemDate = today;
            itemDate.setDate(itemDate.getDate() + i);
            let cellId = 'headerDate';
            cellId += (i+1);
            displayDates[i]=itemDate;
            row=document.getElementById(cellId);
            row.innerHTML="Day "+(i+1)+"<br><span class='small'>"+shortDate(itemDate)+"</span>";
        }
    }
</script>
@endsection