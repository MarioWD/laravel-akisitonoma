@extends('layouts.app')

@section('content')
<div class="container">
	<div class='row justify-content-center'>
		<h1>Todas las comidas en el sistema</h1>
	</div>
    <div class="row justify-content-center pt-5">
		@foreach ($items as $item)
        <div class="col-md-4">
			<a href='{{ route("items.edit", $item->id) }}' class='text-dark text-decoration-none'>
            <div class="card">
                <div class="card-header">
					<h3>{{ $item->name}}</h3>
				</div>
                <div class="card-body">
					<img src='/storage/{{ $item->image}}' class='w-100'/>
					<p>{{ $item->description }}</p>
					<p class=''>{{ $item->price }}</p>
                </div>
            </div>
			</a>
        </div>
		@endforeach
    </div>
</div>
@endsection
