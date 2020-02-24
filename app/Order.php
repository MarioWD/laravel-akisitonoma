<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $guarded = [];
    //
	public function items () {
		return $this->belongsToMany(Item::class)->withPivot('quantity');
	}
	public function menu () {
		return $this->belongsTo(Menu::class);
	}
}
