@extends('layouts.app')
@section('content')
<div class='container'>
	<div class='row'>
	@foreach($menus as $menu)
		<div class='card card-header'>
			<a href='{{ route('menus.show', $menu-id) }} text-dark text-decoration-none'>
				<div>Menu number {{ $menu->id }}</div>	
			</a>
		</div>
	@endforeach
	</div>
</div>
@endsection
