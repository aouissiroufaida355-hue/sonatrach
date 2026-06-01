<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stagiaire extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'nom', 'prenom', 'email', 'telephone', 'specialite',
        'periode_debut', 'periode_fin', 'lieu_naissance',
        'lieu_residence', 'journee', 'diplome', 'sujet_id',
        'annee_proposee', 'description', 'description_detaillee',
        'statut', 'encadrant_id', 'archived', 'archived_at',
    ];

    // Scope : seulement les actifs
    public function scopeActifs($query) {
        return $query->where('archived', false);
    }

    // Scope : seulement les archivés
    public function scopeArchives($query) {
        return $query->where('archived', true);
    }

    public function sujet() {
        return $this->belongsTo(Sujet::class);
    }

    public function contrats() {
        return $this->hasMany(Contrat::class);
    }

    public function autorisations() {
        return $this->hasMany(Autorisation::class);
    }
}
