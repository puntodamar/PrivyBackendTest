<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;


class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::find(1)->toArray());
    }
 
}
