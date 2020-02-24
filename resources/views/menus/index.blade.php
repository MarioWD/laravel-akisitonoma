@extends('layouts.app')
@section('content')
<h1 class='mb-3'>Los Menus creados hasta el dia</h1>	
<div class='mb-4'>
	<a href="{{ route('menus.create') }}" class='btn btn-primary'>Agregar Menu</a>
</div>
@if(!$menus->isEmpty())
<div class='jumbotron'>
	@foreach($menus as $x => $menu)
	<div class='row d-flex align-items-center mb-3'>
		<div class='col-md-6'>
			<div id='menuCarousel-{{ $x }}' class='carousel slide menu-carousel' data-ride='carousel'>
				<ol class='carousel-indicators'>
				@foreach($menu->items as $i => $item)
					<li data-target='#menuCarousel-{{ $x }}' data-slide='{{ $i }}' class='{{ ($i == 0?'active':'') }}'></li>
				@endforeach
				</ol>
				<div class='carousel-inner'>
				@foreach($menu->items as $i => $item)
					<div class='carousel-item {{ ($i == 0?'active':'') }}'>
						<img class='d-block w-100' src='/storage/{{ $item->image }}' alt='{{ $item->name }}'/>
						<div class='carousel-caption d-none d-md-block'>
							<h1>{{ $item->name }}</h1>
							<p>{{ $item->description }}</p>
						</div>
					</div>
				@endforeach
				</div>
				  <a class="carousel-control-prev" href="#menuCarousel-{{ $x }}" role="button" data-slide="prev">
					  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
					  <span class="sr-only">Previous</span>
				  </a>
				  <a class="carousel-control-next" href="#menuCarousel-{{ $x }}" role="button" data-slide="next">
					  <span class="carousel-control-next-icon" aria-hidden="true"></span>
					  <span class="sr-only">Next</span>
				  </a>
			</div>
		</div>
		<div class='col-md-6 pt-2'>
			<h5><strong>Empieza:</strong> {{ date('l F j, Y', strtotime($menu->start_date)) }}</h5>
			<h5><strong>Termina:</strong> {{ date('l F j, Y', strtotime($menu->end_date)) }}</h5>
			<h5><strong>Comidas:</strong> {{ $menu->items->count() }}</h5>
			<hr class='my-4'>
			<a href='{{ route('menus.show', $menu->id) }}' class='btn btn-primary'>Ver Menu</a>
		</div>
	</div>
	@endforeach
</div>
@endif
@endsection
