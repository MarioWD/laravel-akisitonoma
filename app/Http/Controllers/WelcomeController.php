<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Menu;
use \App\Order;

class WelcomeController extends Controller
{
    //
	public function index(Request $request) {
		$now = date('Y-m-d', strtotime('today'));	
		$menu = Menu::where('start_date', '<=', $now)
			->where('end_date', '>=', $now)
			->first();
		$order = ($request->session()->get('session.order') 
				?? [
					"name" => "",
					"phone" => "",
					"email" => "",
					"address" => "",
					"total" => 0,
					"items" => [],
					"menu_id" => $menu?$menu->id:0,
					"start" => false,
					"notes" => "",
				]);
		return view('welcome', compact('menu', 'order'));
	}
}
