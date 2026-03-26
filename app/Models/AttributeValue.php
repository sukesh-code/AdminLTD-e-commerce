<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    public $guarded = [];
    use HasFactory;

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }


    public function variantAttributes()
    {
        return $this->hasMany(VariantAttribute::class, 'attribute_value_id');
    }
}
