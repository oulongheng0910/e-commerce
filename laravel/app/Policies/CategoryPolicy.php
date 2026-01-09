<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    public function view(User $user, Category $category): bool
    {
        if ($user->hasRole('manager')) {
            return $category->created_by === $user->id;  // Manager can view own categories
        }
        if ($user->hasRole('staff')) {
            return $category->assigned_to === $user->id;  // Staff can view assigned
        }
        return false;
    }

    public function updateStatus(User $user, Category $category): bool
    {
        return $user->hasRole('staff') && $category->assigned_to === $user->id;  // Staff can update status of assigned
    }

    // Add more methods if needed, e.g., create, update, delete
    public function create(User $user): bool
    {
        return $user->hasRole('manager') || $user->hasRole('admin');
    }

    public function update(User $user, Category $category): bool
    {
        return $user->hasRole('manager') && $category->created_by === $user->id;  // Manager updates own
    }

    public function delete(User $user, Category $category): bool
    {
        return $user->hasRole('admin');  // Only admin deletes
    }
}