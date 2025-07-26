<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeCategory extends Model
{
    protected $fillable = [
        "name",
    ];

    protected $table = 'type_categories';
}
