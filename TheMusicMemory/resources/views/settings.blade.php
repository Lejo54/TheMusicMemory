@extends('layouts.mainLayout')

@section('title', 'Settings')

@section('content')
	<h2>Settings</h2>

	<section class="row g-4" aria-label="Paramètres du compte">
		<div class="col-md-6">
			<div class="tmm-card h-100">
				<h2 class="tmm-card__title">Change password</h2>
				<br action="{{ route('user_changepassword') }} " method="post" class="d-flex flex-wrap gap-2">
				@csrf

				<div data-mdb-input-init class="form-outline mb-4">
					<input type="text" type="password" id="newpassword" name="newpassword" required
						class="form-control form-control-lg" />
					<label class="form-label" for="newpassword" required autofocus>New password</label>
				</div>

				<div data-mdb-input-init class="form-outline mb-4">
					<input type="password" type="password" id="confirmpassword" name="confirmpassword" required
						class="form-control form-control-lg" />
					<label class="form-label" for="confirmpassword">Comfirm new password</label>
				</div>
				<input type="submit" value="Change my password" class="btn btn-outline-secondary">
				</form>
			</div>
		</div>

		<div class="col-md-6">
			<div class="tmm-card tmm-card--danger h-100">
				<h2 class="tmm-card__title">Delete your account</h2>
				<p class="tmm-subtle">Your collection and all your data will be deleted. This action is final.</p>
				{{-- Suppression en DELETE --}}
				<form method="POST" action="{{ route('user_deleteuser') }}">
					@csrf
					@method('DELETE')
					<button class="btn btn-outline-danger" type="submit"
						data-confirm="Supprimer définitivement ton compte ?">Delete my account</button>
				</form>
			</div>
		</div>
	</section>
@endsection