<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voertuig extends Model
{
    use HasFactory;

    protected $table = 'voertuig';
    public $timestamps = false;

    protected $fillable = [
        'Kenteken',
        'Type',
        'Bouwjaar',
        'Brandstof',
        'TypeVoertuigId',
        'IsActief',
        'Opmerking'
    ];

    public function typeVoertuig()
    {
        return $this->belongsTo(TypeVoertuig::class, 'TypeVoertuigId');
    }

    public function instructeurs()
    {
        return $this->belongsToMany(Instructeur::class, 'voertuig_instructeur', 'VoertuigId', 'InstructeurId')
                    ->withPivot('DatumToekenning');
    }
}
