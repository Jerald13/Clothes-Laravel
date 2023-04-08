<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    public $table = "categories";

    protected $fillable = ["name", "status"];

    // protected $fillable = ["name", "slug"];

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function a(){
        $category = new Category();
        $category->products();
    }
}
