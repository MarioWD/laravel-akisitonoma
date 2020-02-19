<?php

namespace App\Http\Controllers;

use App\Order;
use App\Item;
use Illuminate\Http\Request;
use \App\Mail\OrderMailer;
use Illuminate\Support\Facades\Mail; 

class OrdersController extends Controller
{
	public function sessionOrderPut (Request $request) {
		$data = $request->validate([
				'name' => ['required'],
				'email' => ['required', 'email'],
				'phone' => ['required'],
				'sum' => ['required', 'numeric'],
				'address' => ['required'],
				'items' => ['required', 'array'],
		]);
		$item_orders = [];
		foreach ($data['items'] as $id => $qunty) {
			if (!$qunty) continue;
			$item_orders[$id] = ['quantity' => $qunty];	
		}
	 	$order = Order::create([
				'name' => $data['name'],
				'email' => $data['email'],
				'phone' => $data['phone'],
				'address' => $data['address'],
				'total' => $data['sum'],
		]);
		$order->items()->sync($item_orders);
		return Mail::to($order->email)->send(new OrderMailer($order));
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
