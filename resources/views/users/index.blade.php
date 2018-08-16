@extends('layouts.app')

@section('content')
<div class="container">
    {{ $user->username }}
    <hr>
    
    @if(Auth::user()->isNotTheUser($user))
    	@if(Auth::user()->isFollowing($user))
    		<button><a href="">unfollow</a></button>
    	@else
    		<button><a href="">follow</a></button>
    	@endif
    @endif
</div>
@endsection
