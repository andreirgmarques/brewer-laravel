<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cerveja extends Model
{
    protected $table      = "cerveja";
    protected $primaryKey = "codigo";
    protected $guarded    = ["_token", "url_foto"];

    public function estilo()
    {
        return $this->belongsTo(Estilo::class, "codigo_estilo", "codigo");
    }

    public function descricaoOrigem($origem) {
        return Origem::VALUES[$origem]["Descricao"];
    }

    public function fotoOuMock($foto) {
        return !empty($foto) ? $foto : "cerveja-mock.png";
    }

    private function converterValorNumerico($valor, $milhar, $decimal)
    {
        return str_replace($decimal, ".", str_replace($milhar, "", $valor));
    }

    public function converterCamposNumericos($dataForm)
    {
        $dataForm["codigo_estilo"]      = (integer) $dataForm["codigo_estilo"];
        $dataForm["valor"]              = (float)   $this->converterValorNumerico($dataForm["valor"], ".", ",");
        $dataForm["comissao"]           = (float)   $this->converterValorNumerico($dataForm["comissao"], ".", ",");
        $dataForm["teor_alcoolico"]     = (float)   $this->converterValorNumerico($dataForm["teor_alcoolico"], ".", ",");
        $dataForm["quantidade_estoque"] = (integer) $dataForm["quantidade_estoque"];
        return $dataForm;
    }

    public function adicionarFiltroEOrdenacao($dataForm, $cerveja)
    {
        $where = array();
        if (!empty($dataForm["sku"])) {
            array_push($where, ["sku", "=", strtoupper($dataForm["sku"])]);
        }
        if (!empty($dataForm["nome"])) {
            array_push($where, ["nome", "like", "%".$dataForm["nome"]."%"]);
        }
        if (!empty($dataForm["estilo"])) {
            array_push($where, ["codigo_estilo", "=", $dataForm["estilo"]]);
        }
        if (!empty($dataForm["origem"]) && $dataForm["origem"] != "TODAS") {
            array_push($where, ["origem", "=", $dataForm["origem"]]);
        }
        if (!empty($dataForm["valorDe"])) {
            array_push($where, ["valor", ">", (float) $this->converterValorNumerico($dataForm["valorDe"], ".", ",")]);
        }
        if (!empty($dataForm["valorAte"])) {
            array_push($where, ["valor", "<", (float) $this->converterValorNumerico($dataForm["valorAte"], ".", ",")]);
        }
        if (!empty($dataForm["sort"])) {
            $ordenacao = explode(",", $dataForm["sort"]);
            return $cerveja->where($where)->orderBy($ordenacao[0], $ordenacao[1]);
        } else {
            return $cerveja->where($where);
        }
    }
}
