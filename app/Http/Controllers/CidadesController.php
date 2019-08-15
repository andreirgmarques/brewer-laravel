<?php

namespace App\Http\Controllers;

use App\Http\Requests\CidadeFormRequest;
use App\Models\Cidade;
use App\Models\Estado;
use App\Models\Ordenacao;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class CidadesController extends Controller
{
    private $cidade;
    private $estado;
    private $gate;
    private $totalPage = 5;

    public function __construct(Cidade $cidade, Estado $estado, Gate $gate)
    {
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->gate   = $gate;
        $this->middleware("auth");
    }

    public function nova()
    {
        $titulo = "Cadastro de Cidade";

        $estados = $this->estado->all();

        return view("cidade.CadastroCidade", compact("titulo", "estados"));
    }

    public function salvar(CidadeFormRequest $request)
    {
        if (!$this->gate->allows("ROLE_CADASTRAR_CIDADE")) {
            return redirect()->action("CidadesController@nova")->withErrors("Usuário sem permissão de cadastrar nova cidade.");
        }

        $dataForm = $request->all();

        if ($this->cidade->existeCidadeCadastrada($dataForm, $this->cidade)) {
            return redirect()->action("CidadesController@nova")->withErrors("Nome da cidade já cadastrada.");
        }

        if (empty($dataForm["codigo"])) {
            $result = $this->cidade->create($dataForm);
        } else {
            $result = $this->cidade->update($dataForm);
        }

        if ($result) {
            return redirect()->action("CidadesController@nova")->with("mensagem", "Cidade salva com sucesso!");
        } else {
            return redirect()->back();
        }
    }

    public function pesquisarPorCodigoEstado(Request $request)
    {
        $codigoEstado = $request->all()["estado"];
        sleep(1);

        return $this->cidade->where("codigo_estado", "=", $codigoEstado)->get()->toJson();
    }

    public function pesquisar(Request $request)
    {
        $titulo       = "Pesquisa de Cidades";

        $estados      = $this->estado->all();
        $ordenacao    = new Ordenacao();
        $gate         = $this->gate;

        $cidadeFilter = $request->all();

        $this->cidade = $this->cidade->adicionarFiltroEOrdenacao($cidadeFilter, $this->cidade);
        $cidades      = $this->cidade->paginate($this->totalPage);

        return view("cidade.PesquisaCidades", compact("titulo", "estados", "cidades", "ordenacao", "cidadeFilter", "gate"));
    }

}
