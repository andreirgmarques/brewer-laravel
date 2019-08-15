<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estilo extends Model
{
    protected $table      = "estilo";
    protected $primaryKey = "codigo";
    protected $guarded    = ["_token"];

    public function cervejas()
    {
        return $this->hasMany(Cerveja::class, "codigo_estilo", "codigo");
    }

    public function existeEstiloCadastrado($dataForm, $estilo)
    {
        $estiloExistente = $estilo->where("nome", "=", $dataForm["nome"])->get()->first();
        return isset($estiloExistente);
    }

    public function adicionarFiltroEOrdenacao($dataForm, $estilo)
    {
        $where = array();
        if (!empty($dataForm["nome"])) {
            array_push($where, ["nome", "like", "%".$dataForm["nome"]."%"]);
        }
        if (!empty($dataForm["sort"])) {
            $ordenacao = explode(",", $dataForm["sort"]);
            return $estilo->where($where)->orderBy($ordenacao[0], $ordenacao[1]);
        } else {
            return $estilo->where($where);
        }
    }
}
