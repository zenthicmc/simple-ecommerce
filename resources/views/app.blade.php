<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title inertia>{{ config('app.name', 'Laravel') }}</title>
		<!-- Scripts -->
		<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
		@routes
		@viteReactRefresh
		@vite('resources/js/app.jsx')
		@inertiaHead
	</head>
	<body>
		@inertia
	</body>
</html>