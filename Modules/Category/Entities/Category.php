<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\CategoryProduct;
use Modules\Product\Entities\Product;

class Category extends Model
{
    public $timestamps  = false;
    protected $table    = 'category';
    protected $fillable = ['name','sepatu', 'enable'];
    protected $casts    = [
        'enable'    => 'boolean'
    ];

    public function categoryProduct(){
        return $this->hasMany(CategoryProduct::class);
    }

    public function product(){
        return $this->belongsToMany(Product::class);
    }
}
