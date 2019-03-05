<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

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
