@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Login Status
                </div>
                <div class="panel-body">
                    <p>You are logged in!</p>
                    <p>Hier gehts zu deinem <a href="{{route('timetable')}}">Stundenplan</a>. </p>
                    <p>Wenn dir der standardmässig eingestellten Stundenplan nicht gefällt, so kannst ihn unter <a href="{{route('configuration')}}">Einstellungen</a> ändern.</p>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    So kannst du Beitragen
                </div>
                <div class="panel-body">
                    Schreibe an <a href="mailto:vonaj2@bfh.ch?subject=Beitrag zu BFH Cockpit&body=Hallo Joel, so möchte ich beitragen:">Joel von Allmen</a>
                </div>
            </div>

            @if (auth()->user()->isAdmin())
            <div class="panel panel-default">
                <div class="panel-heading">Tools</div>

                <div class="panel-body">
                    <a href="{{ route('webservice.fetch') }}?api_token={{ Auth::user()->api_token }}"
                       class="btn btn-primary">Fetch all Classes from Webservice</a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
