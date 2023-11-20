<?php

    require_once('../classes/class_conexao_banco.php');

switch($_REQUEST['req']) {   

    case 'inserirCadastro':
        $oDados        = getObjetoDados();
        $oConexao      = new ConexaoBanco('localhost', 'root', '', 'agendatarefas');
        $sInsert       = getInsert($oDados);
        $bValidaQuery  = mysqli_query($oConexao->oConexao, $sInsert);
        $oRetorno      = new stdClass();

        if($bValidaQuery) {
            $oRetorno->mensagem = 'Registro incluído com sucesso.';
        }   
        else {
           $oRetorno->mensagem = 'Houve uma falha no registro.';
        }   
   
        echo json_encode($oRetorno);
        break; 
        
    case 'excluirTarefa':
        $oDados        = getObjetoDados();
        $oConexao      = new ConexaoBanco('localhost', 'root', '', 'agendatarefas');
        $sDelete       = getDelete($oDados);
        $bValidaQuery  = mysqli_query($oConexao->oConexao, $sDelete);
        $oRetorno      = new stdClass();
    
        if($bValidaQuery) {
            $oRetorno->mensagem = 'Registro excluído com sucesso.';
        }   
        else {
           $oRetorno->mensagem = 'Houve uma falha no registro.';
        }   
        
        echo json_encode($oRetorno);
    break;
        
    case 'concluirTarefa':
        $oDados        = getObjetoDados();
        $oConexao      = new ConexaoBanco('localhost', 'root', '', 'agendatarefas');
        $sUpdate       = getUpdate($oDados);
        $bValidaQuery  = mysqli_query($oConexao->oConexao, $sUpdate);
        $oRetorno      = new stdClass();
    
        if($bValidaQuery) {
            $oRetorno->mensagem = 'Registro concluído com sucesso.';
        }   
        else {
           $oRetorno->mensagem = 'Houve uma falha no registro.';
        }   
        
        echo json_encode($oRetorno);
    break;
}

function getObjetoDados() {
    return getChave();
 }
 
 function getChave() {
    return json_decode($_REQUEST['chave']);
 }
 
 function getInsert($oDados) {
    return "
       INSERT INTO tarefas (
                   tnome,
                   temail,
                   tdata,
                   tclassificacao,
                   tdescricao)
            VALUES (
                   '{$oDados->sNome}',
                   '{$oDados->sEmail}',
                   '{$oDados->sData}',
                   {$oDados->iClassificacao},
                   '{$oDados->sDescricao}')
    ";
 }

 function getDelete($oDados) {
    return "
        DELETE
          FROM tarefas
         WHERE tcodigo = {$oDados->iCodigo}
    ";
 }

 function getUpdate($oDados) {
    return "
        UPDATE tarefas
           SET tconcluido = 1
         WHERE tcodigo = {$oDados->iCodigo}
    ";
 }