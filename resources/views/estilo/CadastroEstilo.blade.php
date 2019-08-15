@extends("layout.LayoutPadrao")

@section("conteudo")
    <div class="page-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-10">
                    <h1>Cadastro de Estilo</h1>
                </div>

                <div class="col-xs-2">
                    <div class="aw-page-header-controls">
                        <a class="btn btn-default" href="{{url("/estilos")}}">
                            <i class="glyphicon glyphicon-plus-sign"></i> <span class="hidden-xs hidden-sm">Pesquisa</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">

        <form method="post" class="form-vertical js-form-loading" action="{{url("/estilos/novo")}}" >
            @include("fragments.MensagemErroValidacao")
            @include("fragments.MensagemSucesso")

            {!! csrf_field() !!}

            <div class="form-group bw-required @if($errors->has("nome")) has-error @endif">
                <label for="nome" class="control-label">Nome</label>
                <input id="nome" name="nome" type="text" class="form-control" value="{{$estilo or old("nome")}}" />
            </div>

            <div class="form-group">
                <button class="btn  btn-primary" type="submit">Salvar</button>
            </div>
        </form>
    </div>
@endsection