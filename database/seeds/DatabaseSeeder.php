<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EstiloSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(CidadeSeeder::class);
        $this->call(GrupoSeeder::class);
        $this->call(UsuarioSeeder::class);
        $this->call(PermissaoSeeder::class);
        $this->call(GrupoPermissaoSeeder::class);
        $this->call(UsuarioGrupoSeeder::class);
    }
}