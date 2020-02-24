@extends('layouts.app')
@section('content')
<div class='card card-body'>
	<div class='row'>
		<div class='col-6'>
			<img src='/storage/{{ $item->image }}' class='w-100'/>
		</div>
		<div class='col-6 text-left'>
			<h1><strong>{{ $item->name }} - </strong>${{ $item->price }}</h1>
			<p>{{ $item->description }}</p>
			<div class='d-flex align-items-baseline'>
				<a href='{{ route('items.edit', $item->id) }}' class='btn btn-primary'>Editar</a>	
				<form action="{{ route('items.destroy', $item->id) }}" method='POST' class='pl-5'>
					@csrf
					@method('DELETE')
					<button type='submit' class='btn btn-danger'>Borrar</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
