<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $table      = "cidade";
    protected $primaryKey = "codigo";
    protected $guarded    = ["_token"];

    public function estado()
    {
        return $this->belongsTo(Estado::class, "codigo_estado", "codigo");
    }

    public function existeCidadeCadastrada($dataForm, $cidade) {
        $cidadeExistente = $cidade->where("codigo_estado", "=", $dataForm["codigo_estado"])->where("nome", "=", $dataForm["nome"])->get()->first();
        return isset($cidadeExistente);
    }

    public function adicionarFiltroEOrdenacao($dataForm, $cidade)
    {
        $where = array();
        if (!empty($dataForm["codigoEstado"])) {
            array_push($where, ["codigo_estado", "=", $dataForm["codigoEstado"]]);
        }
        if (!empty($dataForm["nome"])) {
            array_push($where, ["nome", "like", "%".$dataForm["nome"]."%"]);
        }
        if (!empty($dataForm["sort"])) {
            $ordenacao = explode(",", $dataForm["sort"]);
            return $cidade->where($where)->orderBy($ordenacao[0], $ordenacao[1]);
        } else {
            return $cidade->where($where);
        }
    }

}
