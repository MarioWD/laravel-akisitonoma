<?php

namespace App\Http\Controllers;

use App\Order;
use App\Item;
use App\Menu;
use Illuminate\Http\Request;
use \App\Mail\OrderMailer;
use Illuminate\Support\Facades\Mail; 

class OrdersController extends Controller
{
	public function rules () {
		return [
			'name' => ['required'],
			'email' => ['required', 'email'],
			'phone' => ['required'],
			'total' => ['required', 'numeric'],
			'address' => ['required'],
			'item_id' => ['required', 'array'],
			'menu_id' => ['required', 'numeric'],
		];
	}
	public function sessionOrderPut (Request $request) {
		$item_orders = [];
		$itemIds = [];
		foreach ($request->items as $id => $qunty) {
			if (!$qunty) continue;
			$item_orders[$id] = ['quantity' => $qunty];	
			$itemIds[] = $id;
		}
		$sum = $request->total;
		$request->request->add(['item_id' => $itemIds,'total' => $request->sum,]);
		$data = $request->validate($this->rules());
		unset($data['item_id']);
	 	$order = Order::create($data);
		$order->items()->sync($item_orders);
		Mail::to($order->email)->send(new OrderMailer($order));
		return $order;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$orders = Order::orderby('created_at', 'DESC')->paginate(12);
		return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() { 
		$now = date('Y-m-d', strtotime('today'));	
		$menu = Menu::where('start_date', '<=', $now)
			->where('end_date', '>=', $now)
			->first();
		return view('orders.create', ['order'=>new Order(), 'menu'=>$menu]);
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$now = date('Y-m-d', strtotime('today'));	
		$menu = Menu::where('start_date', '<=', $now)
			->where('end_date', '>=', $now)
			->first();
		$total = 0;
		$item_ids = [];
		$itemIds = [];
		foreach ($request->item as $id => $amount) {
			if (!$amount) continue;
			$item = $menu->items->find($id);
			$total += $item->price*$amount;
			$item_ids[$id] = ['quantity' => $amount,];
			$itemIds[] = $id;
		}
		$request->request->add(['item_id' => $item_ids, 'total' => $total,]);
		$data = $request->validate($this->rules());
		unset($data['item_id']);
		$order = Order::create($data);
		$order->items()->sync($item_ids);
		Mail::to($order->email)->send(new OrderMailer($order));
		return redirect(route('orders.show', $order->id));
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order) { return view('orders.show', compact('order')); }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order) { return view('orders.edit', compact('order')); }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
		$total = 0;
		$item_ids = [];
		$itemIds = [];
		foreach ($request->item as $id => $amount) {
			if (!$amount) continue;
			$item = $order->menu->items->find($id);
			$total += $item->price*$amount;
			$item_ids[$id] = ['quantity' => $amount,];
			$itemIds[] = $id;
		}
		$request->request->add(['item_id' => $itemIds,'total' => $total,]);
		$data = $request->validate($this->rules());
		unset($data['item_id']);
		$order->update($data);
		$order->items()->sync($item_ids);
		Mail::to($order->email)->send(new OrderMailer($order));
		return redirect(route('orders.show', $order->id));
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
		$order->delete();
		return redirect(route('orders.index'));
    }
}
