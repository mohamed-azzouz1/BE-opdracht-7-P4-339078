<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voertuig;
use App\Models\Instructeur;
use App\Models\TypeVoertuig;
use App\Models\VoertuigInstructeur;
use Illuminate\Support\Facades\DB;

class VoertuigController extends Controller
{
    public function index()
    {
        // Main page for vehicles
        $voertuigen = Voertuig::all();
        return view('voertuigen.index', compact('voertuigen'));
    }

    public function getVoertuigenByInstructeur($instructeurId)
    {
        $instructeur = Instructeur::findOrFail($instructeurId);
        
        $voertuigen = DB::table('voertuig_instructeur')
            ->join('voertuig', 'voertuig_instructeur.VoertuigId', '=', 'voertuig.id')
            ->join('type_voertuig', 'voertuig.TypeVoertuigId', '=', 'type_voertuig.id')
            ->where('voertuig_instructeur.InstructeurId', '=', $instructeurId)
            ->where('voertuig.IsActief', '=', true)
            ->select(
                'voertuig.id',
                'voertuig.Kenteken',
                'voertuig.Type',
                'voertuig.Bouwjaar',
                'voertuig.Brandstof',
                'type_voertuig.TypeVoertuig',
                'type_voertuig.Rijbewijscategorie'
            )
            ->orderBy('type_voertuig.Rijbewijscategorie')
            ->get();
        
        return view('voertuigen.instructeur_voertuigen', compact('instructeur', 'voertuigen'));
    }

    public function edit($id)
    {
        $voertuig = Voertuig::findOrFail($id);
        $typeVoertuigen = TypeVoertuig::all();
        
        // Get the instructeur ID for the return path
        $voertuigInstructeur = VoertuigInstructeur::where('VoertuigId', $id)->first();
        $instructeurId = $voertuigInstructeur ? $voertuigInstructeur->InstructeurId : null;
        
        return view('voertuigen.edit', compact('voertuig', 'typeVoertuigen', 'instructeurId'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Kenteken' => 'required|string|max:20',
            'Type' => 'required|string|max:100',
            'Bouwjaar' => 'required|date',
            'Brandstof' => 'required|string|max:20',
            'TypeVoertuigId' => 'required|exists:type_voertuig,id',
        ]);

        $voertuig = Voertuig::findOrFail($id);
        $voertuig->update($request->all());

        // Get the instructeur ID for redirect
        $voertuigInstructeur = VoertuigInstructeur::where('VoertuigId', $id)->first();
        $instructeurId = $voertuigInstructeur ? $voertuigInstructeur->InstructeurId : null;

        if ($instructeurId) {
            return redirect()->route('instructeur.voertuigen', $instructeurId)
                ->with('success', 'Voertuig gegevens zijn succesvol bijgewerkt');
        }

        return redirect()->route('voertuigen.index')
            ->with('success', 'Voertuig gegevens zijn succesvol bijgewerkt');
    }
}
