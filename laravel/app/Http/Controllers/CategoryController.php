<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    // GET /api/categories - Get all categories
    public function getCategories(): JsonResponse
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    // POST /api/categories - Create new category
    public function createCategory(Request $request): JsonResponse
    {
        abort_unless(auth()->user()?->can('categories.create'), 403, 'Unauthorized');
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        $category = Category::create($validated);

        return response()->json($category, 201);
        
    }

    // GET /api/categories/{id} - Get single category
    public function getCategory($categoryId): JsonResponse
    {
        $category = Category::findOrFail($categoryId);

        return response()->json($category);
    }

    // PATCH /api/categories/{id} - Update category
    public function updateCategory(Request $request, $categoryId): JsonResponse
    {
        abort_unless(auth()->user()?->can('categories.update'), 403, 'Unauthorized')
        $category = Category::findOrFail($categoryId);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255|unique:categories,name,' . $categoryId,
        ]);

        $category->update($validated);

        return response()->json($category);
    }

    // DELETE /api/categories/{id} - Delete category
    public function deleteCategory($categoryId): JsonResponse
    {
        abort_unless(auth()->user()?->can('categories.delete'), 403, 'Unauthorized');
        $category = Category::findOrFail($categoryId);
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}