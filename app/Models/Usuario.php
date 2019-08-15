<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table      = "usuario";
    protected $primaryKey = "codigo";
    protected $guarded    = ["_token", "grupos", "confirmacaoSenha", "remember_token"];

    public function grupos()
    {
        return $this->belongsToMany(Grupo::class, "usuario_grupo", "codigo_usuario", "codigo_grupo");
    }

    public function existeUsuarioCadastrado($dataForm, $usuario)
    {
        $usuarioExistente = $usuario->where("email", "=", $dataForm["email"])->get()->first();
        return isset($usuarioExistente);
    }

    public function criptografarSenhas($dataForm)
    {
        $dataForm["senha"]            = bcrypt($dataForm["senha"]);
        $dataForm["confirmacaoSenha"] = $dataForm["senha"];
        return $dataForm;
    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            foreach ($this->grupos as $grupo) {
                return $grupo->permissoes->contains("nome", $role);
            }
        }

        return !!$role->intersect($this->grupos->permissoes)->count();
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->senha;
    }

    public function getReminderEmail()
    {
        return $this->email;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }


}
