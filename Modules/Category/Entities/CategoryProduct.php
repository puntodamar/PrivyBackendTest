<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;

class CategoryProduct extends Model
{
    public $timestamps  = false;
    protected $table    = 'category_product';
    protected $fillable = ['product_id','category_id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
