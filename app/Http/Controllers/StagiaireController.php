<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stagiaire;
use App\Models\Sujet;

class StagiaireController
{
    public function index()
    {
        return view('encadrant.stagiaires');
    }

    public function liste(Request $request)
    {
        $query = Stagiaire::with('sujet');
        if ($request->search) {
            $s = $request->search;
            $query->where(function($q) use ($s) {
                $q->where('nom',    'LIKE', "%$s%")
                  ->orWhere('prenom','LIKE', "%$s%");
            });
        }
        return response()->json($query->orderBy('id','desc')->get());
    }

    public function show($id)
    {
        return response()->json(
            Stagiaire::with('sujet')->findOrFail($id)
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'    => 'required',
            'prenom' => 'required',
        ]);
        $stagiaire = Stagiaire::create($request->all());
        return response()->json(['success' => true, 'stagiaire' => $stagiaire]);
    }

    public function update(Request $request, $id)
    {
        $stagiaire = Stagiaire::findOrFail($id);
        $stagiaire->update($request->all());
        return response()->json(['success' => true, 'stagiaire' => $stagiaire]);
    }

    public function destroy($id)
    {
        Stagiaire::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    public function sujetsDisponibles()
    {
        return response()->json(
            Sujet::all(['id', 'sujet', 'domaine'])
        );
    }
}
