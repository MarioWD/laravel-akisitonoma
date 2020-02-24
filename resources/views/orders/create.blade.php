@extends('layouts.app')
@section('content')
<div class='row'>
	<div class='col-md-8 offset-md-2'>
		<div class='card'>
			<div class='card-header'>{{ __('Crear Orden') }}</div>
			<div class='card-body'>
				{{ Form::model($order, ['action' => ['OrdersController@store']]) }}
				<div class='form-group row'>
					{{ Form::label('name', "Orden Nombre", ['class'=>"col-md-4 col-form-label text-md-right"]) }}
					<div class='col-md-8'>
					{{ Form::text('name', old('name'), ['class'=>"form-control ".($errors->has('name')?'is-invalid':'')]) }}
					@error('name')
					<span class='invalid-feedback'><strong>{{ $message }}</strong></span>
					@enderror
					</div>
				</div>
				<div class='form-group row'>
					{{ Form::label('email', "Orden Email", ['class'=>"col-md-4 col-form-label text-md-right"]) }}
					<div class='col-md-8'>
					{{ Form::email('email', old('email'), ['class'=>"form-control ".($errors->has('email')?'is-invalid':'')]) }}
					@error('email')
					<span class='invalid-feedback'><strong>{{ $message }}</strong></span>
					@enderror
					</div>
				</div>
				<div class='form-group row'>
					{{ Form::label('phone', "Orden Telefono", ['class'=>"col-md-4 col-form-label text-md-right"]) }}
					<div class='col-md-8'>
					{{ Form::text('phone', old('phone'), ['class'=>"form-control ".($errors->has('phone')?'is-invalid':'')]) }}
					@error('phone')
					<span class='invalid-feedback'><strong>{{ $message }}</strong></span>
					@enderror
					</div>
				</div>
				<div class='form-group row'>
					{{ Form::label('address', "Orden Dirreccion", ['class'=>"col-md-4 col-form-label text-md-right"]) }}
					<div class='col-md-8'>
					{{ Form::text('address', old('address'), ['class'=>"form-control ".($errors->has('address')?'is-invalid':'')]) }}
					@error('address')
					<span class='invalid-feedback'><strong>{{ $message }}</strong></span>
					@enderror
					</div>
				</div>
				@foreach( $menu->items as $i => $item )
					<div class='form-group row'>
					{{ Form::label("items[$item->id]", $item->name, ['class'=>"col-md-4 col-form-label text-md-right"]) }}
					<div class='col-md-8'>
					{{ Form::number("item[$item->id]", 
							0, 
							['class'=>"form-control ".($errors->has("item[$item->id]")?'is-invalid':'')]) 
					 }}
					@error("items[$item->id]")
					<span class='invalid-feedback'><strong>{{ $message }}</strong></span>
					@enderror
					</div>
				</div>
				@endforeach
				{{ Form::hidden('menu_id', $menu->id) }}
				<div class='col-md-6 offset-md-4 text-left'>{{ Form::submit('Guardar La Orden', ['class' => 'btn btn-primary']) }}</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>
@endsection
