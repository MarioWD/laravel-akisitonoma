<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
			<div class='container-fluid'>
				<div class='row'>
					<div class='col-md-4 admin-dashboard'>
						<div id='accordion'>
							<div class='card'>
								<div class='card-header'>
									<a href='{{ route('items.index') }}' class='text-dark text-decoration-none'>
										<div class='d-flex align-items-center'>
											<h3><i class='fa fa-cutlery'></i></h3>
											<span class='ml-2'>Comidas</span>
										</div>
									</a>
								</div>
							</div>
							<div class='card'>
								<div class='card-header'>
									<a href='{{ route('items.create') }}' class='text-dark text-decoration-none'>
										<div class='d-flex align-items-center'>
											<h3><i class='fa fa-cutlery'></i></h3>
											<span class='ml-2'>Agregar Comida</span>
										</div>
									</a>

								</div>
							</div>
							<div class='card'>
								<div class='card-header'>
									<a href='{{ route('menus.index') }}' class='text-dark text-decoration-none'>
										<div class='d-flex align-items-center'>
											<h3><i class='fa fa-cutlery'></i></h3>
											<span class='ml-2'>Menus</span>
										</div>
									</a>
								</div>
							</div>
							<div class='card'>
								<div class='card-header'>
									<a href='{{ route('menus.create') }}' class='text-dark text-decoration-none'>
										<div class='d-flex align-items-center'>
											<h3><i class='fa fa-cutlery'></i></h3>
											<span class='ml-2'>Agregar Menu</span>
										</div>
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class='col-md-8'>@yield('content')</div>	
				</div>
			</div>	
        </main>
    </div>
</body>
</html>
