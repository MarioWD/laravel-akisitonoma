@extends('layouts.app')
@section('content')
<div class='row'>
	<div class='jumbotron col-12'>
		<h1 class='display-4'>Orden numero #{{ $order->id }} Para {{ $order->name }}</h1>
		<p>Ordenado {{ date('l F j, Y - h:iA', strtotime($order->created_at)) }}</p>
		<p>Dirreccion: <a href='http://maps.google.com/?q={{ $order->address }}' target='_blank'>{{ $order->address }}</a></p>
		<p>Telefono: <a href='tel:{{ $order->phone }}' target='_blank'>{{ $order->phone }}</a></p>
		<div class='d-flex align-items-baseline mt-3 justify-content-between'>
			<a href='{{ route('orders.edit', $order->id) }}' class='btn btn-primary'>Editar la Orden</a>
			{{ Form::model($order, ['action' => ['OrdersController@destroy', $order->id]]) }}
			@method('DELETE')
			{{ Form::submit('Borrar Esta Orden', ['class' => 'btn btn-danger']) }}
			{{ Form::close() }}
		</div>
		<hr class='my-4'>
		<table class='table'>
			<thead>
				<tr>
					<th scope='col'>Imagen</th>
					<th scope='col'>Nombre</th>
					<th scope='col'>Cuanto</th>
					<th scope='col'>Precio</th>
					<th scope='col'>Total</th>
				</tr>
			</thead>
			@foreach($order->items as $item)
			<tr class=''>
				<td><img src='/storage/{{ $item->image }}' class='w-50'/></td>
				<td>{{ $item->name }}</td>
				<td>{{ $item->pivot->quantity }}</td>
				<td>${{ $item->price }}</td>
				<td>${{ $item->price*$item->pivot->quantity }}</td>
			</tr>
		@endforeach
		</table>
	</div>
</div>
@endsection
