<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table      = "grupo";
    protected $primaryKey = "codigo";

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, "usuario_grupo", "codigo_grupo", "codigo_usuario");
    }

    public function permissoes()
    {
        return $this->belongsToMany(Permissao::class, "grupo_permissao", "codigo_grupo", "codigo_permissao");
    }

}
