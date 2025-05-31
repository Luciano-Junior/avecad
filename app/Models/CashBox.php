<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashBox extends Model
{
   protected $fillable = [
    'name',
    'balance'
   ];

   public function incrementBalance($value){
    $this->increment('balance', $value);
   }
   public function decrementBalance($value){
    $this->decrement('balance', $value);
   }
}
