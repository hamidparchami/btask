<?php

namespace App;

use App\Lib\GeneralFunctions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 'title', 'desc', 'url_key', 'order', 'is_active',
    ];

    /**
     * check if order is set and is not null
     * @param $value
     */
    public function setOrderAttribute($value)
    {
        $this->attributes['order'] = (GeneralFunctions::isSetAndIsNotNull($value)) ? $value : 0;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany('App\Category', 'parent_id')->orderBy('order', 'desc');
    }
}
