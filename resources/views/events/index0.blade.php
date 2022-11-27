@extends('layouts.appfullcalendar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">EVENTS</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div id='wrap'>
                        <div id='calendar'></div>
                        <div style='clear:both'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection