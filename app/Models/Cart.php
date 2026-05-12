<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([CartObserver::class])]
class Cart extends Model
{
    use HasFactory;

    public $guarded = [];

    public function product_rel()
    {
        return $this->belongsTo(Product::class, );
    }


 public function variant_rel()
{
    return $this->belongsTo(ProductVariant::class, 'variant_id');
}

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }
}
