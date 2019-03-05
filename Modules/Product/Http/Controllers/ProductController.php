<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;
use Illuminate\Support\Arr;
use DB;

use Modules\Category\Entities\Category;


use Modules\Product\Http\Requests\CreateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::with(['CategoryProduct' => function($cp){
            $cp->with('Category');
        }])->get()->toArray());
    }

    public function show($id){
        $product = Product::find($id);
        if($product){
            return response()->json($product->with(['CategoryProduct' => function($cp){
                $cp->with('Category');
            }])->get()->toArray()); 
        }
        else{
            return response()->json(['message' => 'Product not found'],404);
        }
       
    }

    public function store(CreateProductRequest $request){


        try{
            
            DB::beginTransaction();

            $product = Product::create(Arr::except($request->all(),['category']));
            if(isset($request['category'])){
                
                // Product::find($product->id)
                //     ->categoryProduct()->sync(Arr::only($request->all(),['category']));
                var_dump(Product::find($product->id)->categoryProduct()); exit();
                
            }
            // DB::commit();
            // return response()->json([
            //     'message'   => 'success', 
            //     'data'      => $product]);
        }
        catch(\Exception $e){
            DB::rollback();
            return response()->json([

                'message' => $e->getMessage()
            ]);
        
        }


            
       
    }
 
}
