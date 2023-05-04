<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class product_images extends Model
{
    use HasFactory;

    protected $fillable = ["name", "data", "mime","product_id"];

    public function product(){
        return $this->BelongsToMany(Product::class);
    }
}
