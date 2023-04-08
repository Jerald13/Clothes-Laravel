<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
    protected $table = 'stock';

    protected $fillable = [
        'color_id',
        'size_id',
        'product_id',
        'quantity'
    ];

    public function product()
    {
        return $this->belongsToMany(Product::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

      

}
