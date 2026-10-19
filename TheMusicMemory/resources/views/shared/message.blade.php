@if( session('message'))
	<section>
		<p>{{ session('message') }}</p>
	</section>
@endif
