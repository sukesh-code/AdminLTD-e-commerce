<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockHistory extends Model
{
    protected $fillable = [
        'inventory_id',
        'added_stock',
        'old_stock',
        'new_total'
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
