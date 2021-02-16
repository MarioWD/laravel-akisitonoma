@component('mail::message')

# Muchas gracias por ordenar con nosotros!

Hi {{ $order->name }},

We are on our way to {{ $order->address }} with your food, we will contact you at {{ $order->phone }} when we arrive.

We greately appreciate your patience, our deliveries start this {{ date( 'l F \t\h\e jS', strtotime($order->menu->end_date) ) }} from 9AM to 3PM, wait times will depend of delivery area and number of orders we recieve. Please feel free to contact us with any questions or modifications to your order.

Were including a overview of your order below:
@component('mail::table')
| Comida/Food     | Cuanto/Amount              | Precio/Price       | Total |
| :--------------- |:--------------------------:|:-----------------:| -----: |
@foreach ($order->items as $item)
|{{ $item->name }}|{{ $item->pivot->quantity }}|${{ $item->price }}|${{ $item->price * $item->pivot->quantity }}|
@endforeach
| Delivery | 1 | ${{$order->menu->delivery}}| ${{$order->menu->delivery}} |
| Total | | |{{ $order->total }}|
@endcomponent

Thank you,<br>
Emilia Flores<br>
(778) 889 1245<br>
{{ config('app.name') }}
@endcomponent
