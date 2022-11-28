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
        getSchedule();
    }

    function askTitle() {
        let choice = prompt("Please enter event title", "Task");
        if (choice != null) {
            // document.getElementById("demo").innerHTML =
            // "WOW " + choice + "! your choice is too good !!";
            alert("WOW " + choice + "! your choice is too good !!");
        }
    }
    function getSchedule() {
        let url = "/departmentStaff";
        // var month = today.getMonth()+1;
        // var day = today.getDay();
        today = shortDate();
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
            // console.log(response.json());
            return response.json();            
        }).then((data)=>{
            // if(res.status === 201 || res.status === 200){
                data.data.forEach(function(item){
                    // console.log(item);
                    addRows(item);
                    getShifts(item.id);
                });                       
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
            if(i==2 || i==3 || i==4 || i==5 | i==6 | i==7 | i==8){
                var namecel = document.getElementById(item.id+cellId);
                // Example of shift
                // cell.className = "table-primary";             
                // cell.innerHTML = '12Hrs<br>08:00';
                cell.setAttribute("onclick","askTitle();");
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
    function addZero(i) {
        if (i < 10) {i = "0" + i}
        return i;
    }
    function shortTime(choice=null){        
        var today = new Date();
        if(choice!=null){
            today = choice;
        }
        var hour = addZero(today.getHours());
        var minute = addZero(today.getMinutes());
        var result = hour+':'+minute;   
        return result;
    }
    function currentDate(item=null){
        var currentDateTime = new Date();
        if(item!=null){
            currentDateTime = new Date(item);
        }
        currentDateTime.toISOString().split('T')[0];
        return currentDateTime;
    }

    function updateTableNav(startDate=null){        
        let row=document.getElementById('currentDate');
        row.innerHTML=' ['+shortDate()+'] ';
        // today = currentDate();
        today = currentDate();
        
        displayDates = new Array();
        for(i=0; i<7; i++){
            let itemDate = dateFns.addDays(today,i);            
            // itemDate.setDate(today.getDate() + i);
            let cellId = 'headerDate';
            cellId += (i+1);
            displayDates[i]=itemDate;
            row=document.getElementById(cellId);
            row.innerHTML="Day "+(i+1)+"<br><span class='small'>"+shortDate(itemDate)+"</span>";
            console.log(i+' - '+itemDate)
        }
    }

    function getShifts(user_id) {
        let url = "/events/getUserShifts";
        let messages = {        
        user_id: user_id,
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
            return response.json();            
        }).then((data)=>{
            // if(res.status === 201 || res.status === 200){                
                console.log('Post success');
                data.data.forEach(function(item){
                    updateUserShiftRow(item.user_id,item.shift_name,item.shift_start,item.shift_end);
                });
                // updateUserShiftRow(user_id);
        }).catch((error)=> {
            console.log('Post Error');
            console.log(error);
        })
    };
    
    function updateUserShiftRow(user_id,shift_name,shift_start,shift_end){
        // determine the dates to process
        today = currentDate();
        today = dateFns.startOfDay(today);
        let abc = new Date();
        console.log(dateFns.format(today, "yyyy-MM-dd'T'HH:mm:ss.SSSxxx"));
        // console.log('date-fns = ' );
        for(i=0; i<7; i++){
            let itemDate = dateFns.addDays(today,i);
            // itemDate.setDate(itemDate.getDate() + i);
            cursorDate = currentDate(shift_start);
            console.log('Process = '+itemDate+' AND '+cursorDate);
            console.log('dateFns = '+dateFns.differenceInDays(itemDate, cursorDate));            
            if(itemDate.getDate() == cursorDate.getDate() ) {
                // let cellId = 'headerDate';
                // cellId += (i+1);
                console.log('use '+cursorDate);
                let cellId=user_id+'cell'+(i+2);
                // displayDates[i]=itemDate;                 
                row=document.getElementById(cellId);
                row.innerHTML=shift_name+"<br><span class='small'>["+shortTime(cursorDate)+"]</span>";
                row.className = "table-primary";
                row.removeAttribute("onclick");
                // row.addEventListener('click', (event) => {
                //     event.target.remove();
                // });
                
            }
        }        
    }
</script>
@endsection