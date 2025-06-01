<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voertuig;
use App\Models\Instructeur;
use App\Models\TypeVoertuig;
use App\Models\VoertuigInstructeur;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        
        // Modified query to only get active assignments
        $voertuigen = DB::table('voertuig_instructeur')
            ->join('voertuig', 'voertuig_instructeur.VoertuigId', '=', 'voertuig.id')
            ->join('type_voertuig', 'voertuig.TypeVoertuigId', '=', 'type_voertuig.id')
            ->where('voertuig_instructeur.InstructeurId', '=', $instructeurId)
            ->where('voertuig.IsActief', '=', true)
            ->where('voertuig_instructeur.IsActief', '=', true) // Added this line to ensure only active assignments are shown
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
        $instructeurs = Instructeur::where('IsActief', true)->get();
        
        // Get the current instructeur assignment for this vehicle
        $voertuigInstructeur = VoertuigInstructeur::where('VoertuigId', $id)
                                ->where('IsActief', true)
                                ->first();
        
        $currentInstructeurId = $voertuigInstructeur ? $voertuigInstructeur->InstructeurId : null;
        $originalInstructeurId = $currentInstructeurId; // Store for redirect after update
        
        return view('voertuigen.edit', compact(
            'voertuig', 
            'typeVoertuigen', 
            'instructeurs', 
            'currentInstructeurId', 
            'originalInstructeurId'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Kenteken' => 'required|string|max:20',
            'Type' => 'required|string|max:100',
            'Bouwjaar' => 'required|date',
            'Brandstof' => 'required|string|max:20',
            'TypeVoertuigId' => 'required|exists:type_voertuig,id',
            'InstructeurId' => 'required|exists:instructeur,id',
        ]);

        // Update vehicle data
        $voertuig = Voertuig::findOrFail($id);
        $voertuig->update([
            'Kenteken' => $request->Kenteken,
            'Type' => $request->Type,
            'Bouwjaar' => $request->Bouwjaar,
            'Brandstof' => $request->Brandstof,
            'TypeVoertuigId' => $request->TypeVoertuigId,
            'DatumGewijzigd' => Carbon::now(),
        ]);

        // Get the original instructor ID for redirect
        $originalInstructeurId = $request->input('OriginalInstructeurId');
        $newInstructeurId = $request->input('InstructeurId');

        // Handle instructor reassignment
        $currentAssignment = VoertuigInstructeur::where('VoertuigId', $id)
                          ->where('IsActief', true)
                          ->first();

        // If there's a current assignment and the instructor has changed
        if ($currentAssignment && $currentAssignment->InstructeurId != $newInstructeurId) {
            // Deactivate the current assignment
            $currentAssignment->update([
                'IsActief' => false,
                'DatumGewijzigd' => Carbon::now(),
                'Opmerking' => 'Reassigned to instructor ID: ' . $newInstructeurId
            ]);

            // Create new assignment
            VoertuigInstructeur::create([
                'VoertuigId' => $id,
                'InstructeurId' => $newInstructeurId,
                'DatumToekenning' => Carbon::now()->format('Y-m-d'),
                'IsActief' => true,
                'Opmerking' => 'Assigned from instructor ID: ' . $currentAssignment->InstructeurId,
                'DatumAangemaakt' => Carbon::now(),
                'DatumGewijzigd' => Carbon::now(),
            ]);
        }
        // If there's no current assignment, create one
        elseif (!$currentAssignment) {
            VoertuigInstructeur::create([
                'VoertuigId' => $id,
                'InstructeurId' => $newInstructeurId,
                'DatumToekenning' => Carbon::now()->format('Y-m-d'),
                'IsActief' => true,
                'DatumAangemaakt' => Carbon::now(),
                'DatumGewijzigd' => Carbon::now(),
            ]);
        }

        // Redirect to the original instructor's vehicle list
        return redirect()->route('instructeur.voertuigen', $originalInstructeurId)
            ->with('success', 'Voertuig gegevens zijn succesvol bijgewerkt');
    }
}
