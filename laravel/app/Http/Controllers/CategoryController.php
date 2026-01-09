<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['getCategories']); // Protect all except list (optional)
    }

    // GET /api/categories - Get all categories (public or protected list)
    public function getCategories(): JsonResponse
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    // POST /api/categories - Create new category
    public function createCategory(Request $request): JsonResponse
    {
        // Gate check for general create permission
        $this->authorize('categories.create');

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

        // Policy check: can this user view THIS specific category?
        $this->authorize('view', $category);

        return response()->json($category);
    }

    // PATCH /api/categories/{id} - Update category
    public function updateCategory(Request $request, $categoryId): JsonResponse
    {
        $category = Category::findOrFail($categoryId);

        // Gate check for general update permission
        $this->authorize('categories.update');

        // Policy check: can this user update THIS specific category?
        $this->authorize('update', $category);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255|unique:categories,name,' . $categoryId,
        ]);

        $category->update($validated);

        return response()->json($category);
    }

    // DELETE /api/categories/{id} - Delete category
    public function deleteCategory($categoryId): JsonResponse
    {
        $category = Category::findOrFail($categoryId);

        // Gate check for general delete permission
        $this->authorize('categories.delete');

        // Policy check: can this user delete THIS specific category?
        $this->authorize('delete', $category);

        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}