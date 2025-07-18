<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryAssociate extends Model
{
    protected $fillable = [
        "name",
    ];

    protected $table = 'category_associate';
}
