<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Editor extends User
{
    use HasFactory;

    protected $attributes = [
        "name" => "Editor",
        "role" => "1",
    ];

    public function isEditor()
    {
        return true;
    }
}
