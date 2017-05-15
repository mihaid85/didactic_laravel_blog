
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	<head>
		@include('partials.head')
	</head>
	<body>
		@include('partials.nav')
		
		<div  class="container">
			<div class="row">
				<div class="ad-wrapper wrapper col-xs-12">
					<div id="ad">
						Ads Responsive
					</div>
				</div>
			</div>
		</div>
		<div class="container container1">
			
			@include('partials.messages')

			@yield('content')
			
		</div>
		<div  class="container">
			<div class="row">
				<div class="ad-wrapper wrapper col-xs-12">
					<div id="ad2">
						Ads Responsive
					</div>
				</div>
			</div>
		</div>
		
		@include('partials.footer')
		@include('partials.javascripts')
		@yield('scripts')
	</body>
</html>