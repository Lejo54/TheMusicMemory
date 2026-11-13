@extends('layouts.mainLayout')

@section('title', 'Signup')

@section('content')

	<div class="container h-100">
		<div class="row d-flex justify-content-center align-items-center h-100">
			<div class="col-12 col-md-9 col-lg-7 col-xl-6">
				<div class="card" style="border-radius: 15px;">
					<div class="card-body p-5">
						<h1 class="text-center mb-5">Create an account</h1>

						<form action="{{ route('user_adduser') }}" method="post">
							@csrf
							<div data-mdb-input-init class="form-outline mb-4">
								<input type="text" id="login" name="login" required autofocus
									class="form-control form-control-lg" />
								<label class="form-label" for="login">Login</label>
							</div>

							<div data-mdb-input-init class="form-outline mb-4">
								<input type="password" id="password" name="password" required
									class="form-control form-control-lg" />
								<label class="form-label" for="password">Password</label>
							</div>

							<div data-mdb-input-init class="form-outline mb-4">
								<input type="password" id="confirm" name="confirm" required
									class="form-control form-control-lg" />
								<label class="form-label" for="confirm">Repeat your password</label>
							</div>

							<div class="form-check d-flex justify-content-center mb-5">
								<input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" />
								<label class="form-check-label" for="form2Example3g">
									I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
								</label>
							</div>

							<div class="d-flex justify-content-center">
								<button type="submit" data-mdb-button-init data-mdb-ripple-init
									class="btn btn-primary  btn-lg ">Register</button>
							</div>

							<p class="text-center text-muted mt-5 mb-0">Have already an account? <a
									href="{{ route('view_signin') }}" class="fw-bold text-body"><u>Login
										here</u></a></p>

						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
@endsection