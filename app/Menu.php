<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	protected $guarded = [];
    //
	public function items () {
		return $this->belongsToMany(Item::class);
	}
	public function orders () {
		return $this->hasMany(Order::class);
	}
}
