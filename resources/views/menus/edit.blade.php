@extends('layouts.app')
@section('content')
<div class='row'>
	<div class='col-md-8 offset-md-2'>
		<div class='card'>
		<div class='card-header'>{{ __('Editar el menu de la semana') }}</div>
		<div class='card-body'>
		{{ Form::model($menu, ['action' => ['MenusController@update', $menu->id]]) }}
		@method('PATCH')
		<div class='form-group row'>
			{{ Form::label(
					'start_date', 
					'Cuando empieza el menu', 
					['class' => 'col-md-4 col-form-label text-md-right']) }}
			<div class='col-md-6'>
				{{ Form::date('start_date', (old('start_date') ?? $menu->start_date), 
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
			{{ form::label('end_date', 'cuando termina el menu',
				['class' => 'col-md-4 col-form-label text-md-right']) }}
			<div class='col-md-6'>
				{{ form::date('end_date', ( old('end_date') ?? $menu->end_date), 
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
		@foreach ($menu->items as $item)
		<div class='form-group row'>
			<div class='col-md-4'>
				<img src='{{ "/storage/{$item->image}" }}' class='w-100' />
			</div>
			<div class='col-md-8 pt-5'>
				<div class='form-check'>
					{{ 
						form::checkbox("items[{$item->id}]", $item->id, TRUE,
						['class' => "form-check-input " . ($errors->has('items')?'is-invalid':'')]) 
					}}
					{{ 
						form::label("items[{$item->id}]", $item->name,
						['class' => 'form-check-label']) 
					}}
				</div>
				<hr>
				<div class="form-check">
					{{ 
						form::radio("items[{$item->id}][sold_out]", 0, !$item->pivot->sold_out,
						['class' => "form-check-input", 'id'=>"items[{$item->id}][sold_out][true]"]) 
					}}
					{{ 
						form::label("items[{$item->id}][sold_out][true]", "In Stock",
						['class' => 'form-check-label']) 
					}}
				</div>
				<div class="form-check">
					{{ 
						form::radio("items[{$item->id}][sold_out]", 1, $item->pivot->sold_out,
						['class' => "form-check-input", 'id' => "items[{$item->id}][sold_out][false]"]) 
					}}
					{{ 
						form::label("items[{$item->id}][sold_out][false]", "Sold Out",
						['class' => 'form-check-label']) 
					}}
				</div>
			</div>
		</div>
		@endforeach
		@foreach ($items as $item)

		@if ($menu->items->contains($item->id)) @continue @endif

		<div class='form-group row'>
			<div class='col-md-4'>
				<img src='{{ "/storage/{$item->image}" }}' class='w-100' />
			</div>
			<div class='col-md-8 pt-5'>
				<div class='form-check'>
					{{ 
						form::checkbox("items[{$item->id}]", $item->id, $menu->items->contains($item->id),
						['class' => "form-check-input " . ($errors->has('items')?'is-invalid':'')]) 
					}}
					{{ 
						form::label("items[{$item->id}]", $item->name,
						['class' => 'form-check-label']) 
					}}
				</div>
			</div>
		</div>
		@endforeach
		<div class='col-md-6 offset-md-4 text-left'>
			{{ Form::submit('Guardar menu', ['class' => 'btn btn-primary']) }}
		</div>
		{{ Form::close() }}
		</div>
		</div>
	</div>
</div>
@endsection
