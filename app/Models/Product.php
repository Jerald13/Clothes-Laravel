<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($product) {
            $product->category->increment("product_count");
        });

        static::deleted(function ($product) {
            $product->category->decrement("product_count");
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //     @foreach ($categories as $category)
    //     <tr>
    //         <td>{{ $category->name }}</td>
    //         <td>{{ $category->product_count }}</td>
    //     </tr>
    // @endforeach
}
