@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mb-4 mt-4">
            <div class="card-header">
                Login Status
            </div>
            <div class="card-body">
                <p>You are logged in!</p>
                <p>Hier gehts zu deinem <a href="{{route('timetable')}}">Stundenplan</a>. </p>
                <p>Wenn dir der standardmässig eingestellten Stundenplan nicht gefällt, so kannst ihn unter <a
                            href="{{route('configuration')}}">Einstellungen</a> ändern.</p>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                So kannst du Beitragen
            </div>
            <div class="card-body">
                Schreibe an <a
                        href="mailto:vonaj2@bfh.ch?subject=Beitrag zu BFH Cockpit&body=Hallo Joel, so möchte ich beitragen:">Joel
                    von Allmen</a>
            </div>
        </div>

        @if (auth()->user()->isAdmin())
            <div class="card mb-4">
                <div class="card-header">Tools</div>

                <div class="card-body">
                    <a href="{{ route('webservice.fetch') }}?api_token={{ Auth::user()->api_token }}"
                       class="btn btn-primary">Fetch all Classes from Webservice</a>
                </div>
            </div>
        @endif
    </div>
@endsection
