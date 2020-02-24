<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Menu;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$now = date('Y-m-d', strtotime('today'));	
		$menu = Menu::where('start_date', '<=', $now)
			->where('end_date', '>=', $now)
			->first();
		$totals = ['item_quantities' => []];
		foreach ($menu->orders as $order) {
			foreach ($order->items as $item) {
				if (!isset($totals['item_quantities'][$item->id])) {
					$totals['item_quantities'][$item->id] = 0;
				}
				$totals['item_quantities'][$item->id] += $item->pivot->quantity;
			}
		}
        return view('home', compact('menu', 'totals'));
    }
}
