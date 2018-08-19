@extends('layouts.app')

@section('content')
<div class="container">
		<a href="{{ URL::previous() != url()->current() ? URL::previous() : "/" }}" class="btn">Back</a>
		<br>
		<br>
		<img src="{{ $user->avatar }}" 
                    alt="{{ $user->username }}" height="80px">
	  <!--Remember: this user comes from UserController in index methods-->
    <h1 class="text-primary">{{ $user->username }}</h1>
    <hr>

    @if(Auth::user()->isNotTheUser($user))
    	@if(Auth::user()->isFollowing($user))
    		<a href="{{ route('users.unfollow', $user) }}" class="btn btn-secondary">Unfollow</a>
    	@else
    		<a href="{{ route('users.follow', $user) }}" class="btn btn-success">Follow</a>
    	@endif
    @endif
    <br><br>

    @foreach($user->posts as $post)
    	<div class="jumbotron">
    		<div class="lead">{{ $post->body }}</div>
    		<div class="text-muted">{{ $post->created_at }}</div>
    	</div>
    	<hr>
    @endforeach
</div>
@endsection
