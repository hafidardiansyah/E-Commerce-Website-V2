<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'image', 'name', 'slug', 'price', 'description'];

    public function takeImage()
    {
        return "/storage/" . $this->image;
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
