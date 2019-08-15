<?php

use Illuminate\Database\Seeder;
use App\Models\Estado;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::create([
            "codigo" => 1,
            "nome"   => "Acre",
            "sigla"  => "AC"
        ]);

        Estado::create([
            "codigo" => 2,
            "nome"   => "Bahia",
            "sigla"  => "BA"
        ]);

        Estado::create([
            "codigo" => 3,
            "nome"   => "Goiás",
            "sigla"  => "GO"
        ]);

        Estado::create([
            "codigo" => 4,
            "nome"   => "Minas Gerais",
            "sigla"  => "MG"
        ]);

        Estado::create([
            "codigo" => 5,
            "nome"   => "Santa Catarina",
            "sigla"  => "SC"
        ]);

        Estado::create([
            "codigo" => 6,
            "nome"   => "São Paulo",
            "sigla"  => "SP"
        ]);
    }
}
