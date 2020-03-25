@extends('layouts.app')

@section('content')
<h1>Menu Dashboard</h1>
<h3>El Menu Activo Ahorita con las ordenes echas por el internet</h3>
@if (!$menus->isEmpty())
@foreach ($menus->sortBy('end_date') as $menu)
<table class='table'>
	<tbody>
    <tr>
        <th>Menu: #{{ $menu->id }}</th>
        <th>{{ date('l, M j', strtotime($menu->start_date)) }}</th>
        <th>{{ date('l, M j', strtotime($menu->end_date)) }}</th>
    </tr>
	@foreach ($menu->items as $item)
	<tr>
		<th>{{ $item->name }}</th>
		<td>{{ $menu->item_order_quantity_total($item) }}</td>
		<td>${{ number_format($menu->item_order_quantity_total($item) * $item->price, 2) }}</td>
	</tr>
	@endforeach
    <tr>
        <th>Deliveries:</th>
        <td>{{ $menu->orders->count() ?? 0 }}</td>
        <td>${{ number_format($menu->orders->count() * $menu->delivery, 2) ?? 0 }}</td>
    </tr>
    <tr>
        <th>Total:</th>
        <td></td>
        <td>${{ number_format($menu->orders_total(), 2) }}</td>
    </tr>
	</tbody>
</table>
<div class='row'>
<div class='accordion col-12' id='order-accordion'>
	@foreach($menu->orders as $order)
	<div class='card'>
		<div class='card-header' id='order-{{ $order->id }}-card'>
			<h2 class='mb-0'>
			<button class='btn btn-link' type='button' data-toggle='collapse' data-target='#order-collapse-{{ $order->id }}' aria-expanded="true">
			#{{ $menu->id }}-{{ $order->id }}. [{{ $order->name }}] {{ $order->address }} 
			</button>
			</h2>
		</div>
		<div id='order-collapse-{{$order->id }}' class='collapse' aria-labelledby='order-{{ $order->id }}-card' data-parent='#order-accordion'> 
			<div class='card-body flex-md-row flex-column d-flex align-items-center'>
				<div class='col-md-5'>
					<h3 class='mb-3'>Detalles de la Orden</h3>
					<p class=''><strong>Para:</strong><br>{{ $order->name }}</p>
					<p class=''><strong>Notas:</strong><br>{{ $order->notes }}</p>
					<p class=''><strong>Direccion:</strong><br><a class='btn btn-primary' href='http://maps.google.com/?q={{ $order->address }}' target='_blank'>{{ $order->address }}</a></p>
					<p><strong>Telefono:</strong><br><a class='btn btn-primary' href='tel:{{ $order->phone }}' target='_blank'>{{ $order->phone }}</a></p>
					<p><strong>Email:</strong><br><a class='btn btn-primary' href='mailto:{{ $order->email }}' target='_blank'>{{ $order->email }}</a></p>
					<table class='table'>
						<tbody>
						@foreach ($order->items as $item)
						<tr>
							<th>{{ $item->name }}</th>
							<td>{{ $item->pivot->quantity }}</td>
							<td>${{ number_format($item->pivot->quantity * $item->price, 2) }}</td>
						</tr>
						@endforeach
						<tr>
							<th>Delivery</th>
							<th></th>
							<td>${{ number_format($menu->delivery, 2) }}</td>
						</tr>
                        <tr><td></td><td></td><td>
                            ${{ number_format($order->total + $menu->delivery, 2) }}</td></tr>
						</tbody>
					</table>
				</div>
				<div class='col-md-7 d-flex flex-md-row flex-column justify-content-around'>
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
<hr class='mb-5'/>
@endforeach
@else
<div class='jumbotron'>
	<h1 class='display-4'>No hay menu para la semana</h1>
	<p class='lead'>Crea uno nuevo con el boton abajo</p>
	<hr class='my-4'/>
	<p class='lead'>
		<a class='btn btn-primary btn-lg' href='{{ route('menus.create') }}'>Nuevo Menu</a>
	</p>
</div>
@endif
@endsection
