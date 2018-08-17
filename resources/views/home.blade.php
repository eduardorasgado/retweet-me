@extends('layouts.app')

@section('content')
<div class="container">
    <div id="root"></div>
    <hr>
    <h2>Following</h2>

    @if(sizeof($following) > 0)
        @foreach($following as $user)
            <a href="{{ route('users', $user) }}">{{ $user->username }}</a>
        @endforeach
    @else
        <p>You are not following anybody.</p>
    @endif
</div>
@endsection
