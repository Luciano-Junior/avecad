<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\CashBox;
use App\Models\Categorie;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('transaction.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('transaction.crud')->with(['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            $data['user_id'] = auth()->id();
            $data['cashbox_id'] = 1;

            $transaction = Transaction::create($data);

            if($transaction){
                $cashBox = CashBox::findOrFail($transaction->cashbox_id);
                if($transaction->type == "E"){
                    $cashBox->incrementBalance($transaction->amount);
                }else{
                    $cashBox->decrementBalance($transaction->amount);
                }
            }

            DB::commit();

            return Redirect::route('transaction.index')->with('success', 'Registro criado com sucesso!');
        } catch (\Exception $ex) {
            DB::rollBack();
            return back()->with('error', 'Houve um erro ao cadastrar movimentação. '.$ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transaction = Transaction::find($id);
        $categories = Category::all();
        return view('transaction.crud')->with(['categories'=>$categories, "transaction"=>$transaction]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $transaction = Transaction::findOrFail($id);

            // Valores antigos
            $oldAmount = $transaction->getOriginal('amount');
            $oldType = $transaction->getOriginal('type');

            // Preencher com os novos dados (sem salvar ainda)
            $transaction->fill($request->validated());

            $newAmount = $transaction->amount;
            $newType = $transaction->type;

            // Atualiza saldo do caixa somente se houve mudança em amount ou type
            if ($oldAmount != $newAmount || $oldType != $newType) {
                $cashBox = CashBox::findOrFail($transaction->cashbox_id);
                // Estornar o valor antigo
                if ($oldType === 'E') {
                    $cashBox->decrementBalance($oldAmount);
                } else {
                    $cashBox->incrementBalance($oldAmount);
                }

                // Aplicar o novo valor
                if ($newType === 'E') {
                    $cashBox->incrementBalance($newAmount);
                } else {
                    $cashBox->decrementBalance($newAmount);
                }
            }

            // Salva a transação atualizada
            $transaction->save();

            DB::commit();

            return Redirect::route('transaction.index')->with('success', 'Registro atualizado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return back()->with('error', 'Houve um erro ao atualizar movimentação. '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
