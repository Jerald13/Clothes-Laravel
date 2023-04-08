<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'size';

    protected $fillable = [
        'size'
    ];

    public function stock()
    {
        return $this->belongsToMany(Stock::class);
    }

      

}
