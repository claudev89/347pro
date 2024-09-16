<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('regions')->insert([
            ['numero' => 1, 'nombre' => '(XV) Arica y Parinacota'],
            ['numero' => 2, 'nombre' => '(I) Tarapacá'],
            ['numero' => 3, 'nombre' => '(II) Antofagasta'],
            ['numero' => 4, 'nombre' => '(III) Atacama'],
            ['numero' => 5, 'nombre' => '(IV) Coquimbo'],
            ['numero' => 6, 'nombre' => '(V) Valparaíso'],
            ['numero' => 7, 'nombre' => "(RM) Metropolitana"],
            ['numero' => 8, 'nombre' => "(VI) O'Higgins"],
            ['numero' => 9, 'nombre' => '(VII) Maule'],
            ['numero' => 10, 'nombre' => '(XVI) Ñuble'],
            ['numero' => 11, 'nombre' => '(VIII) Biobío'],
            ['numero' => 12, 'nombre' => '(IX) Araucanía'],
            ['numero' => 13, 'nombre' => '(XIV) Los Ríos'],
            ['numero' => 14, 'nombre' => '(X) Los Lagos'],
            ['numero' => 15, 'nombre' => '(XI) Aysén'],
            ['numero' => 16, 'nombre' => '(XII) Magallanes'],
        ]);
    }
}
