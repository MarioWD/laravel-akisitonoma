@extends('layouts.app')
@section('content')
<div class='container'>
	<div class='row'>
	<div class='jumbotron col-12'>
		<h1 class='display-4'>Menu numero #{{ $menu->id }}</h1>
		<p>Empieza {{ $menu->start_date }}, y termina {{ $menu->end_date }}</p>
		<div class='d-flex align-items-baseline justify-content-center'>
			<a href='{{ route('menus.edit', $menu->id) }}' class='btn btn-primary'>Editar el menu</a>
			{{ Form::model($menu, ['action' => ['MenusController@destroy', $menu->id], 'class' => 'ml-3']) }}
			@method('DELETE')
			{{ Form::submit('Borrar Este Menu', ['class' => 'btn btn-danger']) }}
			{{ Form::close() }}
		</div>
		<hr class='my-4'>
		<div class='row'>
		@foreach($menu->items as $item)
		<div class='col-md-4'>
			<a href='{{ route('items.show', $item->id) }}' class='text-decoration-none'>
			<div class='card card-body text-left'>
				<img src='/storage/{{ $item->image }}' class='w-100'/>
				<figcaption><strong>{{ $item->name }}</strong> - ${{ $item->price }}</figcaption>
				<p class='mb-0'>{{ $item->description }}</p>
			</div>
			</a>
		</div>
		@endforeach
		</div>
	</div>
	</div>
</div>
@endsection
