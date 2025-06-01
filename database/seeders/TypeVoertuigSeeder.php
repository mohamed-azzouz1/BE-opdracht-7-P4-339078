<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeVoertuigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_voertuig')->insert([
            ['TypeVoertuig' => 'Personenauto', 'Rijbewijscategorie' => 'B'],
            ['TypeVoertuig' => 'Vrachtwagen', 'Rijbewijscategorie' => 'C'],
            ['TypeVoertuig' => 'Bus', 'Rijbewijscategorie' => 'D'],
            ['TypeVoertuig' => 'Bromfiets', 'Rijbewijscategorie' => 'AM'],
        ]);
    }
}
