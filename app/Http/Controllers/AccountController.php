<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\Models\Account;
use App\Models\Associate;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('account.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $associates = Associate::all();
        $categories = Category::with('typeCategory')->get()->groupBy('typeCategory.name');
        return view('account.crud')->with(['associates'=>$associates, 'categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $typeCategory = Category::find($data['category_id'])->typeCategory->name;
            $data['type'] = ($typeCategory == "Receita" || $typeCategory == "Receitas") ? "R" : "P";

            Account::create($data);
            return Redirect::route('account.index')->with('success', 'Conta criada com sucesso!');
        } catch (\Exception $ex) {
            return back()->with('error', 'Houve um erro ao cadastrar conta. '.$ex->getMessage());
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
        try {
            $account = Account::find($id);
            $categories = Category::with('typeCategory')->get()->groupBy('typeCategory.name');
            $associates = Associate::all();
            return view('account.crud')->with([
                'account'=>$account, 
                'categories'=>$categories,
                'associates'=>$associates
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Houve um erro ao buscar conta. '.$e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountRequest $request, string $id)
    {
        try {
            $account = Account::findOrFail($id);

            $data = $request->validated();
            $typeCategory = Category::find($data['category_id'])->typeCategory->name;
            $data['type'] = ($typeCategory == "Receita" || $typeCategory == "Receitas") ? "R" : "P";

            $account->update($data);
            $account->save();

            return Redirect::route('account.index')->with('success', 'Registro atualizado com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Houve um erro ao atualizar conta. '.$e->getMessage());
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
