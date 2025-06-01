<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstructeurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('instructeur')->insert([
            ['Voornaam' => 'Li', 'Tussenvoegsel' => null, 'Achternaam' => 'Zhan', 'Mobiel' => '06-28493827', 'DatumInDienst' => '2015-04-17', 'AantalSterren' => '***'],
            ['Voornaam' => 'Leroy', 'Tussenvoegsel' => null, 'Achternaam' => 'Boerhaven', 'Mobiel' => '06-39398734', 'DatumInDienst' => '2018-06-25', 'AantalSterren' => '*'],
            ['Voornaam' => 'Yoeri', 'Tussenvoegsel' => 'Van', 'Achternaam' => 'Veen', 'Mobiel' => '06-24383291', 'DatumInDienst' => '2010-05-12', 'AantalSterren' => '***'],
            ['Voornaam' => 'Bert', 'Tussenvoegsel' => 'Van', 'Achternaam' => 'Sali', 'Mobiel' => '06-48293823', 'DatumInDienst' => '2023-01-10', 'AantalSterren' => '****'],
            ['Voornaam' => 'Mohammed', 'Tussenvoegsel' => 'El', 'Achternaam' => 'Yassidi', 'Mobiel' => '06-34291234', 'DatumInDienst' => '2010-06-14', 'AantalSterren' => '*****'],
        ]);
    }
}
