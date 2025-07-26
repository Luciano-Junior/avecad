<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    public function getAmountMonthlyFee(){
        return Configuration::where('key','valor_mensalidade')->value('value');
    }

    public function getDueDay(){
        return Configuration::where('key','dia_vencimento_padrao')->value('value');
    }

    public static function getCategoryIdMonthlyFee(){
        return Configuration::where('key','categoria_mensalidade_id')->value('value');
    }
}
