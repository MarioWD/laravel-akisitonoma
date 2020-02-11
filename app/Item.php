<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	protected $guarded = [];
    //
	public function menus () {
		return $this->belongToMany(Menu::class);
	}
	public function orders () {
		return $this->belongsToMany(Order::class)->withPivot('quantity');
	}
}
