<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Associate;
use App\Models\Category;
use App\Models\Configuration;
use Carbon\Carbon;

class MonthlyFeesService
{
    public function generate(int $quantity, String $start_month, Associate $associate){
        $mensalidades = [];
        $configuration = new Configuration();
        $category = new Category();
        $amount = (float) $configuration->getAmountMonthlyFee();
        $categoryId = $category->getIdByName('Mensalidade');
        $description = "Mensalidade ".$associate->name;
        $type = "R";
        $status = "Pendente";
        $diaVencimento = (int)$configuration->getDueDay();

        $inicio = Carbon::createFromFormat('Y-m', $start_month)->startOfMonth();
        
        for ($i=0; $i < $quantity; $i++) { 
            $referenciaBase = (clone $inicio)->addMonthNoOverflow($i);

            // Define o vencimento com base no dia configurado
            $vencimento = $referenciaBase->copy()->setDay($diaVencimento);

            // Corrige para o último dia do mês se o dia for inválido
            if ($vencimento->month !== $referenciaBase->month) {
                $vencimento = $referenciaBase->copy()->endOfMonth();
            }

            $existe = Account::where('associate_id', $associate->id)
                ->whereDate('due_date', $vencimento->toDateString())
                ->exists();

            if (!$existe) {
                $mensalidades[] = [
                    'associate_id' => $associate->id,
                    'category_id' => $categoryId,
                    'description' => $description,
                    'type' => $type,
                    'amount' => $amount,
                    'due_date' => $vencimento,
                    'status' => $status,
                    'created_at' => now(),
                ];
            }
            
        }
        // Inserção em massa
        if (!empty($mensalidades)) {
            Account::insert($mensalidades);
            return [
                'status' => 'success',
                'message' => count($mensalidades) . ' mensalidade(s) gerada(s) com sucesso!',
            ];
        }
        
        if ($quantity === 1) {
            return [
                'status' => 'info',
                'message' => 'A mensalidade deste mês já existe. Nenhuma nova foi gerada.',
            ];
        }

        return [
            'status' => 'info',
            'message' => 'Todas as mensalidades já estavam geradas. Nenhuma nova foi inserida.',
        ];
    }
}
