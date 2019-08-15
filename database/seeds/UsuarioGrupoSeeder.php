<?php

use Illuminate\Database\Seeder;
use App\Models\Usuario;

class UsuarioGrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario = Usuario::where("email", "=", "admin@brewer.com")->get()->first();
        $usuario->grupos()->attach(1);
    }
}
