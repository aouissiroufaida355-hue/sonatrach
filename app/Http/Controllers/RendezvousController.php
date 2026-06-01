<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rendezvous;

class RendezvousController
{
    public function index()
    {
        return view('encadrant.rendezvous');
    }

    public function liste(Request $request)
    {
        $query = Rendezvous::query();
        if ($request->search) {
            $s = $request->search;
            $query->where(function($q) use ($s) {
                $q->where('nom_stagiaire',    'LIKE', "%$s%")
                  ->orWhere('prenom_stagiaire','LIKE', "%$s%")
                  ->orWhere('objet',           'LIKE', "%$s%");
            });
        }
        return response()->json($query->orderBy('date_rdv','desc')->get());
    }

    public function show($id)
    {
        return response()->json(Rendezvous::findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_stagiaire'    => 'required',
            'prenom_stagiaire' => 'required',
            'date_rdv'         => 'required|date',
            'heure_rdv'        => 'required',
            'objet'            => 'required',
        ]);

        $rdv = Rendezvous::create([
            'nom_stagiaire'    => $request->nom_stagiaire,
            'prenom_stagiaire' => $request->prenom_stagiaire,
            'date_rdv'         => $request->date_rdv,
            'heure_rdv'        => $request->heure_rdv,
            'objet'            => $request->objet,
            'has_rapport'      => 0,
        ]);

        return response()->json(['success' => true, 'rdv' => $rdv]);
    }

    public function update(Request $request, $id)
    {
        $rdv = Rendezvous::findOrFail($id);
        $rdv->update([
            'nom_stagiaire'    => $request->nom_stagiaire,
            'prenom_stagiaire' => $request->prenom_stagiaire,
            'date_rdv'         => $request->date_rdv,
            'heure_rdv'        => $request->heure_rdv,
            'objet'            => $request->objet,
        ]);
        return response()->json(['success' => true, 'rdv' => $rdv]);
    }

    public function ajouterRapport(Request $request, $id)
    {
        $request->validate(['rapport' => 'required|min:5']);
        $rdv = Rendezvous::findOrFail($id);
        $rdv->update([
            'rapport'     => $request->rapport,
            'has_rapport' => 1,
        ]);
        return response()->json(['success' => true, 'rdv' => $rdv]);
    }

    public function destroy($id)
    {
        Rendezvous::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }
}
