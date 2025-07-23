<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssociateStoreRequest;
use App\Models\Associate;
use App\Models\CategoryAssociate;
use App\Models\TypeAssociate;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AssociateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($perPage = 10): View
    {
        $associates = Associate::paginate($perPage);
        return view('associate.index')->with('associates',$associates);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = CategoryAssociate::all();
        $types = TypeAssociate::all();
        return view('associate.crud')->with(['categories' => $categories, 'types' => $types]);
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
                'category_associate_id' => $request->category_associate_id,
                'vest_number' => $request->vest_number,
                'occupation' => $request->occupation,
                'birth_date' => $request->birth_date,
                'type_associate_id' => $request->type_associate_id,
            ]);

            $fotoPath = null;

            if ($request->hasFile('path_image')) {
                $ext = $request->file('path_image')->extension();
                $filename = "associados/{$associate->id}.{$ext}";

                Storage::disk('public')->putFileAs(
                    'associados',
                    $request->file('path_image'),
                    "{$associate->id}.{$ext}"
                );

                $fotoPath = $filename;

            }

            $associate->update([
                'path_image' => $fotoPath,
            ]);

            return Redirect::route('associate.index')->with('success', 'Associado cadastrado com sucesso!');
        } catch (Exception $ex) {
            return back()->with('error', 'Houve um erro ao cadastrar associado. '.$ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Associate $associate): View
    {
        $associate->load('mounthlyFees');
        return view('associate.show')->with('associate', $associate);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $associate = Associate::find($id);
            $categories = CategoryAssociate::all();
            $types = TypeAssociate::all();
            return view('associate.crud')->with(['associate'=>$associate,'categories'=>$categories,'types'=>$types]);
        } catch (Exception $e) {
            return back()->with('error', 'Houve um erro ao buscar associado. '.$e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AssociateStoreRequest $request, string $id): RedirectResponse
    {
        try {
            $associate = Associate::findOrFail($id);

            $dados = $request->validatedData();

            if (!$request->hasFile('path_image')) {
                unset($dados['path_image']);
            }

            $associate->update($dados);
            $associate->save();

            $fotoPath = null;

            if ($request->hasFile('path_image')) {
                $ext = $request->file('path_image')->extension();
                $filename = "associados/{$associate->id}.{$ext}";

                Storage::disk('public')->putFileAs(
                    'associados',
                    $request->file('path_image'),
                    "{$associate->id}.{$ext}"
                );

                $fotoPath = $filename;

                $associate->update([
                    'path_image' => $fotoPath,
                ]);
            }
            

            return Redirect::route('associate.index')->with('success', 'Registro atualizado com sucesso!');
        } catch (Exception $e) {
            return back()->with('error', 'Houve um erro ao atualizar associado. '.$e->getMessage());
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
