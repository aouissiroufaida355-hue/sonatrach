<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Rendezvous extends Model
{
    protected $table = 'rendezvous';

    protected $fillable = [
        'nom_stagiaire',
        'prenom_stagiaire',
        'date_rdv',
        'heure_rdv',
        'objet',
        'rapport',
        'has_rapport',
    ];
}
