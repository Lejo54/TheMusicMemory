@extends('layouts.mainLayout')

@section('title', 'Ma collection')

@push('head')
	<link href="{{ asset('css/carrousel.css') }}" rel="stylesheet">
@endpush

@section('content')

	<header class="mb-4">
		<h1 class="tmm-page-title">Collection de {{ request()->user()->login }}</h1>
	</header>

	<ul class="nav tmm-tabs mb-5">
		<li class="nav-item">
			<a class="nav-link active" aria-current="page" href="{{ route('view_account') }}">Albums</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{ route('view_songs') }}">Musiques</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{ route('view_wishlist') }}">Wishlist</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{ route('view_friends') }}">Amis</a>
		</li>
	</ul>

	{{-- data-img-base : dossier public/img/albums/ (les images du carrousel) --}}
	<section class="tmm-carousel" data-carousel data-img-base="{{ asset('img/albums') }}" aria-label="Carrousel d'albums">
		<div class="tmm-carousel__stage" data-stage></div>
		<div class="tmm-caption" data-caption aria-live="polite"></div>
		<div class="tmm-carousel__nav">
			<button class="btn btn-outline-secondary" type="button" data-prev aria-label="Précédent">←</button>
			<button class="btn btn-outline-secondary" type="button" data-next aria-label="Suivant">→</button>
		</div>
	</section>

@endsection

@push('scripts')
	<script src="{{ asset('js/carrousel.js') }}"></script>
@endpush