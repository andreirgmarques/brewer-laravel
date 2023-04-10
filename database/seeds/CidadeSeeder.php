<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cidade;

class CidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cidade::create([
            "nome"          => "Rio Branco",
            "codigo_estado" => 1
        ]);

        Cidade::create([
            "nome"          => "Cruzeiro do Sul",
            "codigo_estado" => 1
        ]);

        Cidade::create([
            "nome"          => "Salvador",
            "codigo_estado" => 2
        ]);

        Cidade::create([
            "nome"          => "Porto Seguro",
            "codigo_estado" => 2
        ]);

        Cidade::create([
            "nome"          => "Santana",
            "codigo_estado" => 2
        ]);

        Cidade::create([
            "nome"          => "Goiânia",
            "codigo_estado" => 3
        ]);

        Cidade::create([
            "nome"          => "Itumbiara",
            "codigo_estado" => 3
        ]);

        Cidade::create([
            "nome"          => "Novo Brasil",
            "codigo_estado" => 3
        ]);

        Cidade::create([
            "nome"          => "Belo Horizonte",
            "codigo_estado" => 4
        ]);

        Cidade::create([
            "nome"          => "Uberlândia",
            "codigo_estado" => 4
        ]);

        Cidade::create([
            "nome"          => "Montes Claros",
            "codigo_estado" => 4
        ]);

        Cidade::create([
            "nome"          => "Florianópolis",
            "codigo_estado" => 5
        ]);

        Cidade::create([
            "nome"          => "Criciúma",
            "codigo_estado" => 5
        ]);

        Cidade::create([
            "nome"          => "Camboriú",
            "codigo_estado" => 5
        ]);

        Cidade::create([
            "nome"          => "Lages",
            "codigo_estado" => 5
        ]);

        Cidade::create([
            "nome"          => "São Paulo",
            "codigo_estado" => 6
        ]);

        Cidade::create([
            "nome"          => "Ribeirão Preto",
            "codigo_estado" => 6
        ]);

        Cidade::create([
            "nome"          => "Campinas",
            "codigo_estado" => 6
        ]);

        Cidade::create([
            "nome"          => "Santos",
            "codigo_estado" => 6
        ]);
    }
}
