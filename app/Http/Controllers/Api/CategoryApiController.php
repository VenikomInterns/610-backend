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
    }

    public function show(Category $category): JsonResource
    {
        $products = $category->load('products');

        return JsonResource::make(collect($products));
    }
}
