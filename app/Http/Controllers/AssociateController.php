<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssociateStoreRequest;
use App\Models\Associate;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AssociateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $associates = Associate::all();
        return view('associate.index')->with('associates',$associates);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('associate.crud');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AssociateStoreRequest $request): RedirectResponse
    {
        try {
            $request->validated();
            $associate = Associate::create([
                'name' => $request->associate_name,
                'surname' => $request->associate_surname,
                'address' => $request->associate_address,
                'neighborhood' => $request->associate_neighborhood,
                'identity' => $request->associate_identity,
                'cpf' => $request->associate_cpf,
                'admission_date' => $request->associate_admission_date,
                'contact' => $request->associate_contact,
                'family_contact' => $request->associate_family_contact,
                'active' => $request->associate_active,
            ]);

            return Redirect::route('associate.index')->with('status', 'associate-updated');
        } catch (Exception $ex) {
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
            $associate = Associate::find($id);

            return view('associate.crud')->with('associate', $associate);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AssociateStoreRequest $request, string $id): RedirectResponse
    {
        try {
            $associate = Associate::findOrFail($id);

            $associate->update($request->validatedData());
            $associate->save();

            return Redirect::route('associate.index')->with('success', 'Registro atualizado com sucesso!');
        } catch (Exception $e) {
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
