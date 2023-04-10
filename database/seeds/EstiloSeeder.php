<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estilo;

class EstiloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estilo::create([
            "nome" => "Amber Lager"
        ]);

        Estilo::create([
            "nome" => "Dark Lager"
        ]);

        Estilo::create([
            "nome" => "Pale Lager"
        ]);

        Estilo::create([
            "nome" => "Pilsner"
        ]);
    }
}
