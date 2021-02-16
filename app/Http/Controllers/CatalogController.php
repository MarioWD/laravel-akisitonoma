<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index() {
        $menus = [];
        /** @var Collection $items */
        $items = Item::select()->where('for_catering', '=', 1)->get();
        return view('catalog.index', compact('items', 'menus'));
    }
}
