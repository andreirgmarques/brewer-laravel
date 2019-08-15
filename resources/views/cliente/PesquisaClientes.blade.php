@extends("layout.LayoutPadrao")

@section("conteudo")
    <div class="page-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-10">
                    <h1>Pesquisa de Clientes</h1>
                </div>

                <div class="col-xs-2">
                    <div class="aw-page-header-controls">
                        <a class="btn btn-default" href="{{url("/clientes/novo")}}">
                            <i class="glyphicon glyphicon-plus-sign"></i> <span class="hidden-xs hidden-sm">Novo Cliente</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <form method="get" action="{{url("/clientes")}}">
            <div class="row">
                <div class="col-sm-8 form-group">
                    <label for="nome" class="control-label">Nome</label>
                    <input id="nome" name="nome" type="text" class="form-control" value="{{$clienteFilter["nome"] or ""}}" />
                </div>
                <div class="col-sm-4 form-group">
                    <label for="cpfOuCnpj" class="control-label">CPF/CNPJ</label>
                    <input id="cpfOuCnpj" name="cpfOuCnpj" type="text" class="form-control" value="{{$clienteFilter["cpfOuCnpj"] or ""}}" />
                </div>
            </div>

            <div class="form-group">
                <button class="btn  btn-primary" type="submit">Pesquisar</button>
            </div>
        </form>

        <div class="table-responsive bw-tabela-simples">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th class="table-clientes-col-nome">
                        @if($clientes->count() > 0)
                            <a href="{{$ordenacao->urlOrdenada("nome")}}">
                                <span>Nome</span>
                                @if($ordenacao->ordenada("nome"))
                                    <span class="@if($ordenacao->descendente()) dropdown @else dropup @endif">
                                        <span class="caret"></span>
                                    </span>
                                @endif
                            </a>
                        @else
                            <span>Nome</span>
                        @endif
                    </th>
                    <th class="table-clientes-col-tipo-pessoa">
                        @if($clientes->count() > 0)
                            <a href="{{$ordenacao->urlOrdenada("tipo_pessoa")}}">
                                <span>Tipo Pessoa</span>
                                @if($ordenacao->ordenada("tipo_pessoa"))
                                    <span class="@if($ordenacao->descendente()) dropdown @else dropup @endif">
                                        <span class="caret"></span>
                                    </span>
                                @endif
                            </a>
                        @else
                            <span>Tipo Pessoa</span>
                        @endif
                    </th>
                    <th class="table-clientes-col-cpf-cnpj">CPF/CNPJ</th>
                    <th class="table-clientes-col-telefone">Telefone</th>
                    <th class="table-clientes-col-cidade-estado">Cidade/Estado</th>
                    <th class="table-col-acoes"></th>
                </tr>
                </thead>

                <tbody>
                @foreach($clientes as $cliente)
                    <tr>
                        <td>{{$cliente->nome}}</td>
                        <td class="text-center">{{$cliente->descricaoTipoPessoa($cliente->tipo_pessoa)}}</td>
                        <td class="text-right">{{$cliente->mascararCpfOuCnpj($cliente->cpf_cnpj)}}</td>
                        <td class="text-right">{{$cliente->telefone}}</td>
                        <td class="text-right">{{!empty($cliente->cidade->nome) ? $cliente->cidade->nome."/".$cliente->cidade->estado->sigla : ""}}</td>
                        <td class="text-center">
                            <a class="btn btn-link btn-xs js-tooltip" title="Editar"
                               href="#">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </a>

                            <a class="btn btn-link btn-xs js-tooltip js-exclusao-btn" title="Excluir"
                               data-url="#" data-objeto="Fulano da Silva">
                                <i class="glyphicon glyphicon-remove"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                @if($clientes->count() == 0)
                    <tr>
                        <td colspan="7">Nenhum cliente encontrado</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

        <div class="col-sm-12 text-center">
            {!! $clientes->links() !!}
        </div>
    </div>
@endsection