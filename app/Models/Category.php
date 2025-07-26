<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        "name",
        "description",
        "type_category_id",
    ];

    public function getIdByName($name){
        return Category::where('name',$name)->value('id');
    }

    public function typeCategory()
    {
        return $this->belongsTo(TypeCategory::class, 'type_category_id');
    }
}
