@extends("layout.LayoutPadrao")

@section("conteudo")
    <div class="page-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-10">
                    <h1>Cadastro de Cliente</h1>
                </div>

                <div class="col-xs-2">
                    <div class="aw-page-header-controls">
                        <a class="btn btn-default" href="{{url("/clientes")}}">
                            <i class="glyphicon glyphicon-plus-sign"></i>
                            <span class="hidden-xs hidden-sm">Pesquisa</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <form method="post" action="{{url("/clientes/novo")}}">
            @include("fragments.MensagemErroValidacao")
            @include("fragments.MensagemSucesso")

            {!! csrf_field() !!}

            <div class="form-group bw-required">
                <label for="nome" class="control-label">Nome</label>
                <input id="nome" name="nome" type="text" class="form-control"  />
            </div>

            <div class="row">
                <div class="col-lg-4 col-sm-6 form-group bw-required">
                    <label for="tipoPessoa" class="control-label">Tipo pessoa</label>
                    <div>
                        @foreach($tiposPessoa as $tipoPessoa)
                            <div class="radio radio-inline">
                                <input type="radio" id="id_{{$tipoPessoa["Id"]}}" name="tipo_pessoa" class="js-radio-tipo-pessoa"
                                    data-documento="{{$tipoPessoa["Documento"]}}" data-mascara="{{$tipoPessoa["Mascara"]}}"
                                    value="{{$tipoPessoa["Id"]}}"/>
                                <label class="control-label" for="id_{{$tipoPessoa["Id"]}}">{{$tipoPessoa["Descricao"]}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-8 col-sm-6 form-group bw-required">
                    <label for="cpfOuCnpj" class="control-label">CPF/CNPJ</label>
                    <input id="cpfOuCnpj" name="cpf_cnpj" type="text" class="form-control" disabled="disabled"/>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-4 form-group">
                    <label for="telefone">Telefone</label>
                    <input id="telefone" name="telefone" type="text" class="form-control js-phone-number" />
                </div>

                <div class="col-sm-8 form-group bw-required" >
                    <label for="email" class="control-label">E-mail</label>
                    <input id="email" name="email" type="text" class="form-control" />
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 form-group">
                    <label for="logradouro">Logradouro</label>
                    <input id="logradouro" name="logradouro" type="text" class="form-control" />
                </div>

                <div class="col-sm-4 form-group">
                    <label for="numero">Número</label>
                    <input id="numero" name="numero" type="text" class="form-control" />
                </div>

                <div class="col-sm-4 form-group">
                    <label for="complemento">Complemento</label>
                    <input id="complemento" name="complemento" type="text" class="form-control" />
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 form-group">
                    <label for="cep">CEP</label>
                    <input id="cep" name="cep" type="text" class="form-control js-cep" />
                </div>

                <div class="col-sm-4 form-group">
                    <label for="estado">Estado</label>
                    <select id="estado" name="codigo_estado" class="form-control">
                        <option value="">Selecione o estado</option>
                        @foreach($estados as $estado)
                            <option value="{{$estado->codigo}}">{{$estado->nome}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-4 form-group">
                    <label for="cidade">Cidade</label>
                    <div class="bw-field-action">
                        <input type="hidden" id="inputHiddenCidadeSelecionada" />
                        <select id="cidade" name="codigo_cidade" class="form-control" data-url="{{url("/cidades/ajax")}}" disabled>
                            <option value="">Selecione a cidade</option>
                        </select>

                        <div class="bw-field-action__icon js-img-loading" style="display: none;">
                            <img src="{{url("/images/mini-loading.gif")}}" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button class="btn  btn-primary" type="submit">Salvar</button>
            </div>
        </form>
    </div>
@endsection

@push("javascript-extra")
    <script src="{{url("/javascripts/cliente.mascara-cpf-cnpj.js")}}"></script>
    <script src="{{url("/javascripts/cliente.combo-estado-cidade.js")}}"></script>
@endpush