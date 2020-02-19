<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'AkisitoNoma') }}</title>

        <!-- Fonts -->

		<script src="{{ asset('js/app.js') }}" defer></script>

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600|Lobster" rel="stylesheet">
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Styles -->
        <style>
        </style>

		<link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
    </head>
    <body class='view__welcome' style='background-image: url({{ asset("/storage/uploads/assets/chefbg2.jpg") }})'>
		<div id='app'>
			<welcome-page-menu :order="{{ json_encode($order) }}" :menu="{{ json_encode($menu) }}" :items="{{ json_encode($menu->items ?? null) }}" />
		</div>
		</main>
    </body>
</html>
