<?php

namespace App\Providers;

use App\Models\Permissao;
use App\Models\Usuario;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        foreach ($this->obterPermissoes() as $permissao) {
            $gate->define($permissao->nome, function (Usuario $usuario) use ($permissao) {
                return $usuario->hasRole($permissao->nome);
            });
        }
    }

    protected function obterPermissoes()
    {
        return Permissao::all();
    }
}
