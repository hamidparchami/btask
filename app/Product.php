<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'title', 'desc', 'url_key', 'model', 'image_url', 'price', 'quantity', 'status',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }


    public function attributes()
    {
        return $this->hasMany('App\ProductAttribute');
    }
}
