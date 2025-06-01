<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VoertuigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        
        DB::table('voertuig')->insert([
            [
                'Kenteken' => 'AU-67-IO', 
                'Type' => 'Golf', 
                'Bouwjaar' => '2017-06-12', 
                'Brandstof' => 'Diesel', 
                'TypeVoertuigId' => 1,
                'IsActief' => true,
                'Opmerking' => null,
                'DatumAangemaakt' => $now,
                'DatumGewijzigd' => $now
            ],
            [
                'Kenteken' => 'TR-24-OP', 
                'Type' => 'DAF', 
                'Bouwjaar' => '2019-05-23', 
                'Brandstof' => 'Diesel', 
                'TypeVoertuigId' => 2,
                'IsActief' => true,
                'Opmerking' => null,
                'DatumAangemaakt' => $now,
                'DatumGewijzigd' => $now
            ],
            [
                'Kenteken' => 'TH-78-KL', 
                'Type' => 'Mercedes', 
                'Bouwjaar' => '2023-01-01', 
                'Brandstof' => 'Benzine', 
                'TypeVoertuigId' => 1,
                'IsActief' => true,
                'Opmerking' => null,
                'DatumAangemaakt' => $now,
                'DatumGewijzigd' => $now
            ],
            [
                'Kenteken' => '90-KL-TR', 
                'Type' => 'Fiat 500', 
                'Bouwjaar' => '2021-09-12', 
                'Brandstof' => 'Benzine', 
                'TypeVoertuigId' => 1,
                'IsActief' => true,
                'Opmerking' => null,
                'DatumAangemaakt' => $now,
                'DatumGewijzigd' => $now
            ],
            [
                'Kenteken' => '34-TK-LP', 
                'Type' => 'Scania', 
                'Bouwjaar' => '2015-03-13', 
                'Brandstof' => 'Diesel', 
                'TypeVoertuigId' => 2,
                'IsActief' => true,
                'Opmerking' => null,
                'DatumAangemaakt' => $now,
                'DatumGewijzigd' => $now
            ],
            [
                'Kenteken' => 'YY-OP-78', 
                'Type' => 'BMW M5', 
                'Bouwjaar' => '2022-05-13', 
                'Brandstof' => 'Diesel', 
                'TypeVoertuigId' => 1,
                'IsActief' => true,
                'Opmerking' => null,
                'DatumAangemaakt' => $now,
                'DatumGewijzigd' => $now
            ],
            [
                'Kenteken' => 'UU-HH-JK', 
                'Type' => 'M.A.N', 
                'Bouwjaar' => '2017-12-03', 
                'Brandstof' => 'Diesel', 
                'TypeVoertuigId' => 2,
                'IsActief' => true,
                'Opmerking' => null,
                'DatumAangemaakt' => $now,
                'DatumGewijzigd' => $now
            ],
            [
                'Kenteken' => 'ST-FZ-28', 
                'Type' => 'Citroën', 
                'Bouwjaar' => '2018-01-20', 
                'Brandstof' => 'Elektrisch', 
                'TypeVoertuigId' => 1,
                'IsActief' => true,
                'Opmerking' => null,
                'DatumAangemaakt' => $now,
                'DatumGewijzigd' => $now
            ],
            [
                'Kenteken' => '123-FR-T', 
                'Type' => 'Piaggio ZIP', 
                'Bouwjaar' => '2021-02-01', 
                'Brandstof' => 'Benzine', 
                'TypeVoertuigId' => 4,
                'IsActief' => true,
                'Opmerking' => null,
                'DatumAangemaakt' => $now,
                'DatumGewijzigd' => $now
            ],
            [
                'Kenteken' => 'DRS-52-P', 
                'Type' => 'Vespa Piaggio', 
                'Bouwjaar' => '2022-03-21', 
                'Brandstof' => 'Elektrisch', 
                'TypeVoertuigId' => 4,
                'IsActief' => true,
                'Opmerking' => null,
                'DatumAangemaakt' => $now,
                'DatumGewijzigd' => $now
            ],
            [
                'Kenteken' => 'STP-12-U', 
                'Type' => 'Kymco', 
                'Bouwjaar' => '2022-07-02', 
                'Brandstof' => 'Benzine', 
                'TypeVoertuigId' => 4,
                'IsActief' => true,
                'Opmerking' => null,
                'DatumAangemaakt' => $now,
                'DatumGewijzigd' => $now
            ],
            [
                'Kenteken' => '45-SD-23', 
                'Type' => 'Renault', 
                'Bouwjaar' => '2023-01-01', 
                'Brandstof' => 'Diesel', 
                'TypeVoertuigId' => 3,
                'IsActief' => true,
                'Opmerking' => null,
                'DatumAangemaakt' => $now,
                'DatumGewijzigd' => $now
            ],
        ]);
    }
}
