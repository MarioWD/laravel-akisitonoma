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
        $menus = Menu::where('start_date', '<=', $now)
			->where('end_date', '>=', $now)->with('items')
			->get();
		return view('welcome', compact('menus'));
	}
}
