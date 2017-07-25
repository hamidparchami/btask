<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'title', 'desc', 'field_type', 'is_active',
    ];

    public function valuesInProducts()
    {
        return $this->hasMany('App\ProductAttribute');
    }
}
