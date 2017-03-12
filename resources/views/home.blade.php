@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
            @if (Auth::id() === 1)
            <div class="panel panel-default">
                <div class="panel-heading">Tools</div>

                <div class="panel-body">
                    <ul>
                        <li>
                            <a href="{{ url('/api/v0/webservice_fetch') }}?api_token={{ Auth::user()->api_token }}">Fetch from Webservice</a>
                        </li>
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
