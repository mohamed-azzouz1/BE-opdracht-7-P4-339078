<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TypeVoertuigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        
        DB::table('type_voertuig')->insert([
            [
                'TypeVoertuig' => 'Personenauto', 
                'Rijbewijscategorie' => 'B',
                'IsActief' => true,
                'Opmerking' => null,
                'DatumAangemaakt' => $now,
                'DatumGewijzigd' => $now
            ],
            [
                'TypeVoertuig' => 'Vrachtwagen', 
                'Rijbewijscategorie' => 'C',
                'IsActief' => true,
                'Opmerking' => null,
                'DatumAangemaakt' => $now,
                'DatumGewijzigd' => $now
            ],
            [
                'TypeVoertuig' => 'Bus', 
                'Rijbewijscategorie' => 'D',
                'IsActief' => true,
                'Opmerking' => null,
                'DatumAangemaakt' => $now,
                'DatumGewijzigd' => $now
            ],
            [
                'TypeVoertuig' => 'Bromfiets', 
                'Rijbewijscategorie' => 'AM',
                'IsActief' => true,
                'Opmerking' => null,
                'DatumAangemaakt' => $now,
                'DatumGewijzigd' => $now
            ],
        ]);
    }
}
