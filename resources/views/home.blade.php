@extends('layouts.app')

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
    </div>
    @include('widgets.featuresList')
    
</div>
@endsection
