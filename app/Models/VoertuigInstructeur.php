<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoertuigInstructeur extends Model
{
    use HasFactory;

    protected $table = 'voertuig_instructeur';
    public $timestamps = false;

    protected $fillable = [
        'VoertuigId',
        'InstructeurId',
        'DatumToekenning',
        'IsActief',
        'Opmerking'
    ];

    public function voertuig()
    {
        return $this->belongsTo(Voertuig::class, 'VoertuigId');
    }

    public function instructeur()
    {
        return $this->belongsTo(Instructeur::class, 'InstructeurId');
    }
}
