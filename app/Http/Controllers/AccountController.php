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
        $categories = Category::all();
        return view('account.crud')->with(['associates'=>$associates, 'categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountRequest $request): RedirectResponse
    {
        try {
            Account::create($request->validated());
            return Redirect::route('account.index')->with('success', 'Conta criada com sucesso!');
        } catch (\Exception $ex) {
            dd($ex->getMessage());
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
    public function edit(string $id): View
    {
        try {
            $account = Account::find($id);
            $categories = Category::all();
            $associates = Associate::all();
            return view('account.crud')->with([
                'account'=>$account, 
                'categories'=>$categories,
                'associates'=>$associates
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountRequest $request, string $id)
    {
        try {
            $account = Account::findOrFail($id);

            $account->update($request->validated());
            $account->save();

            return Redirect::route('account.index')->with('success', 'Registro atualizado com sucesso!');
        } catch (\Exception $e) {
            dd($e);
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
