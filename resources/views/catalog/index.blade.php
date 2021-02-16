@extends('layouts.frontend')
@section('content')
<div class='row__header-intro col-12 text-center mt-5'>
    <h1><span class='font-color-beige'>Akisito No'ma</span> Catering Service</h1>
    <p>Here you will find the wide selection of food we can offer for your special events!</p>
</div>
@if(count($items) >= 1)
    <div class="col-12 mt-5">
    <div class='row__board col-sm-10 offset-sm-1'>
        <div class='row p-4'>
            @foreach($items as $item)
            <div class='row__item align-items-center col-sm-4'>
                <div class='col__img mb-3'>
                    <img src="/storage/{{$item->image}}" class='w-100'/>
                </div>
                <div class='col__info'>
                    <blockquote class='blockquote text-center'>
                        <h1 class='font-color-chocoorange'>
                        {{ $item->name }} - <span class='font-color-saddlered'>${{round($item->price, 2)}}</span>
                        </h1>
                    </blockquote>
                    <p class="mb-0">{{$item->description}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection
