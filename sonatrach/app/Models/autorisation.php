<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Autorisation extends Model {
    protected $fillable = [
        'stagiaire_id','contrat_id',
        'date_emission','date_expiration',
        'numero_autorisation','statut'
    ];
    public function stagiaire() {
        return $this->belongsTo(Stagiaire::class);
    }
    public function contrat() {
        return $this->belongsTo(Contrat::class);
    }
}
