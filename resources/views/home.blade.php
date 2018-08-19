@extends('layouts.app')

@section('content')
<div class="col-md-12" style="background-color: white; padding: 10px: margin-top:-24px;">
    <div class="row">
        <div class="col-md-4">

            <img src="{{ Auth::user()->avatar }}" 
                    alt="{{ Auth::user()->username }}" height="80px">
            <hr>
            <h2 class="text-primary">{{ Auth::user()->username }}</h2>
        </div>

        <div class="col-md-4">

            <h2>Following</h2>

            @if(sizeof($following) > 0)
                @foreach($following as $user)
                    <p><a href="{{ route('users', $user) }}" class="btn btn-outline-primary">{{ $user->username }}</a></p>
                @endforeach
            @else
                <p>You are not following anybody.</p>
            @endif
        </div>

        <div class="col-md-4">

            <h2>Followers</h2>

            @if(sizeof($followers) > 0)
                @foreach($followers as $user)
                    <p><a href="{{ route('users', $user) }}" class="btn btn-outline-success">{{ $user->username }}</a></p>
                @endforeach
            @else
                <p>No body is following yet.</p>
            @endif
        </div>
    </div>
</div>

<div class="col-md-12">
    <div id="root"></div>
</div>
@endsection
