<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioFormRequest;
use App\Models\Grupo;
use App\Models\Usuario;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    private $grupo;
    private $usuario;
    private $gate;
    private $totalPage = 3;

    public function __construct(Grupo $grupo, Usuario $usuario, Gate $gate)
    {
        $this->grupo   = $grupo;
        $this->usuario = $usuario;
        $this->gate    = $gate;
        $this->middleware("auth");
    }

    public function novo()
    {
        $titulo = "Cadastro de Usuário";

        $grupos = $this->grupo->all();

        return view("usuario.CadastroUsuario", compact("titulo", "grupos"));
    }

    public function salvar(UsuarioFormRequest $request)
    {
        if (!$this->gate->allows("ROLE_CADASTRAR_USUARIO")) {
            return redirect()->action("UsuariosController@novo")->withErrors("Usuário sem permissão de cadastrar novo usuário.");
        }

        $dataForm                    = $request->all();

        $dataForm                    = $this->usuario->criptografarSenhas($dataForm);
        $dataForm["ativo"]           = empty($dataForm["ativo"]) ? false : true;

        if (!empty($dataForm["data_nascimento"])) {
            $dataForm["data_nascimento"] = implode("-", array_reverse(explode("/", $dataForm["data_nascimento"])));
        }

        if (empty($dataForm["codigo"]) && $this->usuario->existeUsuarioCadastrado($dataForm, $this->usuario)) {
            return redirect()->action("UsuariosController@novo")->withErrors("E-mail já cadastrado.");
        }

        if (empty($dataForm["codigo"])) {
            $result = $this->usuario->create($dataForm);
        } else {
            $result = $this->usuario->update($dataForm);
        }

        if ($result) {
            $result->grupos()->attach($dataForm["grupos"]);
            return redirect()->action("UsuariosController@novo")->with("mensagem", "Usuário salvo com sucesso!");
        } else {
            return redirect()->back();
        }

    }

    public function pesquisar(Request $request)
    {
        return view("usuario.PesquisaUsuarios");
    }

}
