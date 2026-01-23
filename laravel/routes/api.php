<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AudienceController;
use App\Http\Controllers\CommentController;

// Public routes (no authentication required)
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $user = Auth::user();

    $tokenResult = $user->createToken('Personal Access Token');
    $token = $tokenResult->accessToken;

    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer',
        'expires_in' => $tokenResult->token->expires_at 
            ? $tokenResult->token->expires_at->timestamp - time() 
            : null,
    ]);
});

// Protected routes (require valid Passport Bearer token)
Route::middleware('auth:api')->group(function () {

    Route::get('/me', function (Request $request) {
        return $request->user()->load('roles');
    })->name('me');

    // Task 3: Author APIs
    Route::prefix('authors')->controller(AuthorController::class)->group(function () {
        Route::post('/', 'createAuthor');
    });

    // Task 3: Article APIs
    Route::prefix('articles')->controller(ArticleController::class)->group(function () {
        Route::post('/', 'createArticle');
    });

    // Task 3: Audience APIs
    Route::prefix('audiences')->controller(AudienceController::class)->group(function () {
        Route::post('/', 'createAudience');
    });

    // Task 3: Subscribe API
    Route::post('/subscribe', [AudienceController::class, 'subscribeArticle']);

    // Task 3: Comment APIs (create only)
    Route::prefix('comments')->controller(CommentController::class)->group(function () {
        Route::post('/', 'createComment');
    });

    // ────────────────────────────────────────────────
    // Task 3: Final 5 GET query APIs (clean paths, inside protected group)
    // ────────────────────────────────────────────────

    Route::get('/author-sao/articles', [ArticleController::class, 'getArticlesBySao']);
    Route::get('/article-climate/audiences', [AudienceController::class, 'getAudiencesOfClimateArticle']);
    Route::get('/author-sok/audiences', [AudienceController::class, 'getAudiencesOfSok']);
    Route::get('/audience-samnang/comments', [CommentController::class, 'getCommentsOfSamnang']);
    Route::get('/comments/with-topic', [CommentController::class, 'getCommentsWithTopic']);

    // Your existing Category & Product routes
    Route::prefix('categories')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'getCategories');
        Route::post('/', 'createCategory');
        Route::get('/{categoryId}', 'getCategory');
        Route::patch('/{categoryId}', 'updateCategory');
        Route::delete('/{categoryId}', 'deleteCategory');
        Route::get('/{categoryId}/products', 'getCategoryProducts');
    });

    Route::prefix('products')->controller(ProductController::class)->group(function () {
        Route::get('/', 'getProducts');
        Route::post('/', 'createProduct');
        Route::get('/{productId}', 'getProduct');
        Route::patch('/{productId}', 'updateProduct');
        Route::delete('/{productId}', 'deleteProduct');
    });
});