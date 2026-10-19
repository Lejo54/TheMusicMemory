<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>@yield('title')</title>
	</head>
	<body>
		@section('content')
		@show

		@include('shared.message')
	</body>
</html>
