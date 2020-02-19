@component('mail::message')

# Muchas gracias por ordenar con nosotros!

Hola {{ $order->name }},

Ya estamos en camino a {{ $order->address }} con su comida, te contactaremos a {{ $order->phone }} cuando llegamos.

Agradecemos su paciencia nuestras entregas comienzan todo los sabados apartir de las 9AM hasta las 3PM, tiempo de espera dependera de la zona de entrega y volumen de pedidos. Por favor sientase libre de contactarnos con cualquier pregunta o modificacion a su orden.

Se encluye un resumen de su orden abajo:

<hr>

Hi {{ $order->name }},

We are on our way to {{ $order->address }} with your food, we will contact you at {{ $order->phone }} when we arrive.

We greately appreciate your patience, our deliveries start every saturday from 9AM to 3PM, wait times will depend of delivery area and number of orders we recieve. Please feel free to contact us with any questions or modificatiosn to your order.

Were including a overview of your order below:
@component('mail::table')
| Comida/Food     | Cuanto/Amount              | Precio/Price       | Total |
| :--------------- |:--------------------------:|:-----------------:| -----: | 
@foreach ($order->items as $item)
|{{ $item->name }}|{{ $item->pivot->quantity }}|${{ $item->price }}|${{ $item->price * $item->pivot->quantity }}|
@endforeach
| Delivery | 1 | $3.00|$3.00|
| Total | | |{{ $order->total + 3.00 }}|
@endcomponent

Thank you,<br>
Emilia Flores<br>
(778) 889 1245<br>
{{ config('app.name') }}
@endcomponent
