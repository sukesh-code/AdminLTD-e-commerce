<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    public $guarded = [];

    // public function product()
    // {
    //     return $this->belongsTo(Product::class, 'product_id');
    // }

    // public function order_rel()
    // {
    //     return $this->belongsTo(Order::class, 'order_id');
    // }

    // // Customer who purchased
    // public function user()
    // {
    //     return $this->hasOneThrough(
    //         User::class,   // Final model
    //         Order::class,  // Intermediate model
    //         'id',          // orders.id
    //         'id',          // users.id
    //         'order_id',    // order_details.order_id
    //         'user_id'      // orders.user_id
    //     );
    // }







    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function order()   // MUST be named "order"
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

}
