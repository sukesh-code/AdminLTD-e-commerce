<?php

namespace App\Models;

use App\Models\StockHistory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInventory extends Model
{
    use HasFactory;
    public $table = 'product_inventory';

    public function Product_table()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    protected $fillable = [
        'product_id',
        'quantity'
    ];


    public function histories()
    {
        return $this->hasMany(StockHistory::class, 'inventory_id')->latest();
    }
}
