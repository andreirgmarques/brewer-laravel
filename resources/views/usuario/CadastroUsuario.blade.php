@extends("layout.LayoutPadrao")

@push("stylesheet-extra")
    <link rel="stylesheet" type="text/css" href="{{url("/stylesheets/vendors/bootstrap-switch.min.css")}}" />
@endpush

@section("conteudo")
    <div class="page-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-10">
                    <h1>Cadastro de Usuário</h1>
                </div>

                <div class="col-xs-2">
                    <div class="aw-page-header-controls">
                        <a class="btn btn-default"href="{{url("/usuarios")}}">
                            <i class="glyphicon glyphicon-plus-sign"></i>
                            <span class="hidden-xs hidden-sm">Pesquisa</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">

        <form method="post" class="form-vertical js-form-loading" action="{{url("/usuarios/novo")}}">
            @include("fragments.MensagemErroValidacao")
            @include("fragments.MensagemSucesso")

            {!! csrf_field() !!}

            <div class="form-group bw-required @if($errors->has("nome")) has-error @endif" >
                <label for="nome" class="control-label">Nome</label>
                <input id="nome" name="nome" type="text" class="form-control" />
            </div>

            <div class="row">
                <div class="col-sm-6 form-group bw-required @if($errors->has("email")) has-error @endif" >
                    <label for="email" class="control-label">E-mail</label>
                    <input id="email" name="email" type="text" class="form-control"  />
                </div>

                <div class="col-sm-3 form-group">
                    <label for="dataNascimento">Data de nacimento</label>
                    <input id="dataNascimento" name="data_nascimento" type="text" class="form-control js-date"
                           autocomplete="off" />
                </div>
            </div>


            <div class="row">
                <div class="col-sm-3 form-group @if($errors->has("senha")) has-error @endif">
                    <label for="senha" class="control-label">Senha</label>
                    <input id="senha" name="senha" type="password" class="form-control"  />
                </div>

                <div class="col-sm-3 form-group">
                    <label for="confirmacaoSenha" class="control-label">Confirmação de senha</label>
                    <input id="confirmacaoSenha" name="confirmacaoSenha" type="password" class="form-control" />
                </div>

                <div class="col-sm-4 form-group">
                    <label class="control-label">Status</label>
                    <div>
                        <input type="checkbox" name="ativo" class="js-status" data-size="small" data-off-color="danger"
                               data-on-text="Ativo" data-off-text="Inativo" />
                    </div>
                </div>
            </div>

            <div class="form-group bw-required @if($errors->has("grupos")) has-error @endif">
                <label class="control-label">Grupos</label>
                <div>
                    @foreach($grupos as $grupo)
                        <div class="checkbox checkbox-inline">
                            <input type="checkbox" id="{{$grupo->codigo}}" name="grupos[]" value="{{$grupo->codigo}}" />
                            <label for="{{$grupo->codigo}}">{{$grupo->nome}}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="form-group">
                <button class="btn  btn-primary" type="submit">Salvar</button>
            </div>
        </form>
    </div>
@endsection

@push("javascript-extra")
    <script src="{{url("/javascripts/vendors/bootstrap-switch.min.js")}}"></script>

    <script>
        $('.js-status').bootstrapSwitch();
    </script>
@endpush