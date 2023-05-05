<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class product_images extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'product_id',
        'name',
        'data',
        'mime'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
