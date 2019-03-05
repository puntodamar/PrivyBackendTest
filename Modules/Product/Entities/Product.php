<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\CategoryProduct;
use Modules\Category\Entities\Category;

class Product extends Model
{
    public $timestamps  = false;
    protected $table    = 'product';
    protected $fillable = ['name', 'description', 'enable'];
    protected $casts    = ['enable' => 'boolean'];

    public function categoryProduct(){
        return $this->hasMany(CategoryProduct::class);
    }

    
}
