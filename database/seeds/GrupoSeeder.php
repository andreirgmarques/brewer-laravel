<?php

use Illuminate\Database\Seeder;
use App\Models\Grupo;

class GrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grupo::create([
            "codigo" => 1,
            "nome"   => "Administrador"
        ]);

        Grupo::create([
            "codigo" => 2,
            "nome"   => "Vendedor"
        ]);
    }
}
