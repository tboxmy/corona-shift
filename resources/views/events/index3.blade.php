@extends('layouts.appevent')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">View by Day</div>
                @csrf
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Week <span id="prevDate" onclick="prevDate()">[<<]</span><span id="currentDate">27-11</span><span id="nextDate" onclick="nextDate()">[>>]</span>
                    @include('events.departmentTablestub')
                    <hr>
                    {{-- @include('events.departmentManualTablestub') --}}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <ul>
                        <li>#1 Alex
                        <li>#2 Alice
                        <li>#3 Andy
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    Notes: Places screen notes here.
                </div>
            </div>
        </div>
    </div>
</div>
<script>    
    var today = null;
    var displayDates = null;
    var startDate = dateFns.startOfWeek(new Date());
    startDate = dateFns.startOfDay(startDate); // minus  day for demo purpose
    var workStartHour = 8;
    var workEndHour = 24;
    var totalDays = 2;
    var totalStaff = 3;
    var datesOfWeek = null;
    // var items = array(('day'=>'Mon','data'=>('id'=>1,'name'=>'Alex'),('id'=>2,'name'=>'Andy')),
    //     ('day'=>'Tue','data'=>('id'=>1,'name'=>'Alex'),('id'=>2,'name'=>'Andy'))
    // );
    var users = ["Alex","Andy","Alice","Nich"];
    var item1 = ["Sun",users];
    var item2 = ["Mon",users];    
    var item3 = ["Tue",users];
    var item4 = ["Wed",users];   
    var item5 = ["Thu",users];
    var item6 = ["Fri",users];
    var item7 = ["Sat",users];
    let items = [item1, item2, item3, item4, item5, item6, item7];
    window.onload = startup();

    function startup() {
        getDatesOfWeek();
        updateTableNav(startDate);
        getSchedule();
    }

    function getDatesOfWeek(){
        datesOfWeek = [];
        for(var i=0; i<7; i++){
            datesOfWeek[i]=dateFns.format(dateFns.addDays(startDate, i), 'dd-MM');
        }
        console.log(datesOfWeek);
    }

    function askTitle() {
        let choice = prompt("Please enter event title", "Task");
        if (choice != null) {
            // document.getElementById("demo").innerHTML =
            // "WOW " + choice + "! your choice is too good !!";
            alert("WOW " + choice + "! your choice is too good !!");
        }
    }
    function askEditEvent() {
        let choice = prompt("Lets edit the event", "EDIT EVENT");
        if (choice != null) {
            // document.getElementById("demo").innerHTML =
            // "WOW " + choice + "! your choice is too good !!";
            alert("DONE! " + choice + " is updated !!");
        }
    }
    /**
     * TODO
     */
    function getSchedule() {
        let url = "/departmentStaff";
        // var month = today.getMonth()+1;
        // var day = today.getDay();
        today = shortDate();
        console.log('schedule '+startDate);
        // let start = dateFns.startOfDay(dateFns.subDays(new Date(), 1));
        updateTableNav(startDate);
        return; 
        let messages = {
        id:1,
        title: 'Title info',
        body: 'This is the content',
        dept: 'hq',
        start: startDate,
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
                    console.log(item);
                    // addRows(item);                    
                    getShifts(item.id, startDate);
                });                       
        }).catch((error)=> {
            console.log('Post Error');
            console.log(error);
        })
    };
    function addRows_old(item){    
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
            if(i==1){
                // Example of timeoff
                cell.className = "table-info";             
                cell.innerHTML = 'AL';
            }
        }
    }
    function addHourRows(item){    
        var table0=document.getElementById('department');
        var table = table0.createTHead();
        var rowCount=table.rows.length; // 0
        var countHoursCol = 2 + (workEndHour - workStartHour);
        var countHalfHoursCol = 2 + ((workEndHour - workStartHour)*2);
        var cellCount = countHoursCol; //table.rows[0].cells.length; 
        var row=table.insertRow(rowCount++); // first row
        var th = document.createElement("TH");
        var i = 0; // first column
        
        // cell=row.insertCell(i++);
        cell = document.createElement("TH");
        cell.innerHTML = "Day";
        cell.scope = "col";
        row.appendChild(cell); i++;
        // cell=row.insertCell(i++);
        cell = document.createElement("TH");
        cell.innerHTML = "Ref";
        cell.scope = "col";
        row.appendChild(cell); i++;
        for(var j=0; i<cellCount; i++, j++){
            var cellId='headerTop'+i;
            // cell=row.insertCell(i);
            cell = document.createElement("TH");
            cell.innerHTML = workStartHour + j;
            cell.id = cellId;
            cell.colSpan = "2";
            cell.scope = "col";
            row.appendChild(cell);
        }
        cellCount = countHalfHoursCol; 
        row=table.insertRow(rowCount++); // second row
        i = 0; // first column
        cell = document.createElement("TH");
        cell.innerHTML = "Occasion";
        row.appendChild(cell); i++;  
        cell = document.createElement("TH");
        cell.innerHTML = "++";
        row.appendChild(cell); i++;
        for(var j=0; i<cellCount; i++, j++){
            var cellId='header2Top'+i;
            cell = document.createElement("TH");         
            cell.id = cellId;
            cell.scope = "col";
            cell.className = "bg-dark";
            row.appendChild(cell); 
        }
    }
    function addRows(dayOfWeek,item){    
        var table=document.getElementById('department');
        var rowCount=table.rows.length; // 0
        var cellCount=table.rows[1].cells.length;
        // var countHoursCol = 2 + (workEndHour - workStartHour);
        // var countHalfHoursCol = 2 + ((workEndHour - workStartHour)*2);
        // var cellCount = countHalfHoursCol; //table.rows[0].cells.length; 
        var row=table.insertRow(rowCount++); // first row
        var i = 0; // first column   
        cell=row.insertCell(i++);        
        cell.innerHTML = item[0]+'<br>'+datesOfWeek[dayOfWeek];
        cell.scope = "col";
        cell.rowSpan = "4";
        isFirstRow = true;
        for(var totalEmp=0; totalEmp < 4; totalEmp++){
            var id = 0;
            var cellCountMax = cellCount;
            if(totalEmp>0){                
                row=table.insertRow(rowCount++);
                cellCountMax = cellCount- 1;
                i=0;
            }
        cell=row.insertCell(i++);
        cell.innerHTML = item[1][totalEmp];
        cell.scope = "col";
        // employee row 1        
        for(var j=0; i<cellCountMax; i++, j++, id++){
            var cellId='headerTop'+id;
            cell=row.insertCell(i);            
            cell.innerHTML = "+";
            cell.id = cellId;
            cell.className = "bg-dark";
            cell.scope = "col";
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
    function updateTableNav(start=null){        
        let row=document.getElementById('currentDate');
        if(start==null){
            start = currentDate();
        }
        row.innerHTML=' ['+shortDate(start)+'] ';
        console.log('Update Table Nav');
        // create table top header
        initTableTopRow();
        // create table side header
        displayDates = new Array();
        // for(i=0; i<totalDays; i++){
        //     let itemDate = dateFns.addDays(start,i);            
        //     // itemDate.setDate(today.getDate() + i);
        //     let cellId = 'headerDate';
        //     cellId += (i+1);
        //     displayDates[i]=itemDate;
        //     console.log('>>');
        //     console.log(cellId);
        //     row=document.getElementById(cellId);
        //     row.innerHTML="Day "+(i+1)+"<br><span class='small'>"+shortDate(itemDate)+"</span>";
        //     // console.log(i+' - '+itemDate)
        // }
    }
    /**
     * TODO
     */
    function getShifts(user_id, start=null) {
        let url = "/events/getUserShifts";
        if(start==null){
            console.log('#1');
            start = currentDate();
        }
        let messages = {        
        user_id: user_id,
        startDate: start,
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
    }
    function prevDate(){
        console.log('pressed prev');
        startDate = dateFns.startOfDay(dateFns.subDays(startDate, 7));
        var cel=document.getElementById('currentDate').innerHTML;  
        cel=shortDate(startDate);
        // initTableShifts();
        getDatesOfWeek();
        getSchedule();
    }
    function nextDate(){
        startDate = dateFns.startOfDay(dateFns.addDays(startDate, 7));
        var cel=document.getElementById('currentDate').innerHTML;  
        cel=shortDate(startDate);
        // initTableShifts();
        getDatesOfWeek();
        getSchedule();
    }
    function initTableTopRow(){
        let table=document.getElementById('department');
        for(var i = 0;i<table.rows.length;){
            table.deleteRow(i);
        }
        addHourRows();
        addRows(0,items[0]);
        addRows(1,items[1]);
        addRows(2,items[2]);
        addRows(3,items[3]);
        addRows(4,items[4]);

    }
    function initTableShifts(){
        let table=document.getElementById('department');
        for(var i = 2;i<table.rows.length;){
            table.deleteRow(i);
        }
    }    
    function updateUserShiftRow(user_id,shift_name,shift_start,shift_end){
        // determine the dates to process        
        today = dateFns.startOfDay(startDate);
        let abc = new Date();
        console.log(dateFns.format(today, "yyyy-MM-dd'T'HH:mm:ss.SSSxxx"));
        for(i=0; i<7; i++){
            let itemDate = dateFns.addDays(today,i);
            cursorDate = currentDate(shift_start);
            console.log('Process = '+itemDate+' AND '+cursorDate);
            console.log('dateFns = '+dateFns.differenceInDays(itemDate, cursorDate));            
            if(itemDate.getDate() == cursorDate.getDate() ) {
                console.log('use '+cursorDate);
                let cellId=user_id+'cell'+(i+2);              
                row=document.getElementById(cellId);
                row.innerHTML=shift_name+"<br><span class='small'>["+shortTime(cursorDate)+"]</span>";
                row.className = "table-primary";
                row.removeAttribute("onclick");
                row.setAttribute("onclick","askEditEvent();");
            }
        }        
    }
</script>
@endsection