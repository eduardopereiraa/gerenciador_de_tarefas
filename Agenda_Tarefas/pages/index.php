<!DOCTYPE html>
<html lang="PT-BR">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
   integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
   <link rel="stylesheet" href="../estilos/style.css">
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
   <title>Tarefas</title>
</head>
   <nav class="navbar navbar-expand-lg navbar-white" style="background-color: lightblue;">
      <div class="div-nav-img">
            <img class="img-nav" src="https://www.soeltech.com.br/images/binoculos.webp" alt="">
      </div>
      <a class="navbar-brand" href="index.html">André/Du Sistemas</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
               <li class="nav-item">
                  <a class="nav-link" href="index.html">Home</a>
               </li>
            </ul>
      </div>
   </nav>
   <br>
   <br>
   <div class="div-cadastro">
      <h3 class="h3-cadastro">Cadastrar Tarefa</h3>
      <button type="button" class="btn btn-primary" id="btnAbrirFormulario">Cadastro</button>
   </div>
   <div id="modal" class="modal">
      <div class="modal-content">
            <span class="fechar" id="fecharModal">&times;</span>
            <h2 id="tituloTabela">Registrar nova tarefa</h2>
            <table cellpadding="2">
               <tr>
                  <td class="campoLabel">
                        <label  for="nome">Nome:</label>
                  </td>
                  <td class="campoDado">
                        <input type="text" id="nome" name="nome">
                  </td>
                  <td class="campoLabel">
                        <label  for="email">Email:</label>
                  </td>
                  <td class="campoDado">
                        <input type="email" id="email" name="email">
                  </td>
               </tr>
               <tr>
                  <td class="campoLabel">
                        <label for="data">Data:</label>
                  </td>
                  <td class="campoDado">
                        <input type="date" id="data">
                  </td>
                  <td class="campoLabel">
                        <label for="classificacao">Classificação:</label>
                  </td>
                  <td class="campoDado">
                        <select name="classificacao" id="classificacao">
                           <option value="0">Selecione</option>
                           <option value="1">Urgente</option>
                           <option value="2">Normal</option>
                           <option value="3">Baixa</option>
                        </select>
                  </td>
               </tr>
               <tr>
                  <td class="campoLabel">
                        <label  for="descricao">Descrição:</label>
                  </td>
                  <td class="campoDado" colspan="3">
                        <textarea id="descricao" name="descricao"></textarea>
                  </td>
               </tr>
               <tr>
                  <td>
                        <input type="submit" value="Cadastrar" onclick="cadastrarTarefas()">
                  </td>
               </tr>
            </table>
      </div>
   </div>
   <div id="gridPrincipal">
      <div id="prioridadeBaixa">
            <h3 id="tituloBaixa" class="tituloClassificacao"> Baixa </h3>
            <div id="divTablePrioridadeBaixa">
               <table id="tablePrioridadeBaixa">
                  <?php
                     require_once('../forms/form_buscar_tarefas.php');
                     $aDados = getDados();
                     
                     $aDadosPrioridadeBaixa = array_filter($aDados, function($oDados) {
                        return $oDados->sClassificacao === 'Baixa';
                     });

                     foreach($aDadosPrioridadeBaixa as $oDados) {
                        $sHtml = "
                           <table id='tablePrioridadeBaixa{$oDados->sNome}'>
                              <theady>
                                 <tr>
                                    <td>
                                       {$oDados->sNome}
                                    </td>
                                 </tr>
                              </theady>
                              <tbody>
                                 <tr>
                                    <td>
                                       {$oDados->sData}
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       {$oDados->sEmail}
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       {$oDados->sDescricao}
                                    </td>
                                 </tr>
                              </tbody>
                           </table>   
                           <input type='button' value='Excluir Tarefa' onClick='excluirTarefa({$oDados->iCodigo})'>
                        ";
                  
                     if($oDados->bConcluido == '0') {
                        $sHtml .= "
                           <input type='button' value='Alterar Tarefa' onClick='alterarTarefa({$oDados->iCodigo})'>
                           <input type='button' value='Concluir Tarefa' onClick='concluirTarefa({$oDados->iCodigo})'>
                        ";
                     }
                     else {
                        $sHtml .= "
                           <input type='button' value='Tarefa Concluída' disabled=''>
                        ";
                     }
   
                        echo $sHtml;
                     }
                     ?>
               </table>
            </div>
         </div>
         <div id="prioridadeNormal">
            <h3 id="tituloNormal" class="tituloClassificacao"> Normal </h3>
         <div id="divTablePrioridadeNormal">
            <table id="tablePrioridadeNormal">
               <?php
                  $aDados = getDados();
                  $aDadosPrioridadeNormal = array_filter($aDados, function($oDados) {
                     return $oDados->sClassificacao === 'Normal';
                  });

                  foreach($aDadosPrioridadeNormal as $oDados) {
                     $sHtml = "
                        <table id='tablePrioridadeNormal{$oDados->sNome}'>
                           <theady>
                              <tr>
                                 <td>
                                    {$oDados->sNome}
                                 </td>
                              </tr>
                           </theady>
                           <tbody>
                              <tr>
                                 <td>
                                    {$oDados->sData}
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    {$oDados->sEmail}
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    {$oDados->sDescricao}
                                 </td>
                              </tr>
                           </tbody>
                        </table>   
                        <input type='button' value='Excluir Tarefa' onClick='excluirTarefa({$oDados->iCodigo})'>
                        ";
                        
                     if($oDados->bConcluido == '0') {
                        $sHtml .= "
                           <input type='button' value='Alterar Tarefa' onClick='alterarTarefa({$oDados->iCodigo})'>
                           <input type='button' value='Concluir Tarefa' onClick='concluirTarefa({$oDados->iCodigo})'>
                        ";
                     }
                     else {
                        $sHtml .= "
                           <input type='button' value='Tarefa Concluída' disabled=''>
                        ";
                     }

                     echo $sHtml;
                  }
                  ?>
               </table>
            </div>
         </div>
         <div id="prioridadeUrgente">
            <h3 id="tituloUrgente" class="tituloClassificacao"> Urgente </h3>
            <div id="divTablePrioridadeUrgente">
               <?php
                  $aDados = getDados();
                  $aDadosPrioridadeUrgente = array_filter($aDados, function($oDados) {
                     return $oDados->sClassificacao === 'Urgente';
                  });
               
                  foreach($aDadosPrioridadeUrgente as $oDados) {
                     $sHtml = "
                        <table id='tablePrioridadeUrgente{$oDados->sNome}'>
                           <theady>
                              <tr>
                                 <td>
                                    {$oDados->sNome}
                                 </td>
                              </tr>
                           </theady>
                           <tbody>
                              <tr>
                                 <td>
                                    {$oDados->sData}
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    {$oDados->sEmail}
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    {$oDados->sDescricao}
                                 </td>
                              </tr>
                           </tbody>
                        </table>   
                        <input type='button' value='Excluir Tarefa' onClick='excluirTarefa({$oDados->iCodigo})'>
                     ";
               
                     if($oDados->bConcluido == '0') {
                        $sHtml .= "
                           <input type='button' value='Alterar Tarefa' onClick='alterarTarefa({$oDados->iCodigo})'>
                           <input type='button' value='Concluir Tarefa' onClick='concluirTarefa({$oDados->iCodigo})'>
                        ";
                     }
                     else {
                        $sHtml .= "
                           <input type='button' value='Tarefa Concluída' disabled=''>
                        ";
                     }

                     echo $sHtml;
                  }   
               ?>
               
            </div>
      </div>
   </div>
   <script src="../scripts/scripts.js"></script>
</html>