<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Image\Entities\Image;

class ProductImage extends Model
{
    public $timestamps  = false;
    protected $table    = 'product_image';
    protected $fillable = ['product_id', 'image_id'];

    public function image(){
        return $this->belongsToMany(Image::class);
    }
}
