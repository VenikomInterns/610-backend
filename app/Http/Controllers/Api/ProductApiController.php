<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductApiController extends Controller
{
    public function show(Product $product): JsonResource
    {
        $showProduct = $product->load('category', 'images');

        return JsonResource::make($showProduct);
    }
}
