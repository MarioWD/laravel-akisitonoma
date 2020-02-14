@extends('layouts.app')
@section('content')
@foreach($menus as $x => $menu)
<div class='jumbotron'>
	<div class='container'>
		<div class='row d-flex'>
		<div class='col-md-4'>
			<div id='menuCarousel-{{ $x }}' class='carousel slide' data-ride='carousel'>
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
		<div class='col-md-8 text-left'>
			<h5><strong>Empieza:</strong> {{ $menu->start_date }}</h5>
			<h5><strong>Termina:</strong> {{ $menu->end_date }}</h5>
			<h5><strong>Comidas:</strong> {{ $menu->items->count() }}</h5>
			<hr class='my-4'>
			<a href='{{ route('menus.show', $menu->id) }}' class='btn btn-primary'>Ver Menu</a>
		</div>
		</div>
	</div>
</div>
@endforeach
@endsection
