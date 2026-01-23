<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Author;

class AuthorController extends Controller
{
    public function createAuthor(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'author_name' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->user_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $author = Author::create([
            'user_id' => $user->id,
            'name' => $request->author_name,
        ]);

        return response()->json([
            'message' => 'Author and user created',
            'user' => $user,
            'author' => $author,
        ], 201);
    }
}