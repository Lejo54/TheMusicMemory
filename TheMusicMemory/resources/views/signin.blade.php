@extends('layouts.mainLayout')

@section('title', 'Signin')

@section('content')

	<div class="container h-100">
		<div class="row d-flex justify-content-center align-items-center h-100">
			<div class="col-12 col-md-9 col-lg-7 col-xl-6">
				<div class="card" style="border-radius: 15px;">
					<div class="card-body p-5">
						<h1 class="text-center mb-5">Login</h1>

						<form action="{{ route('user_authenticate') }}" method="post">
							@csrf
							<div data-mdb-input-init class="form-outline mb-4">
								<input type="text" id="login" name="login" class="form-control form-control-lg" />
								<label class="form-label" for="login" required autofocus>Login</label>
							</div>

							<div data-mdb-input-init class="form-outline mb-4">
								<input type="password" id="password" name="password" class="form-control form-control-lg"
									required />
								<label class="form-label" for="password">Password</label>
							</div>
							<div class="d-flex justify-content-center">
								<button type="submit" data-mdb-button-init data-mdb-ripple-init
									class="btn btn-primary  btn-lg ">Connect</button>
							</div>
							<p class="text-center text-muted mt-5 mb-0">Have already an account? <a
									href="{{ route('view_signup') }}" class="fw-bold text-body"><u>Login
										here</u></a></p>

						</form>

					</div>
				</div>
			</div>
		</div>
	</div>

@endsection