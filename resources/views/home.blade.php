@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <ol>                        
                        <li><a href="/events">Staff shift listing by Employee with CSS and JS</a>
                        <li><a href="/eventsHourly">Staff shift listing by Department with CSS and JS</a>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
