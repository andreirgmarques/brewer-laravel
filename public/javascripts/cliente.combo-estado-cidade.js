var Brewer = Brewer || {};

Brewer.ComboEstado = (function () {

    function ComboEstado() {
        this.combo   = $('#estado');
        this.emitter = $({});
        this.on      = this.emitter.on.bind(this.emitter);
    }

    ComboEstado.prototype.iniciar = function () {
        this.combo.on('change', onComboEstadoAlterado.bind(this));
    }

    function onComboEstadoAlterado() {
        this.emitter.trigger('alterado', this.combo.val());
    }

    return ComboEstado;

}());

Brewer.ComboCidade = (function () {

    function ComboCidade(comboEstado) {
        this.comboEstado 				  = comboEstado;
        this.combo       				  = $('#cidade');
        this.imgLoading  		          = $('.js-img-loading');
        this.inputHiddenCidadeSelecionada = $('#inputHiddenCidadeSelecionada');
    }

    ComboCidade.prototype.iniciar = function () {
        reset.call(this);
        this.comboEstado.on('alterado', onEstadoAlterado.bind(this));
        var codigoEstado = this.comboEstado.combo.val();
        onEstadoAlterado.call(this, null, codigoEstado);
    }

    function onEstadoAlterado(evento, codigoEstado) {
        inicializarCidades.call(this, codigoEstado);
    }

    function inicializarCidades(codigoEstado) {
        if (codigoEstado) {
            var resposta = $.ajax({
                url: this.combo.data('url'),
                method: 'GET',
                contentType: 'application/json',
                data: { 'estado': codigoEstado },
                beforeSend: iniciarRequisicao.bind(this),
                complete: finalizarRequisicao.bind(this)
            });

            resposta.done(onBuscarCidadesFinalizado.bind(this));
        } else {
            reset.call(this);
        }
    }

    function onBuscarCidadesFinalizado(cidadesJSON) {
        var options = [];
        var cidades = JSON.parse(cidadesJSON);
        cidades.forEach(function(cidade) {
            options.push('<option value="' + cidade.codigo + '">' + cidade.nome + '</option>');
        });

        this.combo.html(options.join(''));
        this.combo.removeAttr('disabled');

        var codigoCidadeSelecionada = this.inputHiddenCidadeSelecionada.val();
        if (codigoCidadeSelecionada) {
            this.combo.val(codigoCidadeSelecionada);
        }
    }

    function reset() {
        this.combo.html('<option value="">Selecione a cidade</option>');
        this.combo.val('');
        this.combo.attr('disabled', 'disabled');
    }

    function iniciarRequisicao() {
        reset.call(this);
        this.imgLoading.show();
    }

    function finalizarRequisicao() {
        this.imgLoading.hide();
    }

    return ComboCidade;

}());

$(function () {
    var comboEstado = new Brewer.ComboEstado();
    comboEstado.iniciar();

    var comboCidade = new Brewer.ComboCidade(comboEstado);
    comboCidade.iniciar();
});