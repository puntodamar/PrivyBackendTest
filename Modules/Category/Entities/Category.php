<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\CategoryProduct;

class Category extends Model
{
    public $timestamps  = false;
    protected $table    = 'category';
    protected $fillable = ['name','sepatu'];

    public function categoryProduct(){
        return $this->hasMany(CategoryProduct::class);
    }
}
