<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stagiaire;
use App\Models\Contrat;
use App\Models\Autorisation;

class GrhController
{
    // ── Dashboard ──
    public function dashboard() {
        return redirect('/grh/stagiaires');
    }

    // ── Page vue stagiaires ──
    public function stagiaires(Request $request) {
        return view('grh.stagiaires');
    }

    // ── AJAX : liste des stagiaires ACTIFS ──
    public function listeStagiaires(Request $request) {
        $query = Stagiaire::with('sujet')->actifs();
        if ($request->search) {
            $s = $request->search;
            $query->where(function($q) use ($s) {
                $q->where('nom',    'LIKE', "%$s%")
                  ->orWhere('prenom','LIKE', "%$s%");
            });
        }
        return response()->json($query->orderBy('id','desc')->get());
    }

    // ── AJAX : liste des stagiaires ARCHIVÉS ──
    public function listeArchives(Request $request) {
        $query = Stagiaire::with('sujet')->archives();
        if ($request->search) {
            $s = $request->search;
            $query->where(function($q) use ($s) {
                $q->where('nom',    'LIKE', "%$s%")
                  ->orWhere('prenom','LIKE', "%$s%");
            });
        }
        return response()->json($query->orderBy('archived_at','desc')->get());
    }

    // ── Détail stagiaire ──
    public function showStagiaire($id) {
        $stagiaire = Stagiaire::with(['sujet','contrats','autorisations'])->findOrFail($id);
        return response()->json($stagiaire);
    }

    // ── Ajouter un stagiaire ──
    public function storeStagiaire(Request $request) {
        $request->validate([
            'nom'    => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
        ]);
        $data = $request->only([
            'nom','prenom','email','telephone','specialite',
            'periode_debut','periode_fin','lieu_naissance',
            'lieu_residence','journee','diplome','sujet_id',
        ]);
        $data['archived'] = false;
        $stagiaire = Stagiaire::create($data);
        return response()->json(['success' => true, 'stagiaire' => $stagiaire]);
    }

    // ── Modifier un stagiaire ──
    public function updateStagiaire(Request $request, $id) {
        $request->validate([
            'nom'    => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
        ]);
        $stagiaire = Stagiaire::findOrFail($id);
        $stagiaire->update($request->only([
            'nom','prenom','email','telephone','specialite',
            'periode_debut','periode_fin','lieu_naissance',
            'lieu_residence','journee','diplome','sujet_id',
        ]));
        return response()->json(['success' => true, 'stagiaire' => $stagiaire]);
    }

    // ── Archiver un stagiaire ──
    public function archiverStagiaire($id) {
        $stagiaire = Stagiaire::findOrFail($id);
        $stagiaire->update([
            'archived'    => true,
            'archived_at' => now(),
        ]);
        return response()->json(['success' => true, 'message' => 'Stagiaire archivé.']);
    }

    // ── Désarchiver un stagiaire ──
    public function desarchiverStagiaire($id) {
        $stagiaire = Stagiaire::findOrFail($id);
        $stagiaire->update([
            'archived'    => false,
            'archived_at' => null,
        ]);
        return response()->json(['success' => true, 'message' => 'Stagiaire désarchivé.']);
    }

    // ── Supprimer définitivement (archivé) ──
    public function forceDeleteStagiaire($id) {
        $stagiaire = Stagiaire::findOrFail($id);
        $stagiaire->delete();
        return response()->json(['success' => true, 'message' => 'Stagiaire supprimé définitivement.']);
    }

    // ── Supprimer un stagiaire actif ──
    public function destroyStagiaire($id) {
        $stagiaire = Stagiaire::findOrFail($id);
        $stagiaire->delete();
        return response()->json(['success' => true]);
    }

    // ── Sujets pour le select ──
    public function sujets() {
        $sujets = \App\Models\Sujet::select('id','sujet','domaine')->get();
        return response()->json($sujets);
    }

    // ────────────────────────────────────────
    // CONTRATS
    // ────────────────────────────────────────

    public function contrats(Request $request) {
    return view('grh.contrats');
}

public function listeContrats(Request $request) {
    $query = Contrat::with('stagiaire');

    if ($request->statut && $request->statut !== 'tous') {
        $query->where('statut', $request->statut);
    }

    if ($request->search) {
        $s = $request->search;
        $query->where(function($q) use ($s) {
            $q->where('nom',             'LIKE', "%$s%")
              ->orWhere('prenom',         'LIKE', "%$s%")
              ->orWhere('noms_stagiaires','LIKE', "%$s%")
              ->orWhereHas('stagiaire', function($q2) use ($s) {
                  $q2->where('nom',   'LIKE', "%$s%")
                     ->orWhere('prenom','LIKE', "%$s%");
              });
        });
    }

    return response()->json($query->orderBy('id','desc')->get());
}

public function destroyContrat($id) {
    Contrat::findOrFail($id)->delete();
    return response()->json(['success' => true]);
}

