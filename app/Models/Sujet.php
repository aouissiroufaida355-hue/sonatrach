<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Sujet extends Model
{
    protected $fillable = [
        'domaine','sujet','propose_par','annee_proposee',
        'description','description_detaillee','statut',
        'stagiaire_id','encadrant_id'
    ];

    // TOUS les stagiaires via table pivot
    public function stagiaires() {
        return $this->belongsToMany(
            Stagiaire::class,
            'sujet_stagiaire',
            'sujet_id',
            'stagiaire_id'
        );
    }

    // Premier stagiaire (compatibilité)
    public function stagiaire() {
        return $this->belongsTo(Stagiaire::class);
    }
}
