<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $table = "orders";

    public function takeImage()
    {
        return "/storage/" . $this->image;
    }

    public function delivery()
    {
        return $this->hasMany(Delivery::class, 'payment_status');
    }
}
