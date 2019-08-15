<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstiloFormRequest;
use App\Models\Estilo;
use App\Models\Ordenacao;
use Illuminate\Http\Request;

class EstilosController extends Controller
{
    private $estilo;
    private $totalPage = 2;

    public function __construct(Estilo $estilo)
    {
        $this->estilo = $estilo;
        $this->middleware("auth");
    }

    public function novo()
    {
        $titulo = "Cadastro de Estilo";

        return view("estilo.CadastroEstilo", compact("titulo"));
    }

    public function salvar(EstiloFormRequest $request)
    {
        $dataForm = $request->all();

        if ($this->estilo->existeEstiloCadastrado($dataForm, $this->estilo)) {
            return redirect()->action("EstilosController@novo")->withErrors("Nome do estilo já cadastrado.");
        } else {
            if (empty($dataForm["codigo"])) {
                $result = $this->estilo->create($dataForm);
            } else {
                $result = $this->estilo->update($dataForm);
            }

            if ($result) {
                return redirect()->action("EstilosController@novo")->with("mensagem", "Estilo salvo com sucesso!");
            } else {
                return redirect()->back();
            }
        }
    }

    public function salvarAjax(EstiloFormRequest $request)
    {
        $dataForm = $request->all();

        if ($this->estilo->existeEstiloCadastrado($dataForm, $this->estilo)) {
            return response()->json(["nome" => ["Nome do estilo já cadastrado."]], 400);
        } else {
            $result = $this->estilo->create($dataForm);

            if ($result) {
                return response()->json(["codigo" => $result->codigo, "nome" => $result->nome], 200);
            } else {
                return response()->json(["nome" => ["Erro ao salvar o estilo."]], 400);
            }
        }
    }

    public function pesquisar(Request $request)
    {
        $titulo       = "Pesquisa de Estilos";

        $ordenacao    = new Ordenacao();

        $estiloFilter = $request->all();

        $this->estilo = $this->estilo->adicionarFiltroEOrdenacao($estiloFilter, $this->estilo);
        $estilos      = $this->estilo->paginate($this->totalPage);

        return view("estilo.PesquisaEstilos", compact("titulo", "estilos", "ordenacao", "estiloFilter"));
    }

}
