<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
   protected $fillable = [
    'name',
    'description',
    'price',
    'images',
    'category_id',
];

    // Define relationship: a product belongs to one category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}