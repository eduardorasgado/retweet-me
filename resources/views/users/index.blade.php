@extends('layouts.app')

@section('content')
<div class="container">
    Hello {{ $user->username}}
</div>
@endsection
