@extends("layout.LayoutPadrao")

@section("conteudo")
    <div class="page-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-10">
                    <h1>Pesquisa de Estilos</h1>
                </div>

                <div class="col-xs-2">
                    <div class="aw-page-header-controls">
                        <a class="btn btn-default" href="{{url("/estilos/novo")}}">
                            <i class="glyphicon glyphicon-plus-sign"></i> <span class="hidden-xs hidden-sm">Novo Estilo</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <form method="get" action="{{url("/estilos")}}">
            <div class="row">
                <div class="col-sm-12 form-group">
                    <label for="nome" class="control-label">Nome</label>
                    <input id="nome" name="nome" type="text" class="form-control" value="{{$estiloFilter["nome"] or ""}}" />
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
                    <th class="table-estilos-col-codigo">Código</th>
                    <th class="table-estilos-col-nome">
                        @if($estilos->count() > 0)
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
                    <th class="table-col-acoes"></th>
                </tr>
                </thead>

                <tbody>
                @foreach($estilos as $estilo)
                    <tr>
                        <td class="text-center">{{$estilo->codigo}}</td>
                        <td>{{$estilo->nome}}</td>
                        <td class="text-center">
                            <a class="btn btn-link btn-xs js-tooltip" title="Editar"
                               href="#">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </a>

                            <a class="btn btn-link btn-xs js-tooltip js-exclusao-btn" title="Excluir"
                               data-url="#" data-objeto="${estilo.nome}">
                                <i class="glyphicon glyphicon-remove"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                @if($estilos->count() == 0)
                    <tr>
                        <td colspan="7">Nenhum estilo encontrado</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

        <div class="col-sm-12 text-center">
            {!! $estilos->links() !!}
        </div>
    </div>
@endsection