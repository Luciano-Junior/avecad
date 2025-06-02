<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
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

    public function getAmountMonthlyFee(){
        return Configuration::where('key','valor_mensalidade')->value('value');
    }

    public function getDueDay(){
        return Configuration::where('key','dia_vencimento_padrao')->value('value');
    }
}
