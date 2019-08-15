<?php

namespace App\Models;


class Ordenacao
{
    public function urlOrdenada($propriedade)
    {
        $urlAtual       = env("APP_URL").$_SERVER["REQUEST_URI"];
        $urlAtual       = strpos($urlAtual, "sort=") == 0 ? $urlAtual : substr($urlAtual, 0, strpos($urlAtual, "sort=") - 1);

        $dadosUrl       = $_GET;
        $ordenacaoAtual = !empty($dadosUrl["sort"]) ? explode(",", $dadosUrl["sort"])[1] : "";

        if (strpos($urlAtual, "?") == 0) {
            return $urlAtual."?sort=".$this->inverterOrdenacao($propriedade, $ordenacaoAtual);
        } else {
            return $urlAtual."&sort=".$this->inverterOrdenacao($propriedade, $ordenacaoAtual);
        }
    }

    public function ordenada($propriedade)
    {
        $dadosUrl       = $_GET;

        if (empty($dadosUrl["sort"])) {
            return false;
        } else {
            return explode(",", $dadosUrl["sort"])[0] == $propriedade;
        }
    }

    public function descendente()
    {
        $dadosUrl       = $_GET;

        if (empty($dadosUrl["sort"])) {
            return false;
        } else {
            return explode(",", $dadosUrl["sort"])[1] == "desc";
        }
    }

    private function inverterOrdenacao($propriedade, $ordenacaoAtual)
    {
        $ordenacao     = "asc";

        if (!empty($ordenacaoAtual)) {
            $ordenacao = $ordenacaoAtual == "asc" ? "desc" : "asc";
        }

        return $propriedade.",".$ordenacao;
    }
}