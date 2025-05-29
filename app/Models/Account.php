<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account extends Model
{
    protected $fillable = [
        'associate_id',
        'user_id',
        'category_id',
        'description',
        'type',
        'amount',
        'due_date',
        'status',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    protected $dates = ['due_date']; // Garante que seja tratado como um objeto Carbon

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = str_replace(',', '.', $value);
    }

    public function category():BelongsTo{
        return $this->belongsTo(Categorie::class);
    }

    public function getDueDateFormatAttribute()
    {
        return $this->due_date ? $this->due_date->format('d/m/Y') : null;
    }

    public function getTypeFormatAttribute()
    {
        return $this->type == "R" ? "A receber" : "A pagar";
    }

    public function getAmountFormatAttribute(){
        $amountFormat = str_replace(".",",", $this->amount);
        return $amountFormat;
    }
}
