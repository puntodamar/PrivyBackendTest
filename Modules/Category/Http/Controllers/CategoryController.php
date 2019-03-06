<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use DB;

use Modules\Category\Entities\Category;

use Modules\Category\Http\Requests\CreateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return response()->json(Category::all()->toArray());
    }

    public function store(CreateCategoryRequest $request){
        try{
            DB::beginTransaction();
            $category = Category::create($request->all());
            DB::commit();
            return response()->json($category);
        }
        catch(\Exception $e){
            return response()->json([
                'message'   => $e->getMessage()
            ]);
        }
    }

    public function show(Category $category){
        try{
            return response()->json($category);
        }
        catch(\Exception $e){
            return response()->json([
                'message'   => $e->getMessage()
            ]);
        }       
    }

    public function update(Request $request, Category $category){
        try{
            DB::beginTransaction();
            $category->update($request->all());
            DB::commit();
            return response()->json($category);
        }
        catch(\Exception $e){
            return response()->json([
                'message'   => $e->getMessage()
            ]);
        }
    }

    public function destroy(Category $category){
        $category->delete();
        return response()->json(['message' => 'success']);
    }

}
