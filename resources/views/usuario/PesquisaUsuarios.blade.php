@extends("layout.LayoutPadrao")

@section("conteudo")
    <div class="page-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-10">
                    <h1>Pesquisa de Usuários</h1>
                </div>

                <div class="col-xs-2">
                    <div class="aw-page-header-controls">
                        <a class="btn btn-default" href="{{url("/usuarios/novo")}}">
                            <i class="glyphicon glyphicon-plus-sign"></i> <span class="hidden-xs hidden-sm">Novo Usuário</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <form method="get" action="{{url("/usuarios")}}">
            <div class="row">
                <div class="col-sm-6 form-group">
                    <label for="nome" class="control-label">Nome</label>
                    <input id="nome" type="text" class="form-control" />
                </div>
                <div class="col-sm-6 form-group">
                    <label for="email" class="control-label">E-mail</label>
                    <input id="email" type="text" class="form-control" />
                </div>
            </div>

            <div class="form-group">
                <label class="control-label">Grupos</label>
                <div>
                        <div class="checkbox checkbox-inline">
                            <input type="checkbox"  />
                            <label>Administrador</label>
                        </div>

                </div>
            </div>

            <div class="form-group">
                <button class="btn  btn-primary" type="submit">Pesquisar</button>
            </div>
        </form>

        <div class="aw-datatable-toolbar">
            <button class="btn btn-default btn-xs js-status-btn disabled" data-status="ATIVAR" data-url="{{url("/usuarios/status")}}">
                <span>Ativar</span>
            </button>

            <button class="btn btn-default btn-xs js-status-btn disabled" data-status="DESATIVAR" data-url="{{url("/usuarios/status")}}">
                <span>Desativar</span>
            </button>
        </div>

        <div class="table-responsive bw-tabela-simples">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th class="table-usuarios-col-status">
                        <div class="checkbox aw-checkbox-no-margin">
                            <input type="checkbox" class="js-selecao-todos">
                            <label></label>
                        </div>
                    </th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Grupo</th>
                    <th>Status</th>
                    <th class="table-col-acoes"></th>
                </tr>
                </thead>

                <tbody>
                <tr >
                    <th>
                        <!--<div class="checkbox aw-checkbox-no-margin" th:if="${#authentication.principal.usuario.codigo != usuario.codigo}">
                            <input type="checkbox" class="js-selecao" data:codigo="${usuario.codigo}">
                            <label></label>
                        </div>-->
                    </th>
                    <td>Admin</td>
                    <td>admin@brewer.com</td>
                    <td>
                        <span>Administrador</span>
                    </td>
                    <td>
                            <span class="label label-success">Ativo</span>

                    </td>
                    <td class="text-center" >
                        <a class="btn btn-link btn-xs js-tooltip" title="Editar"
                           href="#">
                            <i class="glyphicon glyphicon-pencil"></i>
                        </a>

                        <a class="btn btn-link btn-xs js-tooltip js-exclusao-btn" title="Excluir"
                           data-url="#" data-objeto="Administrador">
                            <i class="glyphicon glyphicon-remove"></i>
                        </a>
                    </td>
                </tr>

                <tr>
                    <td colspan="6">Nenhum usuário encontrado</td>
                </tr>
                </tbody>
            </table>
        </div>


    </div>
@endsection