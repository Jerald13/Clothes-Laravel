<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = ["name", "category_id", "price", "description","update_at"];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function scopePriceLessThan($query, $price)
    {
        return $query->where("price", "<", $price);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
