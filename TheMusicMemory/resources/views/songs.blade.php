@extends('layouts.mainLayout')

@section('title', 'Mes Musiques')

@section('content')

    <header class="mb-4">
        <h1 class="tmm-page-title">Collection de {{ request()->user()->login }}</h1>
    </header>

    <ul class="nav tmm-tabs mb-5">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('view_account') }}">Albums</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('view_songs') }}">Musiques</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('view_wishlist') }}">Wishlist</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('view_friends') }}">Amis</a>
        </li>
    </ul>

@endsection