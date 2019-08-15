@extends("layout.LayoutPadrao")

@push("stylesheet-extra")
    <link rel="stylesheets" href="{{url("/stylesheets/vendors/upload.min.css")}}">
@endpush

@section("conteudo")

    <div class="page-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-10">
                    <h1>Cadastro de Cerveja</h1>
                </div>

                <div class="col-xs-2">
                    <div class="aw-page-header-controls">
                        <a class="btn btn-default" href="{{url("/cervejas")}}">
                            <i class="glyphicon glyphicon-plus-sign"></i>
                            <span class="hidden-xs hidden-sm">Pesquisa</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <form method="post" class="form-vertical" action="{{url("/cervejas/nova")}}">
            @include("fragments.MensagemErroValidacao")
            @include("fragments.MensagemSucesso")

            {!! csrf_field() !!}

            <div class="row">
                <div class="col-sm-2 form-group bw-required @if($errors->has("sku")) has-error @endif">
                    <label for="sku" class="control-label">SKU</label>
                    <input id="sku" name="sku" type="text" class="form-control" value="{{$cerveja->sku or old("sku")}}" />
                </div>
                <div class="col-sm-10 form-group bw-required @if($errors->has("nome")) has-error @endif">
                    <label for="nome" class="control-label">Nome</label>
                    <input id="nome" name="nome" type="text" class="form-control" value="{{$cerveja->nome or old("nome")}}" />
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 form-group bw-required @if($errors->has("descricao")) has-error @endif">
                    <label for="descricao" class="control-label">Descrição</label>
                    <textarea id="descricao" name="descricao" rows="3" class="form-control">{{$cerveja->descricao or old("descricao")}}</textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3 form-group bw-required @if($errors->has("codigo_estilo")) has-error @endif">
                    <label for="estilo" class="control-label">Estilo</label>
                    <div class="bw-field-action">
                        <select id="estilo" name="codigo_estilo" class="form-control">
                            <option value="">Selecione o estilo</option>
                            @foreach($estilos as $estilo)
                                <option value="{{$estilo->codigo}}" @if((isset($cerveja) && $cerveja->codigo_estilo == $estilo->codigo) or old("codigo_estilo") == $estilo->codigo) selected @endif>{{$estilo->nome}}</option>
                            @endforeach
                        </select>

                        <div class="bw-field-action__icon">
                            <a href="#" data-toggle="modal"
                               data-target="#modalCadastroRapidoEstilo">
                                <i class="glyphicon glyphicon-plus-sign bw-glyphicon-large"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 form-group bw-required @if($errors->has("sabor")) has-error @endif">
                    <label for="sabor" class="control-label">Sabor</label>
                    <select id="sabor" name="sabor" class="form-control">
                        <option value="">Selecione o sabor</option>
                        @foreach($sabores as $sabor)
                            <option value="{{$sabor["Id"]}}" @if((isset($cerveja) && $cerveja->sabor == $sabor["Id"]) or old("sabor") == $sabor["Id"]) selected @endif>{{$sabor["Descricao"]}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3 form-group bw-required @if($errors->has("teor_alcoolico")) has-error @endif">
                    <label for="teorAlcoolico" class="control-label">Teor Alcoólico</label>
                    <div class="input-group">
                        <input id="teorAlcoolico" name="teor_alcoolico" type="text" class="form-control js-decimal"
                               value="{{$cerveja->teor_alcoolico or old("teor_alcoolico")}}" />
                        <div class="input-group-addon">%</div>
                    </div>
                </div>
                <div class="col-sm-3 form-group bw-required @if($errors->has("origem")) has-error @endif">
                    <label for="origem" class="control-label">Origem</label>
                    <div>
                        @foreach($origens as $origem)
                            <div class="radio radio-inline">
                                <input id="id_{{$origem["Id"]}}" name="origem" type="radio" class="form-control"
                                       value="{{$origem["Id"]}}" @if((isset($cerveja) && $cerveja->origem == $origem["Id"]) or old("origem") == $origem["Id"]) checked @endif />
                                <label for="id_{{$origem["Id"]}}">{{$origem["Descricao"]}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3 form-group bw-required @if($errors->has("valor")) has-error @endif">
                    <label for="valor" class="control-label">Valor</label>
                    <div class="input-group">
                        <div class="input-group-addon">R$</div>
                        <input id="valor" name="valor" type="text" class="form-control js-decimal" value="{{$cerveja->valor or old("valor")}}" />
                    </div>
                </div>
                <div class="col-sm-3 form-group bw-required @if($errors->has("comissao")) has-error @endif">
                    <label for="comissao" class="control-label">Comissão</label>
                    <div class="input-group">
                        <input id="comissao" name="comissao" type="text" class="form-control js-decimal" value="{{$cerveja->comissao or old("comissao")}}" />
                        <div class="input-group-addon">%</div>
                    </div>
                </div>
                <div class="col-sm-3 form-group bw-required @if($errors->has("quantidade_estoque")) has-error @endif">
                    <label for="estoque" class="control-label">Estoque</label>
                    <input id="quantidadeEstoque" name="quantidade_estoque" type="text" class="form-control js-plain"
                           value="{{$cerveja->quantidade_estoque or old("quantidade_estoque")}}" />
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-12">
                    <input type="hidden" id="foto" name="foto" value="{{$cerveja->foto or old("foto")}}" />
                    <input type="hidden" id="content_type" name="content_type" value="{{$cerveja->foto or old("content_type")}}" />
                    <input type="hidden" id="url_foto" name="url_foto" value="{{$cerveja->url_foto or old("url_foto")}}" />

                    <label class="control-label">Foto</label>

                    <div class="js-container-foto-cerveja" data-url-fotos="{{url("/fotos")}}">
                        <div id="upload-drop" class="bw-upload">
                            <img src="{{url("/images/mini-loading.gif")}}" class="js-img-loading hidden" />
                            <i class="glyphicon glyphicon-cloud-upload"></i>
                                <span>Arraste a foto aqui ou </span>
                                <a class="bw-upload-form-file">
                                    selecione
                                    <input id="upload-select" type="file" accept=".jpg,.jpeg,.png" />
                                </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Salvar</button>
            </div>
        </form>
    </div>

    @include("estilo.CadastroRapidoEstilo")
    @include("hbs.FotoCerveja");
@endsection

@push("javascript-extra")
    <script src="{{url("/javascripts/estilo.cadastro-rapido.js")}}"></script>
    <script src="{{url("/javascripts/vendors/uikit.min.js")}}"></script>
    <script src="{{url("/javascripts/vendors/upload.min.js")}}"></script>
    <script src="{{url("/javascripts/vendors/handlebars.min.js")}}"></script>
    <script src="{{url("/javascripts/cerveja.upload-foto.js")}}"></script>
@endpush