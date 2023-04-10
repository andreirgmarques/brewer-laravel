<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usuario::create([
            "nome"   => "Admin",
            "email"  => "admin@brewer.com",
            "senha"  => '$2a$10$t7.nTMqw.aYP7ru2hGzFUeAU09DyxD6eX9/wT.v/8nQ1CmEgpoTDW',
            "ativo"  => true
        ]);
    }
}
