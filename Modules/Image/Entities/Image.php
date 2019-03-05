<?php

namespace Modules\Image\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\ProductImage;

class Image extends Model
{
    public $timestamps  = false;
    protected $table    = 'image';
    protected $fillable = ['name', 'file', 'enable'];

    public function productImage(){
        return $this->hasMany(ProductImage::class);
    }
}
