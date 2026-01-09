<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

// Public login route for Passport (no auth required)
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $user = Auth::user();

    // Create Passport token (correct way)
    $tokenResult = $user->createToken('Personal Access Token');
    $token = $tokenResult->accessToken;  // Passport access token

    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer',
        'expires_in' => $tokenResult->token->expires_at ? $tokenResult->token->expires_at->timestamp - time() : null,
    ]);
});

// Protected routes (require Bearer token from Passport)
Route::middleware('auth:api')->group(function () {
    // Get current user + roles (for testing)
    Route::get('/me', function (Request $request) {
        return $request->user()->load('roles');
    })->name('me');

    // Category routes (protected + RBAC via Gates/Policies)
    Route::controller(CategoryController::class)->prefix('categories')->group(function () {
        Route::get('/', 'getCategories');
        Route::post('/', 'createCategory');
        Route::get('/{categoryId}', 'getCategory');
        Route::patch('/{categoryId}', 'updateCategory');
        Route::delete('/{categoryId}', 'deleteCategory');
        Route::get('/categories/{categoryId}/products', [CategoryController::class, 'getCategoryProducts']);
    });

    // Product routes (protected + RBAC)
    Route::controller(ProductController::class)->prefix('products')->group(function () {
        Route::get('/', 'getProducts');
        Route::post('/', 'createProduct');
        Route::get('/{productId}', 'getProduct');
        Route::patch('/{productId}', 'updateProduct');
        Route::delete('/{productId}', 'deleteProduct');
    });
});