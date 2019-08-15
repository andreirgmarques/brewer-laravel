<?php

namespace App\Http\Controllers;

use App\Http\Requests\CervejaFormRequest;
use App\Models\Cerveja;
use App\Models\Ordenacao;
use Illuminate\Http\Request;
use App\Models\Origem;
use App\Models\Sabor;
use App\Models\Estilo;

class CervejasController extends Controller
{
    private $cerveja;
    private $estilo;
    private $totalPage = 2;

    public function __construct(Cerveja $cerveja, Estilo $estilo)
    {
        $this->cerveja = $cerveja;
        $this->estilo  = $estilo;
        $this->middleware("auth");
    }

    public function nova()
    {
        $titulo = "Cadastro de Cerveja";

        $origens = Origem::VALUES;
        $sabores = Sabor::VALUES;
        $estilos = $this->estilo->all();

        return view("cerveja.CadastroCerveja", compact("titulo", "origens", "sabores", "estilos"));
    }

    public function salvar(CervejaFormRequest $request)
    {
        $dataForm = $request->all();

        $dataForm = $this->cerveja->converterCamposNumericos($dataForm);
        $dataForm["sku"] = strtoupper($dataForm["sku"]);

        if (empty($dataForm["codigo"])) {
            $result = $this->cerveja->create($dataForm);
        } else {
            $result = $this->cerveja->update($dataForm);
        }

        if ($result) {
            return redirect()->action("CervejasController@nova")->with("mensagem", "Cerveja salva com sucesso!");
        } else {
            return redirect()->back();
        }
    }

    public function pesquisar(Request $request)
    {
        $titulo        = "Pesquisa de Cervejas";

        $origens       = Origem::VALUES;
        $sabores       = Sabor::VALUES;
        $estilos       = $this->estilo->all();
        $ordenacao     = new Ordenacao();

        $cervejaFilter = $request->all();

        $this->cerveja = $this->cerveja->adicionarFiltroEOrdenacao($cervejaFilter, $this->cerveja);
        $cervejas      = $this->cerveja->paginate($this->totalPage);

        return view("cerveja.PesquisaCervejas", compact("titulo",  "origens", "sabores", "estilos", "cervejas", "ordenacao", "cervejaFilter"));
    }
}