    public function storeContrat(Request $request) {
    $request->validate([
        'nom'        => 'required|string|max:100',
        'prenom'     => 'required|string|max:100',
        'date_debut' => 'required|date',
        'date_fin'   => 'required|date',
    ]);
    $contrat = Contrat::create([
        'nom'        => $request->nom,
        'prenom'     => $request->prenom,
        'date_debut' => $request->date_debut,
        'date_fin'   => $request->date_fin,
        'organisme'  => $request->organisme,
        'theme'      => $request->theme,
        'statut'     => 'en_attente',
    ]);
    return response()->json(['success' => true, 'contrat' => $contrat]);
    }

    public function validerContrat(Request $request, $id) {
        $contrat = Contrat::findOrFail($id);
        $contrat->update([
            'statut'          => 'valide',
            'valide_par'      => 'GRH',
            'date_validation' => now(),
            'notes'           => $request->notes,
        ]);
        $num = 'AUTH-'.date('Y').'-'.str_pad($contrat->id, 3, '0', STR_PAD_LEFT);
        Autorisation::firstOrCreate(
            ['contrat_id' => $contrat->id],
            [
                'stagiaire_id'        => $contrat->stagiaire_id,
                'contrat_id'          => $contrat->id,
                'date_emission'       => now()->toDateString(),
                'date_expiration'     => $contrat->date_fin,
                'numero_autorisation' => $num,
                'statut'              => 'active',
            ]
        );
        return response()->json(['success' => true, 'message' => 'Contrat validé et autorisation créée !']);
    }

    public function refuserContrat(Request $request, $id) {
        $contrat = Contrat::findOrFail($id);
        $contrat->update(['statut' => 'refuse', 'notes' => $request->notes]);
        return response()->json(['success' => true, 'message' => 'Contrat refusé.']);
    }

    public function importerPdf(Request $request, $id) {
        $request->validate(['pdf' => 'required|file|mimes:pdf|max:5120']);
        $contrat = Contrat::findOrFail($id);
        $nom = 'contrat_'.$id.'_'.time().'.pdf';
        $request->file('pdf')->move(public_path('contrats'), $nom);
        $contrat->update(['fichier_pdf' => $nom]);
        return response()->json(['success' => true, 'fichier' => $nom]);
    }

    // ────────────────────────────────────────
    // AUTORISATIONS
    // ────────────────────────────────────────

    public function autorisations(Request $request) {
    return view('grh.autorisations'); // retourne la VUE, pas du JSON
}

// ── AJAX : liste des autorisations ──
public function listeAutorisations(Request $request) {
    $query = Autorisation::with('stagiaire');
    if ($request->search) {
        $s = $request->search;
        $query->whereHas('stagiaire', function($q) use ($s) {
            $q->where('nom',   'LIKE', "%$s%")
              ->orWhere('prenom','LIKE', "%$s%");
        });
    }
    return response()->json($query->orderBy('id','desc')->get());
}

// ── Créer une autorisation ──
public function storeAutorisation(Request $request) {
    $request->validate([
        'stagiaire_id' => 'required|exists:stagiaires,id',
        'date_debut'   => 'required|date',
        'date_fin'     => 'required|date',
        'journee'      => 'required|string',
    ]);

    // Générer numéro automatique
    $count = Autorisation::whereYear('created_at', date('Y'))->count() + 1;
    $num   = 'AUTH-' . date('Y') . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);

    $auto = Autorisation::create([
        'stagiaire_id'        => $request->stagiaire_id,
        'date_debut'          => $request->date_debut,
        'date_fin'            => $request->date_fin,
        'journee'             => $request->journee,
        'lieu'                => $request->lieu ?? 'Département Formation',
        'acces_biblio'        => $request->acces_biblio ?? 'Autorisé',
        'numero_autorisation' => $num,
        'statut'              => 'active',
        'date_emission'       => now()->toDateString(),
    ]);

    return response()->json(['success' => true, 'autorisation' => $auto->load('stagiaire')]);
}

// ── Supprimer une autorisation ──
public function destroyAutorisation($id) {
    $auto = Autorisation::findOrFail($id);
    $auto->delete();
    return response()->json(['success' => true]);
}
public function imprimerAutorisation($id) {
        $auto = Autorisation::with('stagiaire','contrat')->findOrFail($id);
        return view('grh.autorisation-print', compact('auto'));
    }
public function storeMultipleContrats(Request $request) {
    $data = json_decode($request->getContent(), true);

    // Regrouper tous les noms en un seul champ
    $noms = array_map(function($s) {
        return $s['nom'] . ' ' . $s['prenom'];
    }, $data['stagiaires']);

    $contrat = Contrat::create([
        'noms_stagiaires' => implode(', ', $noms),
        'nom'             => $data['stagiaires'][0]['nom'],
        'prenom'          => $data['stagiaires'][0]['prenom'],
        'date_debut'      => $data['date_debut'],
        'date_fin'        => $data['date_fin'],
        'organisme'       => $data['organisme'] ?? null,
        'theme'           => $data['theme'] ?? null,
        'statut'          => 'en_attente',
    ]);
    return response()->json(['success' => true]);
}
public function conventionPdf($id) {
    $contrat = Contrat::findOrFail($id);
    return view('grh.convention-pdf', compact('contrat'));
}
}
