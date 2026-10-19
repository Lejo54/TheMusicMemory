@extends('layouts.mainLayout')

@section('title','Account')

@section('content')
	<p>
		Hello {{ request()->user()->login  }} !<br>
		Welcome on your account.
	</p>
	<ul>
		<li><a href="{{ route('view_formpassword') }}">Change password.</a></li>
		<li><a href="{{ route('user_deleteuser') }}">Delete my account.</a></li>
	</ul>
	<p><a href="signout">Sign out</a></p>
@endsection
