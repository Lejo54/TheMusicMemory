@php($user = request()->user())

<header class="gv-header sticky-top" data-gv-header>
	<nav class="gv-nav container-xxl" aria-label="Navigation principale">

		{{-- Logo --}}
		<a class="gv-brand" href="{{ route('view_account') }}" aria-label="The Music Memory, accueil">
			<svg class="gv-disc" viewBox="0 0 32 32" aria-hidden="true" focusable="false">
				<circle class="gv-disc__plate" cx="16" cy="16" r="15" />
				<circle class="gv-disc__groove" cx="16" cy="16" r="11.5" />
				<circle class="gv-disc__groove" cx="16" cy="16" r="8.5" />
				<circle class="gv-disc__label" cx="16" cy="16" r="5.5" />
				<circle class="gv-disc__hole" cx="16" cy="16" r="1.4" />
				<path class="gv-disc__shine" d="M7 10a11.5 11.5 0 0 1 6.5-5" />
			</svg>
			<span>The Music Memory</span>
		</a>

		<form class="gv-search" role="search" action="#" method="get">
			<label class="visually-hidden" for="gv-q">Rechercher</label>
			<svg class="gv-search__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
				stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
				<circle cx="11" cy="11" r="7" />
				<path d="m20 20-3.5-3.5" />
			</svg>
			<input id="gv-q" name="q" type="search" class="gv-search__input"
				placeholder="Rechercher un album, un artiste…" autocomplete="off" data-gv-search>
			<kbd class="gv-kbd d-none d-md-inline" aria-hidden="true">/</kbd>
		</form>

		{{--  Utilisateur --}}
		<div class="gv-user dropdown">
			@if ($user)
				<button class="gv-user__btn dropdown-toggle" type="button"
					data-bs-toggle="dropdown" aria-expanded="false"
					aria-label="Menu du compte de {{ $user->login }}">
					<span class="gv-avatar" aria-hidden="true">{{ mb_strtoupper(mb_substr($user->login, 0, 1)) }}</span>
					<span class="gv-user__name d-none d-sm-inline">{{ $user->login }}</span>
				</button>
				<ul class="dropdown-menu dropdown-menu-end">
					<li><a class="dropdown-item" href="{{ route('view_account') }}">Ma collection</a></li>
					<li><a class="dropdown-item" href="{{ route('view_settings') }}">Paramètres</a></li>
					<li><hr class="dropdown-divider"></li>
					<li>
						{{-- Déconnexion en POST --}}
						<form method="POST" action="{{ route('user_signout') }}">
							@csrf
							<button class="dropdown-item" type="submit">Se déconnecter</button>
						</form>
					</li>
				</ul>
			@else
				<div class="d-flex gap-2">
					<a class="btn btn-outline-secondary" href="{{ route('view_signin') }}">Se connecter</a>
					<a class="btn btn-primary d-none d-sm-inline-block" href="{{ route('view_signup') }}">Créer un compte</a>
				</div>
			@endif
		</div>

	</nav>
</header>