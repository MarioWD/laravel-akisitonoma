<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;

class MenusController extends Controller
{
	public function __construct () { $this->middleware('auth'); }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
		$menus = Menu::orderby('start_date', 'DESC')->get();
		return view('menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
		$menu = new Menu();
		$items = \App\Item::all();
		return view('menus.create', compact('menu', 'items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
		$data = $request->validate([
			'start_date' => ['required','date'],
			'end_date' => ['required', 'date', 'after_or_equal:start_date'],
			'items' => ['required', 'array'],
			'items.*' => ['required', 'distinct', 'min:1'],
		]);
		$menu = Menu::create([
				'start_date' => $data['start_date'],
				'end_date' => $data['end_date'],
		]);	
		$menu->items()->sync(array_values($data['items']));
		return redirect(route('menus.show', $menu->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu) {
		return view('menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu) {
        //
		$items = \App\Item::all();
		return view('menus.edit', compact('menu', 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        //
		$data = $request->validate([
			'start_date' => ['required','date'],
			'end_date' => ['required', 'date', 'after_or_equal:start_date'],
			'items' => ['required', 'array'],
			'items.*' => ['required', 'distinct', 'min:1'],
		]);
		$menu->update([
				'start_date' => $data['start_date'],
				'end_date' => $data['end_date'],
		]);	
		$menu->items()->sync(array_values($data['items']));
		return redirect(route('menus.show', $menu->id));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
		$menu->delete();
		return redirect(route('menus.index'));
    }
}
