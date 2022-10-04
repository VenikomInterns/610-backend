<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryApiController extends Controller
{
    public function index(): JsonResource
    {
        $categories = Category::all();

        return JsonResource::collection($categories);
    }//good

    public function show(Category $category): JsonResource
    {
        $products = $category->load('products');
        // $products will contain Category with loaded products, but not products List
        // this means that this variable is wrong

        return JsonResource::make(collect($products)); // creating collection of one category?
    }
}
