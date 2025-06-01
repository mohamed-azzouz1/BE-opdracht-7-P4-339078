<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VoertuigInstructeurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        
        DB::table('voertuig_instructeur')->insert([
            [
                'VoertuigId' => 1, 
                'InstructeurId' => 5, 
                'DatumToekenning' => '2017-06-18',
                'IsActief' => true,
                'Opmerking' => null,
                'DatumAangemaakt' => $now,
                'DatumGewijzigd' => $now
            ],
            [
                'VoertuigId' => 3, 
                'InstructeurId' => 1, 
                'DatumToekenning' => '2021-09-26',
                'IsActief' => true,
                'Opmerking' => null,
                'DatumAangemaakt' => $now,
                'DatumGewijzigd' => $now
            ],
            [
                'VoertuigId' => 9, 
                'InstructeurId' => 1, 
                'DatumToekenning' => '2021-09-27',
                'IsActief' => true,
                'Opmerking' => null,
                'DatumAangemaakt' => $now,
                'DatumGewijzigd' => $now
            ],
            [
                'VoertuigId' => 4, 
                'InstructeurId' => 4, 
                'DatumToekenning' => '2022-08-01',
                'IsActief' => true,
                'Opmerking' => null,
                'DatumAangemaakt' => $now,
                'DatumGewijzigd' => $now
            ],
            [
                'VoertuigId' => 5, 
                'InstructeurId' => 1, 
                'DatumToekenning' => '2019-08-30',
                'IsActief' => true,
                'Opmerking' => null,
                'DatumAangemaakt' => $now,
                'DatumGewijzigd' => $now
            ],
            [
                'VoertuigId' => 10, 
                'InstructeurId' => 5, 
                'DatumToekenning' => '2020-02-02',
                'IsActief' => true,
                'Opmerking' => null,
                'DatumAangemaakt' => $now,
                'DatumGewijzigd' => $now
            ],
        ]);
    }
}
