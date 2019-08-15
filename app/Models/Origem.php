<?php
/**
 * Created by PhpStorm.
 * User: Andrei
 * Date: 01/05/2017
 * Time: 19:45
 */

namespace App\Models;


class Origem
{
    const VALUES = array(
        "NACIONAL" => array(
            "Id" => "NACIONAL",
            "Descricao" => "Nacional"
        ),
        "INTERNACIONAL" => array(
            "Id" => "INTERNACIONAL",
            "Descricao" => "Internacional"
        )
    );
}