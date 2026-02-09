<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

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
        return $this->belongsTo(Category::class);
    }

    public function associate():BelongsTo{
        return $this->belongsTo(Associate::class);
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

    public static function payAccount(Account $account, $transactionDate = null){
        DB::beginTransaction();
        try {
            $accountReceive = Account::findOrFail($account->id);

            $accountReceive->status = 'Pago';
            $accountReceive->save();

            Transaction::registerTransaction($accountReceive, $transactionDate);
            
            DB::commit();

            return [
                'status'=>'success',
                'message'=>'Registro atualizado com sucesso!',
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'status'=>'error',
                'message'=>'Erro ao receber pagamento: '.$e->getMessage(),
            ];
        }
    }

    public static function reversePayment(Account $account){
        DB::beginTransaction();
        try {
            $accountReverse = Account::findOrFail($account->id);

            $accountReverse->status = 'Pendente';
            $accountReverse->save();

            Transaction::reverseTransaction($accountReverse);
            
            DB::commit();

            return [
                'status'=>'success',
                'message'=>'Registro estornado com sucesso!',
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'status'=>'error',
                'message'=>'Erro ao estornar pagamento: '.$e->getMessage(),
            ];
        }
    }
}
