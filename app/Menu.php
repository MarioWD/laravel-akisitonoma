<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	protected $guarded = [];
    //
	public function items () {
		return $this->belongsToMany(Item::class)->withPivot('sold_out');
	}
	public function orders () {
		return $this->hasMany(Order::class);
	}
    public function orders_total () {
        $return = $this->orders->count() * $this->delivery;
        foreach ($this->items as $item) {
            $return += $this->item_order_quantity_total($item) * $item->price;
        }
        return $return;
    }
    public function item_order_quantity_total (Item $item) {
        $return = 0;
        foreach ($this->orders as $order) {
            $return += $order->items()->where('item_id', '=', $item->id)
                ->get()->sum('pivot.quantity');
        }
        return $return; 
    }
}
