<h3 class="md-0 text-primary">TODAY</h3>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Date</th>
        <th scope="col">Time</th>
        <th scope="col">Clock in/out</th>
        <th scope="col">Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach($shiftToday as $val)
        <tr>
        <th scope="row">1</th>
        <td>{{$val['date']}}</td>
        <td>{{$val['timeStart']}} - {{$val['timeEnd']}}</td>
        <td></td>
        <td>{{$val['description']}}</td>
        </tr>
        @endforeach        
    </tbody>
    </table>

    <h3 class="md-0">Upcoming</h3>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Date</th>
        <th scope="col">Time</th>        
        <th scope="col">Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach($shiftUpcoming as $val)
        <tr>
        <th scope="row">1</th>
        <td>{{$val['date']}}</td>
        <td>{{$val['timeStart']}} - {{$val['timeEnd']}}</td>
        <td>{{$val['description']}}</td>
        </tr>
        @endforeach        
    </tbody>
    </table>