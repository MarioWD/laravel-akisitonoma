<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Intervention\Image\Facades\Image;

class ItemsController extends Controller
{
	public function __construct () { $this->middleware('auth'); }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() { 
		$items = Item::all();
		return view('items.index', compact('items')); 
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() { 
		return view('items.create'); 
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
		$data = $request->validate([
			'name' => ['required'],
			'description' => '',
			'image' => ['required', 'image'],
			'price' => ['required'],
		]);
		$image_path = $request->image->store('uploads', 'public');
		$image = Image::make(public_path("storage/{$image_path}"))->fit(1000,1000);
		$image->save();
		$data['image'] = $image_path;
		Item::create($data);	

		return redirect(route("items.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
		return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
		return view('items.edit', compact('item'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
		$data = $request->validate([
			'name' => ['required'],
			'description' => '',
			'image' => ['image'],
			'price' => ['required'],
		]);
		if ($request->image) {
			$image_path = $request->image->store('uploads', 'public');
			$image = Image::make(public_path("storage/{$image_path}"))->fit(1000,1000);
			$image->save();
			$data['image'] = $image_path;
		}
		else {
			unset($data['image']);
		}
		$item->update($data);
		return redirect(route('items.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
		$item->delete();
		return redirect(route("items.index"));
    }
}
