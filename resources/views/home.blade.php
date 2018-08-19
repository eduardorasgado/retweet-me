@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">

            <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->username }}">

            <h2>Following</h2>

            @if(sizeof($following) > 0)
                @foreach($following as $user)
                    <p><a href="{{ route('users', $user) }}" class="btn btn-primary">{{ $user->username }}</a></p>
                @endforeach
            @else
                <p>You are not following anybody.</p>
            @endif

            <h2>Followers</h2>

            @if(sizeof($followers) > 0)
                @foreach($followers as $user)
                    <p><a href="{{ route('users', $user) }}" class="btn btn-success">{{ $user->username }}</a></p>
                @endforeach
            @else
                <p>No body is following yet.</p>
            @endif
        </div>   
    
        <div class="col-md-10">
            <div id="root"></div>
        </div>
    </div>
</div>
@endsection
