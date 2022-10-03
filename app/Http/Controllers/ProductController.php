<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index(): Response
    {
        $products = Product::query()->with('category')->paginate(2);

        return Inertia::render('Product/Index', compact('products'));
    }

    public function create(): Response
    {
        $categories = Category::all();

        return Inertia::render('Product/Create', compact('categories'));
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,svg,webp'
        ]);

        unset($validated['images']);

        $product = new Product($validated);

        Category::query()->find($validated['category_id'])->products()->save($product);

        $this->saveImage($request, $product);

        return Redirect::route("products.index");
    }

    public function edit(Product $product): Response
    {
        $categories = Category::all();
        $showProduct = $product->load('category', 'images');

        return Inertia::render('Product/Edit', compact('categories', 'showProduct'));
    }

    public function show(Product $product): Response
    {
        $showProduct = $product->load('category', 'images');

        return Inertia::render('Product/Show', compact('showProduct'));
    }

    /**
     * @throws ValidationException
     */
    public function update(Product $product, Request $request): RedirectResponse
    {
        $validated = $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'images' => 'nullable|exclude_if:image,null',
            'images*' => 'nullable|exclude_if:image,null|image|mimes:jpeg,png,jpg,svg,webp'
        ]);

        unset($validated['images']);
        $category = $validated['category_id'];
        unset($validated['category_id']);

        $product->category()->associate($category);

        $this->saveImage($request, $product);

        $product->fill($validated);
        $product->save();

        return Redirect::route("products.index");
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->images()->each(function ($image) {
            Storage::delete($image->getRawOriginal());
        });
        $product->images()->delete();
        $product->delete();
        return Redirect::route("products.index");
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return void
     */
    public function saveImage(Request $request, Product $product): void
    {
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $filename = time() . '_' . $imageFile->getClientOriginalName();
                $filename = "product-images\upload_" . $filename;

                $img = Image::make($imageFile)->resize(300, 300)->stream();
                Storage::put($filename, $img);

                $product->images()->create([
                    'path' => $filename
                ]);
            }
        }
    }
}
