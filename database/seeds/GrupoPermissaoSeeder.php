<?php

use Illuminate\Database\Seeder;
use App\Models\Grupo;

class GrupoPermissaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grupo = Grupo::find(1);
        $grupo->permissoes()->attach([1, 2]);
    }
}
