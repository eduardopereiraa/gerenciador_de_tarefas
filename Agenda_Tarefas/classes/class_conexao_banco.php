<?php

class ConexaoBanco {

   public $sServidor;
   public $sUsuario;
   public $sSenha;
   public $sBanco;
   public $oConexao;

   public function __construct($sServidor, $sUsuario, $sSenha, $sBanco) {
      $this->sServidor = $sServidor;
      $this->sUsuario  = $sUsuario;
      $this->sSenha    = $sSenha;
      $this->sBanco    = $sBanco;
      $this->conectarBanco();
   }

   public function conectarBanco() {
      $this->oConexao = mysqli_connect($this->sServidor, $this->sUsuario, $this->sSenha, $this->sBanco);
   }

}