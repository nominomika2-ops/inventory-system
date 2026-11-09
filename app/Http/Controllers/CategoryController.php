<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    // Display all categories
    public function index()
    {
        $categories = Category::with('products')->get();

        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    // Show create form
    public function create()
    {
        return view('categories.create');
    }

    // Save new category
    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category added successfully!');
    }

    // Show edit form
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Update category
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category updated successfully!');
    }

    // Delete category
    public function destroy(Category $category)
    {
        if ($category->products()->count() > 0) {
            return back()->with(
                'error',
                'Cannot delete this category because it has products.'
            );
        }

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category deleted successfully!');
    }
}
