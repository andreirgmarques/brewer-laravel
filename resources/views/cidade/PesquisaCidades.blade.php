@extends("layout.LayoutPadrao")

@section("conteudo")
    <div class="page-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-10">
                    <h1>Pesquisa de Cidades</h1>
                </div>

                @if($gate->allows("ROLE_CADASTRAR_CIDADE"))
                    <div class="col-xs-2">
                        <div class="aw-page-header-controls">
                            <a class="btn btn-default" href="{{url("/cidades/nova")}}">
                                <i class="glyphicon glyphicon-plus-sign"></i> <span class="hidden-xs hidden-sm">Nova Cidade</span>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <form method="get" action="{{url("/cidades")}}">
            <div class="row">
                <div class="col-sm-4 form-group">
                    <label for="estado" class="control-label">Estado</label>
                    <select id="estado" name="codigoEstado" class="form-control">
                        <option value="">Todos os estados</option>
                        @foreach($estados as $estado)
                            <option value="{{$estado->codigo}}" @if(!empty($cidadeFilter["codigoEstado"]) && $cidadeFilter["codigoEstado"] == $estado->codigo) selected @endif>{{$estado->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-8 form-group">
                    <label for="nome" class="control-label">Nome</label>
                    <input id="nome" name="nome" type="text" class="form-control" value="{{$cidadeFilter["nome"] or ""}}" />
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
                    <th class="table-cidades-col-nome">
                        @if($cidades->count() > 0)
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
                    <th class="table-cidades-col-estado">
                        @if($cidades->count() > 0)
                            <a href="{{$ordenacao->urlOrdenada("codigo_estado")}}">
                                <span>Estado</span>
                                @if($ordenacao->ordenada("codigo_estado"))
                                    <span class="@if($ordenacao->descendente()) dropdown @else dropup @endif">
                                        <span class="caret"></span>
                                    </span>
                                @endif
                            </a>
                        @else
                            <span>Estado</span>
                        @endif
                    </th>
                    <th class="table-col-acoes"></th>
                </tr>
                </thead>

                <tbody>
                @foreach($cidades as $cidade)
                    <tr>
                        <td>{{$cidade->nome}}</td>
                        <td class="text-right">{{$cidade->estado->nome}}</td>
                        <td class="text-center">
                            <a class="btn btn-link btn-xs js-tooltip" title="Editar"
                               href="#">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </a>

                            <a class="btn btn-link btn-xs js-tooltip js-exclusao-btn" title="Excluir"
                               data-url="#" data-objeto="Cuiabá">
                                <i class="glyphicon glyphicon-remove"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                @if($cidades->count() == 0)
                    <tr>
                        <td colspan="3">Nenhuma cidade encontrada</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

        <div class="col-sm-12 text-center">
            {!! $cidades->links() !!}
        </div>
    </div>
@endsection