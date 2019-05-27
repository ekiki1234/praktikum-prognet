<?php

namespace App;
class Cart
{
	public $items = null;
	public $totalQty = 0;
	public $totalPrice = 0;



    public function add($item, $id)
    {
    	$storedItem = ['qty'=>0, 'price'=>$item->harga, 'item'=>$item];
    	if($this->items){
    		if(array_key_exists($id, $this->items)){
    			$storedItem = $this->items[$id];
    		}
    	}
    	$storedItem['qty']++;
    	$storedItem['price'] = $item->harga * $storedItem['qty'];
    	$this->items[$id] = $storedItem;
    	$this->totalQty++;
    	$this->totalPrice += $item->harga;
    }
}
