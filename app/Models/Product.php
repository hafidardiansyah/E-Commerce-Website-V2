<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['image', 'name', 'slug', 'price', 'description'];

    public function takeImage()
    {
        return "/storage/" . $this->image;
    }
}
