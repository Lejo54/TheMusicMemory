<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title', 'Accueil') – The Music Memory</title>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600&family=Syne:wght@700;800&display=swap" rel="stylesheet">

	{{-- Bootstrap + feuille de style surcharge --}}
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
	<a class="visually-hidden-focusable" href="#contenu">Aller au contenu</a>

	{{-- Fixe sur toutes les pages --}}
	@include('shared.navbar')

	{{-- Seule cette zone change d'une page à l'autre --}}
	<main id="contenu" class="gv-main container-xxl">
		@yield('content')
	</main>

	@include('shared.message')

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
	<script src="{{ asset('js/app.js') }}"></script>
</body>

</html>