<?php

namespace App\Providers;

use App\Models\Permissao;
use App\Models\Usuario;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        foreach ($this->obterPermissoes() as $permissao) {
            Gate::define($permissao->nome, function (Usuario $usuario) use ($permissao) {
                return $usuario->hasRole($permissao->nome);
            });
        }
    }

    protected function obterPermissoes()
    {
        return Permissao::all();
    }
}
