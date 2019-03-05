<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;

class CategoryProduct extends Model
{
    public $timestamps      = false;
    protected $table        = 'category_product';
    protected $fillable     = ['product_id', 'category_id'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function category(){
        return $this->belongsTo(Catgory::class);
    }
}
