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
            ->where('voertuig_instructeur.IsActief', '=', true)
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

    public function getAllAvailableVoertuigen($instructeurId)
    {
        $instructeur = Instructeur::findOrFail($instructeurId);
        
        // Get all vehicles that are not actively assigned to any instructor
        $availableVoertuigen = DB::table('voertuig')
            ->leftJoin('voertuig_instructeur', function($join) {
                $join->on('voertuig.id', '=', 'voertuig_instructeur.VoertuigId')
                     ->where('voertuig_instructeur.IsActief', '=', true);
            })
            ->join('type_voertuig', 'voertuig.TypeVoertuigId', '=', 'type_voertuig.id')
            ->whereNull('voertuig_instructeur.id') // No active assignment
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
        
        return view('voertuigen.available', compact('instructeur', 'availableVoertuigen'));
    }

    public function edit($id, Request $request)
    {
        $voertuig = Voertuig::findOrFail($id);
        $typeVoertuigen = TypeVoertuig::all();
        $instructeurs = Instructeur::where('IsActief', true)->get();
        
        // Get the current instructeur assignment for this vehicle
        $voertuigInstructeur = VoertuigInstructeur::where('VoertuigId', $id)
                                ->where('IsActief', true)
                                ->first();
        
        $currentInstructeurId = $voertuigInstructeur ? $voertuigInstructeur->InstructeurId : null;
        
        // Get the instructor ID from the request or default to current
        $originalInstructeurId = $request->query('instructeur_id', $currentInstructeurId);
        
        // Flag to determine if this is a new assignment
        $isNewAssignment = $request->query('new_assignment', false) || is_null($currentInstructeurId);
        
        // If it's a new assignment and we have a specified instructor, pre-select them
        if ($isNewAssignment && $originalInstructeurId) {
            $currentInstructeurId = $originalInstructeurId;
        }
        
        return view('voertuigen.edit', compact(
            'voertuig', 
            'typeVoertuigen', 
            'instructeurs', 
            'currentInstructeurId', 
            'originalInstructeurId',
            'isNewAssignment'
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
            'OriginalInstructeurId' => 'required|exists:instructeur,id',
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

        // Get instructor IDs
        $originalInstructeurId = $request->input('OriginalInstructeurId');
        $newInstructeurId = $request->input('InstructeurId');

        // Handle instructor assignment
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
            // Create new assignment
            VoertuigInstructeur::create([
                'VoertuigId' => $id,
                'InstructeurId' => $newInstructeurId,
                'DatumToekenning' => Carbon::now()->format('Y-m-d'),
                'IsActief' => true,
                'Opmerking' => 'New assignment',
                'DatumAangemaakt' => Carbon::now(),
                'DatumGewijzigd' => Carbon::now(),
            ]);
        }

        // Redirect to the original instructor's vehicle list
        return redirect()->route('instructeur.voertuigen', $originalInstructeurId)
            ->with('success', 'Voertuig gegevens zijn succesvol bijgewerkt');
    }
}
