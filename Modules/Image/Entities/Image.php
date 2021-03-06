<?php

namespace Modules\Image\Entities;

use App\lib\ImageHelper;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\ProductImage;
use Modules\Product\Entities\Product;

class Image extends Model
{
    public $timestamps  = false;
    protected $table    = 'image';
    protected $fillable = ['name', 'file', 'enable'];
    protected $casts    = [
        'enable'    => 'boolean'
    ];
    protected $hidden   = ['pivot','file'];
    protected $appends  = ['url'];

    public function productImage(){
        return $this->hasMany(ProductImage::class);
    }

    public function product(){
        return $this->belongsToMany(Product::class,'product_image');
    }

    public function getUrlAttribute(){
        return env('APP_URL').'/public'.$this->attributes['file'];
    }

    public function scopeDeleteImages($query,$id,$images){
        //$data   = $this->whereIn('id',$images);
        $data   =
            $this->whereHas('ProductImage', function($pi) use($id){
                $pi->where('product_id',$id);
            })->whereIn('id',$images);

        $loop   = clone $data;
        $loop   = $loop->get();

        foreach($loop as $d){
            ImageHelper::deletePhoto($d['file']);
        }

        $data->delete();
    }
}
