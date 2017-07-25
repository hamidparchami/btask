<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'attribute_id', 'product_id', 'value',
    ];

    public function attribute()
    {
        return $this->belongsTo('App\Attribute');
    }
}
