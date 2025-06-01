<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeVoertuig extends Model
{
    use HasFactory;

    protected $table = 'type_voertuig';
    public $timestamps = false;

    protected $fillable = [
        'TypeVoertuig',
        'Rijbewijscategorie',
        'IsActief',
        'Opmerking'
    ];

    public function voertuigen()
    {
        return $this->hasMany(Voertuig::class, 'TypeVoertuigId');
    }
}
