<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructeur extends Model
{
    use HasFactory;

    protected $table = 'instructeur';
    public $timestamps = false;

    protected $fillable = [
        'Voornaam',
        'Tussenvoegsel',
        'Achternaam',
        'Mobiel',
        'DatumInDienst',
        'AantalSterren',
        'IsActief',
        'Opmerking'
    ];

    public function voertuigen()
    {
        return $this->belongsToMany(Voertuig::class, 'voertuig_instructeur', 'InstructeurId', 'VoertuigId')
                    ->withPivot('DatumToekenning');
    }

    public function getFullNameAttribute()
    {
        return $this->Voornaam . ' ' . ($this->Tussenvoegsel ? $this->Tussenvoegsel . ' ' : '') . $this->Achternaam;
    }
}
