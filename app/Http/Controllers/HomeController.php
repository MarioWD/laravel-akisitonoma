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
        $menus = Menu::select()
            ->where('start_date', '<=', $now)
			->where('end_date', '>=', $now)
			->get();
        return view('home', compact('menus'));
    }
}
