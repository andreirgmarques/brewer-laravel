<?php

use Illuminate\Database\Seeder;
use App\Models\Permissao;

class PermissaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permissao::create([
            "codigo" => 1,
            "nome"   => "ROLE_CADASTRAR_CIDADE"
        ]);

        Permissao::create([
            "codigo" => 2,
            "nome"   => "ROLE_CADASTRAR_USUARIO"
        ]);
    }
}
