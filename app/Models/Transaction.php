<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'account_id',
        'user_id',
        'category_id',
        'cashbox_id',
        'description',
        'type',
        'amount',
        'transaction_date',
    ];

    protected $casts = [
        'transaction_date' => 'date',
    ];

    protected $dates = ['transaction_date']; // Garante que seja tratado como um objeto Carbon

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = str_replace(',', '.', $value);
    }

    public function category():BelongsTo{
        return $this->belongsTo(Categorie::class);
    }

    public function getTransactionDateFormatAttribute()
    {
        return $this->transaction_date ? $this->transaction_date->format('d/m/Y') : null;
    }

    public function getTypeFormatAttribute()
    {
        return $this->type == "E" ? "Entrada" : "Saídas";
    }

    public function getAmountFormatAttribute(){
        $amountFormat = str_replace(".",",", $this->amount);
        return $amountFormat;
    }
}
