@extends('layouts.app')

@section('content')
<div class="container">
	<div class='row justify-content-center'>
		<h1>Todas las comidas en el sistema</h1>
	</div>
    <div class="row justify-content-center pt-5">
		@foreach ($items as $item)
        <div class="col-md-4">
			<a href='{{ route("items.show", $item->id) }}' class='text-dark text-decoration-none'>
            <div class="card">
                <div class="card-header">
					<h3><strong>{{ $item->name}} - </strong>${{ $item->price }}</h3>
				</div>
                <div class="card-body">
					<img src='/storage/{{ $item->image}}' class='w-100'/>
					<p class='mb-0 mt-3 text-left'>{{ $item->description }}</p>
                </div>
            </div>
			</a>
        </div>
		@endforeach
    </div>
</div>
@endsection
