<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model {
    protected $fillable = [
        'stagiaire_id','date_debut','date_fin',
        'statut','fichier_pdf','notes',
        'valide_par','date_validation'
    ];
    public function stagiaire() {
        return $this->belongsTo(Stagiaire::class);
    }
    public function autorisation() {
        return $this->hasOne(Autorisation::class);
    }
}
