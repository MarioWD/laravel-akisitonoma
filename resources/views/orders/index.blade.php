@extends('layouts.app')
@section('content')
<div class='row'>
	<div class='col-12 mb-3'>
		<h1>Orders In the System</h1>
		<a href='{{ route('orders.create') }}' class='btn btn-primary'>Crear Orden</a>
	</div>
	<div class='accordion col-12' id='order-accordion'>
		@foreach($orders as $order)
		<div class='card'>
			<div class='card-header' id='order-{{ $order->id }}-card'>
				<h2 class='mb-0'>
				<button class='btn btn-link' type='button' data-toggle='collapse' data-target='#order-collapse-{{ $order->id }}' aria-expanded="true">
				Orden Numero {{ $order->id }} para {{ $order->name }}
				</button>
				</h2>
			</div>
			<div id='order-collapse-{{$order->id }}' class='collapse' aria-labelledby='order-{{ $order->id }}-card' data-parent='#order-accordion'> 
				<div class='card-body flex-md-row flex-column d-flex align-items-center'>
					<div class='col-md-5'>
						<h3 class='mb-3'>Detalles de la Orden</h3>
						<p class='mb-0'>Para: {{ $order->name }}</p>
						<p class='mb-0'>Direccion: <a href='http://maps.google.com/?q={{ $order->address }}' target='_blank'>{{ $order->address }}</a></p>
						<p>Telefono: <a href='tel:{{ $order->phone }}' target='_blank'>{{ $order->phone }}</a></p>
					</div>
					<div class='col-md-7 d-flex flex-md-row flex-column justify-content-around'>
						<a href='{{ route('orders.show', $order->id) }}' class='btn btn-primary'>Ver Orden</a>
						<a href='{{ route('orders.edit', $order->id) }}' class='btn btn-success'>Editar Orden</a>
						{{ Form::model($order, ['action' => ['OrdersController@destroy', $order->id]]) }}
							@method('DELETE')
							{{ Form::submit('Borrar', ['class' => 'w-100 btn btn-danger']) }}
						{{ Form::close() }}
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
@endsection
