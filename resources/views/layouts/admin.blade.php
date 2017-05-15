
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	<head>
		@include('partials.head')
	</head>
	<body>
		@include('partials.nav')
		
		
		<div class="container container1">
			
			@include('partials.messages')

			@yield('content')
			
		</div>
		
		
		@include('partials.javascripts')
		@yield('scripts')
	</body>
</html>