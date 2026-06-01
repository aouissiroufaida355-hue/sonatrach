<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sujet;
use App\Models\Stagiaire;

class SujetController
{
    public function index() {
        return view('encadrant.sujets');
    }

    public function liste(Request $request) {
        $query = Sujet::with(['stagiaire', 'stagiaires']);
        if ($request->statut && $request->statut !== 'tous') {
            $query->where('statut', $request->statut);
        }
        if ($request->search) {
            $s = $request->search;
            $query->where(function($q) use ($s) {
                $q->where('sujet',        'LIKE', "%$s%")
                  ->orWhere('domaine',    'LIKE', "%$s%")
                  ->orWhere('propose_par','LIKE', "%$s%");
            });
        }
        return response()->json($query->orderBy('id','desc')->get());
    }

    public function show($id) {
        return response()->json(
            Sujet::with(['stagiaire','stagiaires'])->findOrFail($id)
        );
    }

    public function store(Request $request) {
        $request->validate([
            'domaine'        => 'required',
            'sujet'          => 'required',
            'propose_par'    => 'required',
            'annee_proposee' => 'required|digits:4',
            'description'    => 'nullable',
        ]);
        $sujet = Sujet::create($request->all());
        return response()->json(['success'=>true,'sujet'=>$sujet]);
    }

    public function update(Request $request, $id) {
        $sujet = Sujet::findOrFail($id);
        $sujet->update($request->all());
        return response()->json(['success'=>true,'sujet'=>$sujet]);
    }

    public function destroy($id) {
        Sujet::findOrFail($id)->delete();
        return response()->json(['success'=>true]);
    }

    public function stagiaires() {
        return response()->json(Stagiaire::all());
    }

    public function attribuer(Request $request) {
        $request->validate([
            'sujet_id'   => 'required|exists:sujets,id',
            'stagiaires' => 'required',
        ]);

        $sujet      = Sujet::findOrFail($request->sujet_id);
        $stagiaires = json_decode($request->stagiaires, true);

        if (empty($stagiaires)) {
            return response()->json(['success'=>false,'message'=>'Aucun stagiaire'], 422);
        }

        $ids = [];
        foreach ($stagiaires as $nomComplet) {
            $parties = explode(' ', trim($nomComplet), 2);
            $nom    = trim($parties[0] ?? '');
            $prenom = trim($parties[1] ?? '');
            if ($nom && $prenom) {
                $stag = Stagiaire::firstOrCreate(
                    ['nom' => $nom, 'prenom' => $prenom]
                );
                $ids[] = $stag->id;
            }
        }

        if (empty($ids)) {
            return response()->json(['success'=>false,'message'=>'Aucun stagiaire valide'], 422);
        }

        // Lier TOUS les stagiaires via table pivot
        $sujet->stagiaires()->sync($ids);

        // Premier dans stagiaire_id pour compatibilité
        $sujet->update([
            'stagiaire_id' => $ids[0],
            'statut'       => 'attribue',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Attribution réussie !',
            'sujet'   => $sujet->load('stagiaires'),
        ]);
    }
}
