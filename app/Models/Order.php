<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;

class Order extends Model
{
    use HasFactory;

    public $guarded = [];









    public function user_rel()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderDetails_rel()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }



}
