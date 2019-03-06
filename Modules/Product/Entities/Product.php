<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\CategoryProduct;
use Modules\Category\Entities\Category;
use App\lib\ImageHelper;
use DB;

use Modules\Image\Entities\Image;


class Product extends Model
{
    public $timestamps  = false;
    protected $table    = 'product';
    protected $fillable = ['name', 'description', 'enable'];
    protected $casts    = ['enable' => 'boolean'];

    public function categoryProduct(){
        return $this->hasMany(CategoryProduct::class, 'product_id', 'id');
    }

    public function category(){
        return $this->belongsToMany(Category::class);
    }

    public function image(){
        return $this->belongsToMany(Image::class,'product_image');
    }

    public function scopeShow($query){
        return $this->with(['category' => function($cat){
            $cat->select('name');
        },'image']);
    }

    public function scopeUploadPhotos($query,$id,$photos){
        $images = [];

        foreach($photos as $img){
            $uploadPath = ImageHelper::getProductImageUploadPath();
            $realPath   = public_path().$uploadPath;
            $filename   = ImageHelper::uploadPhoto($img['file'],$realPath,1000,time())['filename'];
            $image      = Image::create([
                'name'      => $img['name'],
                'file'      => env('APP_URL').$uploadPath.$filename,
                'enable'    => true
            ]);

            array_push($images,$image->id);
        }

        Product::find($id)->image()->sync($images);
    }


    
}
