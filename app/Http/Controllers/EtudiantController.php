<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Etudiant;
use App\Http\Resources\Etudiant as EtudiantResource;
use App\Http\Resources\EtudiantCollection;
class EtudiantController extends Controller
{
    //
      public function index()
    {
        return new EtudiantCollection(Etudiant::all());
    }
    public function show($id)
    {
        return new EtudiantResource(Etudiant::findOrFail($id));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|max:100',
        ]);
        $request->validate([
            'prenom' => 'required|max:100',
        ]);

        $etudiant = Etudiant::create($request->all());

        return (new EtudiantResource($etudiant))
                ->response()
                ->setStatusCode(201);
    }
    public function delete($id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $etudiant->delete();

        return response()->json(null, 204);
    }
}
