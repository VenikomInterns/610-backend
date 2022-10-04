<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    public function index(): Response
    {
        $categories = Category::all();

        return Inertia::render('Category/Index', compact('categories'));
    } //good

    /**
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validate($request, [
            'name' => 'required',
        ]);

        Category::query()->create($validated);

        return Redirect::route("categories.index");
    }//good

    public function edit(Category $category): Response
    {
        return Inertia::render('Category/Edit', compact('category'));
    }//good

    /**
     * @throws ValidationException
     */
    public function update(Category $category, Request $request): RedirectResponse
    {
        $validated = $this->validate($request, [
            'name' => 'required'
        ]);

        $category->fill($validated);

        $category->save();

        return Redirect::route("categories.index");
    }//good

    public function destroy(Category $category): RedirectResponse
    {
        //what to do with products that has this category
        $category->delete();

        return Redirect::route("categories.index");
    }
}
