<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FotosController extends Controller
{
    private $localFotos;
    private $urlFotos;

    public function __construct()
    {
        $this->localFotos = public_path().DIRECTORY_SEPARATOR."fotos_cervejas".DIRECTORY_SEPARATOR;
        $this->urlFotos   = env("APP_URL")."/fotos_cervejas/";
        $this->middleware("auth");
    }

    public function upload(Request $request)
    {
        $files    = $request->file("files");
        if ($files[0]->isValid() && $files[0]->getClientSize() > 0) {
            $arquivo     = $request->file("files")[0];
            $novoNome    = $this->renomearArquivo($arquivo->getClientOriginalName());

            $arquivo->move($this->localFotos, $novoNome);
            //$this->gravarThumbnail($this->localFotos.$novoNome, $novoNome, $arquivo->getClientOriginalExtension());

            return response()->json(["nome" => $novoNome, "contentType" => $arquivo->getClientMimeType(), "url" => $this->urlFotos]);
        }
    }

    private function renomearArquivo($nomeOriginal) {
        return str_shuffle("0123456789abcdefghijlkmnopqrstuvwxyz")."_".$nomeOriginal;
    }

    private function gravarThumbnail($arquivo, $nomeArquivo, $extensao) {
        list($largura, $altura) = getimagesize($arquivo);

        $novaLargura            = 40;
        $novaAltura             = 68;

        $imagem_p               = imagecreatetruecolor($novaLargura, $novaAltura);
        if ($extensao == "jpg" || $extensao == "jpeg") {
            $imagem             = imagecreatefromjpeg($arquivo);
        } else {
            $imagem             = imagecreatefrompng($arquivo);
        }

        imagecopyresampled($imagem_p, $imagem, 0, 0, 0, 0, $novaLargura, $novaAltura, $largura, $altura);

        if ($extensao == "jpg" || $extensao == "jpeg") {
            imagejpeg($imagem_p, $this->localFotos."thumbnail.".$nomeArquivo, 100);
        } else {
            imagepng($imagem_p, $this->localFotos."thumbnail.".$nomeArquivo, 9);
        }
    }
}
