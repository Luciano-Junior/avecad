<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssociateStoreRequest;
use App\Models\Associate;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AssociateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('associate.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
