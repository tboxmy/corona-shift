<div class="row mb-2">
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-100 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          
          <h3 id="shift_today_date" class="mb-0 text-primary">{{$shiftToday[0]['date']??'TODAY'}}</h3>
          @if(count($shiftToday)>0)
          <div id="shift_today_department" class="mb-1 text-muted">Department ...</div>
          @foreach($shiftToday as $row)
          <p id="shift_today_time" class="card-text mb-auto">{{$row['timeStart']}} to {{$row['timeEnd']}}</p>
          @endForeach
          @endif
        </div>
        <div class="col-auto d-none d-lg-block">
          <svg class="bd-placeholder-img" width="200" height="150" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Schedule for today" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="10%" y="50%" fill="#eceeef" dy=".3em">Schedule for today</text></svg>

        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-100 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          @if(count($shiftUpcoming)>0)
          <h3 class="mb-0">{{$shiftUpcoming[0]['date']}}</h3>
          <div id="shift_today_department" class="mb-1 text-muted">Department ...</div>
          @foreach($shiftUpcoming as $row)
          <p id="shift_today_time" class="card-text mb-auto">{{$row['timeStart']}} to {{$row['timeEnd']}}</p>
          @endForeach
          @endif
        </div>
        <div class="col-auto d-none d-lg-block">
          <svg class="bd-placeholder-img" width="200" height="150" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="10%" y="50%" fill="#eceeef" dy=".3em">Upcoming</text></svg>

        </div>
      </div>
    </div>
  </div>