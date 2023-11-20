var oBtnAbrirFormulario = document.getElementById('btnAbrirFormulario');
var oModal              = document.getElementById('modal');
var oFecharModal        = document.getElementById('fecharModal');
var oCampos;

$(() => {
    mapearCampos();
});

oBtnAbrirFormulario.addEventListener('click', function() {
    oModal.style.display = 'block';
});

oFecharModal.addEventListener('click', function() {
    oModal.style.display = 'none';
});

// Fecha a modal se clicar fora dela
window.addEventListener('click', function(event) {
    if (event.target === oModal) {
        oModal.style.display = 'none';
        location.reload();
    }
});

function mapearCampos() {
    oCampos = {
        oNome          : $('#nome'),
        oEmail         : $('#email'),
        oDescricao     : $('#descricao'),
        oData          : $('#data'),
        oClassificacao : $('#classificacao')
    }
}

async function cadastrarTarefas() {
    const oDados = getDadosCadastro();

    const xRetornoJSON = await ajaxTarefa(oDados, 'inserirCadastro');
    const oRetorno     = JSON.parse(xRetornoJSON);

    return window.alert(oRetorno.mensagem);
}

async function excluirTarefa(iCodigo) {
    const oDados = {
        iCodigo : iCodigo
    };
    
    const xRetornoJSON = await ajaxTarefa(oDados, 'excluirTarefa');
    const oRetorno     = JSON.parse(xRetornoJSON);
    
    window.alert(oRetorno.mensagem);
    return location.reload();
}

async function concluirTarefa(iCodigo) {
    const oDados = {
        iCodigo : iCodigo
    };
    
    const xRetornoJSON = await ajaxTarefa(oDados, 'concluirTarefa');
    const oRetorno     = JSON.parse(xRetornoJSON);
    
    window.alert(oRetorno.mensagem);
    return location.reload();
}

function getDadosCadastro() {
    return {
        sNome          : oCampos.oNome.val(),
        sEmail         : oCampos.oEmail.val(),
        sDescricao     : oCampos.oDescricao.val(),
        sData          : oCampos.oData.val(),
        iClassificacao : oCampos.oClassificacao.val()
    }
}

function ajaxTarefa(oDados, sRequisicao) {
    const oUrl = new URL(location.href);
    const sUrl = oUrl.origin + '/teste/forms/forms_processar_cadastro.php';

    oDados = $.extend({
        loading: true
    }, oDados);

    const oPromise = $.ajax({
        url: sUrl,
        type: 'POST',
        datatype: 'JSON',
        data: {
           req: sRequisicao,
           chave: JSON.stringify(oDados)
        },
        complete: () => {
            if(oDados.loading) {
                oDados.loading = false;
            }
        }
      }, oDados);
      
    return oPromise; 
}
 