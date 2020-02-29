@extends('layouts.app')
@section('content')
<div class='row'>
	<div class='col-12'>
	<div class='card'>
	<div class='card-header'>{{ __('Activa menu para la semana') }}</div>
	<div class='card-body'>
	{{ Form::model($menu, ['action' => 'MenusController@store']) }}
		<div class='form-group row'>
			{{ Form::label(
					'start_date', 
					'Cuando empieza el menu', 
					['class' => 'col-md-4 col-form-label text-md-right']) }}
			<div class='col-md-6'>
				{{ Form::date('start_date', old('start_date'), 
						[
							'class' => "form-control ".($errors->has('start_date')?'is-invalid':''),
						]) }}
				@error('start_date')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>
		</div>
		<div class='form-group row'>
			{{ form::label('start_date', 'cuando termina el menu',
				['class' => 'col-md-4 col-form-label text-md-right']) }}
			<div class='col-md-6'>
				{{ form::date('end_date', old('end_date'), 
						[
							'class' => "form-control ".($errors->has('end_date')?'is-invalid':''),
						]) }}
				@error('end_date')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror

			</div>
		</div>
		@foreach ($items as $item)
		<div class='form-group row'>
			<div class='col-md-4'>
					<img src='{{ "/storage/{$item->image}" }}' class='w-100' />
			</div>
			<div class='col-md-6 d-flex align-items-center'>
				<div class='form-check'>
				{{ form::checkbox("items[{$item->id}]", $item->id, false,
				[
					'class' => "form-check-input " . ($errors->has('items')?'is-invalid':'')
				]) }}

				{{ form::label("items[{$item->id}]", $item->name,
					['class' => 'form-check-label text-md-right']) }}

				@error("items")
				<div class='invalid-feedback' role="alert"><strong>{{ $message }}</strong></div>
				@enderror
				</div>
			</div>
		</div>
		@endforeach
		<div class='col-md-6 offset-md-4'>
			{{ Form::submit('Guardar nuevo menu', ['class' => 'btn btn-primary']) }}
		</div>
	{{ Form::close() }}
	</div>
	</div>
	</div>
</div>
@endsection
