<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table      = "cliente";
    protected $primaryKey = "codigo";
    protected $guarded    = ["_token", "codigo_estado"];

    public function cidade()
    {
        return $this->belongsTo(Cidade::class, "codigo_cidade", "codigo");
    }

    public function existeClienteCadastrado($cpfOuCnpj, $cliente)
    {
        $clienteExistente = $cliente->where("cpf_cnpj", "=", $cpfOuCnpj)->get()->first();
        return isset($clienteExistente);
    }

    public function descricaoTipoPessoa($tipoPessoa)
    {
        return TipoPessoa::VALUES[$tipoPessoa]["Descricao"];
    }

    public function mascararCpfOuCnpj($cpfOuCnpj)
    {
        return strlen($cpfOuCnpj) <= 11 ? $this->mascararCpf($cpfOuCnpj) : $this->mascararCnpj($cpfOuCnpj);
    }

    public function adicionarFiltroEOrdenacao($dataForm, $cliente)
    {
        $where = array();
        if (!empty($dataForm["nome"])) {
            array_push($where, ["nome", "like", "%".$dataForm["nome"]."%"]);
        }
        if (!empty($dataForm["cpfOuCnpj"])) {
            array_push($where, ["cpf_cnpj", "=", $dataForm["cpfOuCnpj"]]);
        }
        if (!empty($dataForm["sort"])) {
            $ordenacao = explode(",", $dataForm["sort"]);
            return $cliente->where($where)->orderBy($ordenacao[0], $ordenacao[1]);
        } else {
            return $cliente->where($where);
        }
    }

    private function mascararCpf($cpf)
    {
        return substr($cpf, 0, 3) . "." . substr($cpf, 3, 3) . "." . substr($cpf, 6, 3) . "-" . substr($cpf, 9, 2);
    }

    private function mascararCnpj($cnpj)
    {
        return substr($cnpj, 0, 2) . "." . substr($cnpj, 2, 3) . "." . substr($cnpj, 5, 3) . "." . substr($cnpj, 8, 3) . "/" . substr($cnpj, 11, 4) . "-" . substr($cnpj, 15, 2);
    }
}

