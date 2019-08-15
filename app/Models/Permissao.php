<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    protected $table      = "permissao";
    protected $primaryKey = "codigo";

    public function grupos()
    {
        return $this->belongsToMany(Grupo::class, "grupo_permissao", "codigo_permissao", "codigo_grupo");
    }
}
