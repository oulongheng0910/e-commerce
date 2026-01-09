<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    // GET /api/products - Get all products
    public function getProducts(): JsonResponse
    {
        $products = Product::with('category') // Optional: eager load category
                          ->orderBy('name')
                          ->get();

        return response()->json($products);
    }

    // POST /api/products - Create new product
    public function createProduct(Request $request): JsonResponse
    {
        abort_unless(auth()->user()->can('products.create'), 403);
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'active'      => 'sometimes|boolean',
        ]);

        $product = Product::create($validated);

        return response()->json($product, 201);
    }

    // GET /api/products/{id}
    public function getProduct($productId): JsonResponse
    {
        $product = Product::with('category')->findOrFail($productId);

        return response()->json($product);
    }

    // PATCH /api/products/{id}
    public function updateProduct(Request $request, $productId): JsonResponse
    {
        abort_unless(auth()->user()->can('products.update'), 403);
        $product = Product::findOrFail($productId);

        $validated = $request->validate([
            'name'        => 'sometimes|required|string|max:255',
            'price'       => 'sometimes|required|numeric|min:0',
            'description' => 'nullable|string',
            'category_id' => 'sometimes|required|exists:categories,id',
            'active'      => 'sometimes|boolean',
        ]);

        $product->update($validated);

        return response()->json($product);
    }

    // DELETE /api/products/{id}
    public function deleteProduct($productId): JsonResponse
    {
        abort_unless(auth()->user()->can('products.delete'), 403);
        $product = Product::findOrFail($productId);
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}