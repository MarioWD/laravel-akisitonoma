<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Intervention\Image\Facades\Image;

class ItemsController extends Controller
{
    const RULES = [
        'name' => 'required',
        'description' => '',
        'image' => 'required',
        'price' => 'required'
    ];

	public function __construct () { $this->middleware('auth'); }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
		$items = Item::all();
		return view('items.index', compact('items'));
	}

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
        try {
            $data = $request->validate(self::RULES);
            $image_path = $request->image->store('uploads', 'public');
            $image = Image::make(public_path("storage/{$image_path}"))->fit(1000,1000);
            $image->save();
            $data['image'] = $image_path;
            Item::create($data);
            return redirect(route("items.index"));
        } catch (\Exception $e) {
            var_dump($e->getMessage(), $_POST, $_FILES, $e->getTrace());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
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
		$data = $request->validate(self::RULES);
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
