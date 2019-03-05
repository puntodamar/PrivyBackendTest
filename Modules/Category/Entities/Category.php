<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\CategoryProduct;
use Modules\Category\Entities\Product;

class Category extends Model
{
    public $timestamps  = false;
    protected $table    = 'category';
    protected $fillable = ['name','sepatu', 'enable'];
    protected $casts    = [
        'enable'    => 'boolean'
    ];

    public function categoryProduct(){
        $this->hasMany(CategoryProduct::class);
    }

}
