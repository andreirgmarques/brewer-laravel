@extends("layout.LayoutPadrao")

@section("conteudo")
    <div class="page-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-10">
                    <h1>Pesquisa de Cervejas</h1>
                </div>

                <div class="col-xs-2">
                    <div class="aw-page-header-controls">
                        <a class="btn btn-default" href="{{url("/cervejas/nova")}}">
                            <i class="glyphicon glyphicon-plus-sign"></i> <span class="hidden-xs hidden-sm">Nova Cerveja</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <form method="get" action="{{url("/cervejas")}}">
            <div class="row">
                <div class="col-sm-6 form-group">
                    <label for="sku" class="control-label">SKU</label>
                    <input id="sku" name="sku" type="text" class="form-control"
                           value="{{empty($cervejaFilter["sku"]) ? "" : $cervejaFilter["sku"]}}" />
                </div>
                <div class="col-sm-6 form-group">
                    <label for="nome" class="control-label">Nome</label>
                    <input id="nome" name="nome" type="text" class="form-control"
                           value="{{empty($cervejaFilter["nome"]) ? "" : $cervejaFilter["nome"]}}" />
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 form-group">
                    <label for="estilo" class="control-label">Estilo</label>
                    <select id="estilo" name="estilo" class="form-control" >
                        <option value="">Todos os estilos</option>
                        @foreach($estilos as $estilo)
                            <option value="{{$estilo->codigo}}" @if(!empty($cervejaFilter["estilo"]) && $cervejaFilter["estilo"] == $estilo->codigo) selected @endif>{{$estilo->nome}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-6 form-group">
                    <label for="sabor" class="control-label">Sabor</label>
                    <select id="sabor" name="sabor" class="form-control" >
                        <option value="">Todos os sabores</option>
                        @foreach($sabores as $sabor)
                            <option value="{{$sabor["Id"]}}" @if(!empty($cervejaFilter["sabor"]) && $cervejaFilter["sabor"] == $sabor["Id"]) selected @endif>{{$sabor["Descricao"]}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 form-group">
                    <label class="control-label">Origem</label>
                    <div>
                        @foreach($origens as $origem)
                            <div class="radio radio-inline">
                                <input id="id_{{$origem["Id"]}}" name="origem" type="radio" class="form-control"
                                       value="{{$origem["Id"]}}" @if(!empty($cervejaFilter["origem"]) && $cervejaFilter["origem"] == $origem["Id"]) checked @endif />
                                <label for="id_{{$origem["Id"]}}">{{$origem["Descricao"]}}</label>
                            </div>
                        @endforeach
                        <div class="radio radio-inline">
                            <input id="todasOrigens" name="origem" type="radio" @if(empty($cervejaFilter["origem"]) || $cervejaFilter["origem"] == "TODAS") checked @endif value="TODAS">
                            <label for="todasOrigens">Todas</label>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 form-group">
                    <label for="valorDe" class="control-label">Valor unitário</label>
                    <div class="form-inline">
                        <input id="valorDe" name="valorDe" type="text" class="form-control aw-form-control-inline-sm js-decimal"
                            value="{{empty($cervejaFilter["valorDe"]) ? "" : $cervejaFilter["valorDe"]}}" />
                        <label for="valorAte" class="aw-form-label-between">até</label>
                        <input id="valorAte" name="valorAte" type="text" class="form-control aw-form-control-inline-sm js-decimal"
                            value="{{empty($cervejaFilter["valorAte"]) ? "" : $cervejaFilter["valorAte"]}}" />
                    </div>
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
                    <th class="table-cervejas-col-foto"></th>
                    <th class="table-cervejas-col-sku">
                        @if($cervejas->count() > 0)
                            <a href="{{$ordenacao->urlOrdenada("sku")}}">
                                <span>SKU</span>
                                @if($ordenacao->ordenada("sku"))
                                    <span class="@if($ordenacao->descendente()) dropdown @else dropup @endif">
                                        <span class="caret"></span>
                                    </span>
                                @endif
                            </a>
                        @else
                            <span>SKU</span>
                        @endif
                    </th>
                    <th class="table-cervejas-col-nome">
                        @if($cervejas->count() > 0)
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
                    <th class="table-cervejas-col-estilo">Estilo</th>
                    <th class="table-cervejas-col-origem">Origem</th>
                    <th class="table-cervejas-col-valor">Valor</th>
                    <th class="table-col-acoes"></th>
                </tr>
                </thead>

                <tbody>
                @foreach($cervejas as $cerveja)
                    <tr>
                        <td class="text-center">
                            <img src="{{env("APP_URL")."/fotos_cervejas/".$cerveja->fotoOuMock($cerveja->foto)}}" class="img-responsive"
                                width="40" height="68">
                        </td>
                        <td class="text-center">{{$cerveja->sku}}</td>
                        <td>{{$cerveja->nome}}</td>
                        <td>{{$cerveja->estilo->nome}}</td>
                        <td>{{$cerveja->descricaoOrigem($cerveja->origem)}}</td>
                        <td class="text-right">{{"RS ".number_format($cerveja->valor, 2, ",", ".")}}</td>
                        <td class="text-center">
                            <a class="btn btn-link btn-xs js-tooltip" title="Editar"
                               href="#">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </a>

                            <a class="btn btn-link btn-xs js-tooltip js-exclusao-btn" title="Excluir" href="#"
                               data-url="#" data-objeto="Cerveja Stell">
                                <i class="glyphicon glyphicon-remove"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                @if($cervejas->count() == 0)
                    <tr>
                        <td colspan="7">Nenhuma cerveja encontrada</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

        <div class="col-sm-12 text-center">
            {!! $cervejas->links() !!}
        </div>
    </div>
@endsection