<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteFormRequest;
use App\Models\Cidade;
use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Ordenacao;
use App\Models\TipoPessoa;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    private $cliente;
    private $estado;
    private $cidade;
    private $totalPage = 3;

    public function __construct(Cliente $cliente, Estado $estado, Cidade $cidade)
    {
        $this->cliente = $cliente;
        $this->estado = $estado;
        $this->cidade = $cidade;
        $this->middleware("auth");
    }

    public function novo()
    {
        $titulo      = "Cadastro de Cliente";

        $tiposPessoa = TipoPessoa::VALUES;
        $estados     = $this->estado->all();

        return view("cliente.CadastroCliente", compact("titulo", "tiposPessoa", "estados"));
    }

    public function salvar(ClienteFormRequest $request)
    {
        $dataForm             = $request->all();

        $dataForm["cpf_cnpj"] = TipoPessoa::removerFormatacao($dataForm["cpf_cnpj"]);

        if (empty($dataForm["codigo"]) && $this->cliente->existeClienteCadastrado($dataForm["cpf_cnpj"], $this->cliente)) {
            return redirect()->action("ClientesController@novo")->withErrors("CPF/CNPJ já cadastrado.");
        }

        if (empty($dataForm["codigo"])) {
            $result = $this->cliente->create($dataForm);
        } else {
            $result = $this->cliente->update($dataForm);
        }

        if ($result) {
            return redirect()->action("ClientesController@novo")->with("mensagem", "Cliente salvo com sucesso!");
        } else {
            return redirect()->back();
        }
    }

    public function pesquisar(Request $request)
    {
        $titulo        = "Pesquisa de Clientes";

        $ordenacao     = new Ordenacao();

        $clienteFilter = $request->all();

        $this->cliente = $this->cliente->adicionarFiltroEOrdenacao($clienteFilter, $this->cliente);
        $clientes      = $this->cliente->paginate($this->totalPage);

        return view("cliente.PesquisaClientes", compact("titulo", "clientes", "ordenacao", "clienteFilter"));
    }
}
