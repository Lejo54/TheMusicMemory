@extends('layouts.mainLayout')

@section('title', 'Parametres')

@section('content')
	<h2>Paramètres</h2>

	<section class="row g-4" aria-label="Paramètres du compte">
		<div class="col-md-6">
			<div class="tmm-card h-100">
				<h2 class="tmm-card__title">Changer le mot de passe</h2>
				<br action="{{ route('user_changepassword') }} " method="post" class="d-flex flex-wrap gap-2">
				@csrf
				<label for="newpassword">Nouveau mot de passe</label> <input type="password" id="newpassword"
					name="newpassword" required></br>
				<label for="confirmpassword">Confirmer le mot de passe</label><input type="password" id="confirmpassword"
					name="confirmpassword" required></br>
				<input type="submit" value="Change my password" class="btn btn-outline-secondary">
				</form>
			</div>
		</div>

		<div class="col-md-6">
			<div class="tmm-card tmm-card--danger h-100">
				<h2 class="tmm-card__title">Supprimer mon compte</h2>
				<p class="tmm-subtle">Ta collection et tes données seront effacées. Cette action est définitive.</p>
				{{-- Suppression en DELETE --}}
				<form method="POST" action="{{ route('user_deleteuser') }}">
					@csrf
					@method('DELETE')
					<button class="btn btn-outline-danger" type="submit"
						data-confirm="Supprimer définitivement ton compte ?">Supprimer mon compte</button>
				</form>
			</div>
		</div>
	</section>
@endsection