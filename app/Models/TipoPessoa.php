<?php

namespace App\Models;


class TipoPessoa
{
    const VALUES = array(
        "FISICA" => array(
            "Id" => "FISICA",
            "Descricao" => "Física",
            "Documento" => "CPF",
            "Mascara" => "000.000.000-00"
        ),
        "JURIDICA" => array(
            "Id" => "JURIDICA",
            "Descricao" => "Jurídica",
            "Documento" => "CNPJ",
            "Mascara" => "00.000.000/0000-00"
        )
    );

    public static function removerFormatacao($cpfOuCnpj)
    {
        return preg_replace("/[^0-9]/", "", $cpfOuCnpj);
    }
}