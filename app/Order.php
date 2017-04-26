<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use Notifiable;
    
    protected $guarded = [];
    protected $table = 'orders';

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function subTotal()
    {
        $total = 0;
        foreach($this->items as $item)
            $total += $item->price;
        return $total;
    }

    public function orderCode()
    {
        return '#'.str_pad($this->id, 7, '0', STR_PAD_LEFT);
    }

}
