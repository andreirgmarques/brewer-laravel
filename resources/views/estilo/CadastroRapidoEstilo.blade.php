<div class="modal fade" id="modalCadastroRapidoEstilo" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Cadastro de Estilo</h4>
            </div>

            <div class="modal-body">
                <div class="alert alert-danger hidden js-mensagem-cadastro-rapido-estilo" role="alert"></div>
                <form class="form-horizontal" action="{{url("/estilos/salvarAjax")}}">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="nomeEstilo">Nome</label>
                        <div class="col-sm-10">
                            <input id="nomeEstilo" name="nomeEstilo" type="text" class="form-control" autofocus="autofocus" />
                        </div>
                    </div>
                </form>
                <button type="button" class="btn btn-primary js-modal-cadastro-rapido-estilo-btn">Salvar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>