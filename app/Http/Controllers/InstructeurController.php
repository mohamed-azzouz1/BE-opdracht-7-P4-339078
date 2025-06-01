<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instructeur;

class InstructeurController extends Controller
{
    public function index()
    {
        // Get all instructeurs sorted by AantalSterren in descending order
        $instructeurs = Instructeur::where('IsActief', true)
                          ->orderByRaw('LENGTH(AantalSterren) DESC, AantalSterren DESC')
                          ->get();
        
        return view('instructeurs.index', compact('instructeurs'));
    }

    public function show($id)
    {
        $instructeur = Instructeur::findOrFail($id);
        return view('instructeurs.show', compact('instructeur'));
    }
}
