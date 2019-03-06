<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Image\Entities\Image;
use Modules\Product\Entities\Product;
use Illuminate\Support\Arr;

use DB;

use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::with('category')->get()->toArray());
    }

    public function show($id){
        try{
            return response()->json(Product::with('category')->where('id',$id)->get()->toArray());
        }
        catch(\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function store(Request $request){
        try{
            DB::beginTransaction();

            $product = Product::create(Arr::except($request->all(),['category']));

            if(isset($request['image'])){
                Product::uploadPhotos($product->id,$request['image']);
            }


            if(isset($request['category'])){
                Product::find($product->id)->category()->sync($request['category']);
            }


            DB::commit();
            return response()->json([
                'message'   => 'success', 
                'data'      => $product]);
        }
        catch(\Exception $e){
            DB::rollback();
            return response()->json([

                'message'   => $e->getMessage(),
                'line'      => $e->getLine(),
                'file'      => $e->getFile()
            ]);
        
        }
    }

    public function update(Request $request, Product $product){
        try{

            DB::beginTransaction();

            $product->update($request->except(['category','image']));

            if(isset($request['category'])){
               $product->category()->sync($request->get('category'));         
            }

            if(isset($request['remove_image'])){
                Image::deleteImages($request['remove_image']);
            }

            if(isset($request['new_image'])){
                Product::uploadPhotos($product->id,$request['new_image']);
            }


            DB::commit();
            return response()->json([
                'message'   => 'update success',
                'data'      => $product]);
        }
        catch(\Exception $e){
            DB::rollback();
            return response()->json([

                'message' => $e->getMessage()
            ]);
        
        }
    }

    public function destroy(Product $product){
        $product->delete();
        return response()->json(['message' => 'success']);
    }
 
}
