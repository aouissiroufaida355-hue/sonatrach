<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    public $timestamps = false;

    protected $fillable = [
    'noms_stagiaires',
    'stagiaire_id',
    'nom',
    'prenom',
    'date_debut',
    'date_fin',
    'statut',
    'valide_par',
    'date_validation',
    'notes',
    'fichier_pdf',
    'organisme',
    'theme',
    ];

    public function stagiaire() {
        return $this->belongsTo(Stagiaire::class);
    }
}
