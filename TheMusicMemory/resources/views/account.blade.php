@extends('layouts.mainLayout')

@section('title', 'Ma collection')

@section('content')

	<header class="mb-4">
		<h1 class="gv-page-title">Collection de {{ request()->user()->login }}</h1>
		<p class="gv-subtle mb-0">Tes albums, tes musiques, ta wishlist et tes amis.</p>
	</header>

	<ul class="nav gv-tabs mb-5">
		<li class="nav-item">
			<a class="nav-link active" aria-current="page" href="#">Albums</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#">Musiques</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#">Wishlist</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#">Amis</a>
		</li>
	</ul>

@endsection