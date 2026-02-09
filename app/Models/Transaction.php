<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

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
        'amount' => 'decimal:2',
    ];

    protected $dates = ['transaction_date']; // Garante que seja tratado como um objeto Carbon

    public function setAmountAttribute($value)
    {
        if (is_string($value) && str_contains($value, ',')) {
            $value = str_replace('.', '', $value);
            $value = str_replace(',', '.', $value);
        }

        $this->attributes['amount'] = number_format((float) $value, 2, '.', '');
    }

    public function category():BelongsTo{
        return $this->belongsTo(Category::class);
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

    public static function registerTransaction(Account $account, $transactionDate = null){
        return DB::transaction(function () use ($account, $transactionDate) {
            // Exemplo de registro. Os valores reais devem vir do contexto ou parâmetros adicionais.
            $transaction = self::create([
                'account_id'  => $account->id,
                'user_id'     => auth()->id(),
                'category_id' => $account->category_id,
                'cashbox_id'  => 1,
                'type'        => $account->type == 'R' ? 'E':'S',
                'amount'      => $account->amount ?? 0,
                'description' => $account->description ?? 'Transação automática',
                'transaction_date' => $transactionDate ?? now(),
            ]);

            if($transaction){
                $cashBox = CashBox::findOrFail($transaction->cashbox_id);
                if($transaction->type == "E"){
                    $cashBox->incrementBalance($transaction->amount);
                }else{
                    $cashBox->decrementBalance($transaction->amount);
                }
            }

            return $transaction;
        });
    }
    public static function reverseTransaction(Account $account){
        return DB::transaction(function () use ($account) {
            $description = "(Estorno) ".$account->description;
            $transaction = self::create([
                'account_id'  => $account->id,
                'user_id'     => auth()->id(),
                'category_id' => $account->category_id,
                'cashbox_id'  => 1,
                'type'        => $account->type == 'R' ? 'S':'E',
                'amount'      => $account->amount,
                'description' => $description,
                'transaction_date' => now(),
            ]);

            if($transaction){
                $cashBox = CashBox::findOrFail($transaction->cashbox_id);
                if($transaction->type == "S"){
                    $cashBox->decrementBalance($transaction->amount);
                }else{
                    $cashBox->incrementBalance($transaction->amount);
                }
            }

            return $transaction;
        });
    }
}
