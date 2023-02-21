<?php
  class ConexaoBD{
    private $hospedagem = 'localhost';
    private $bancodedados = 'phpmuralis';
    private $usuario = 'root';
    private $senha = '';
    
    public $conexao;

    public function getHospedagem(){
      return $this->hospedagem;
    }

    public function getBancoDeDados(){
      return $this->bancodedados;
    }

    public function getUsuario(){
      return $this->usuario;
    }

    public function getSenha(){
      return $this->senha;
    }

    public function conecta(){
      try{
        $this->conexao = new PDO('mysql:host='.$this->hospedagem.';dbname='.$this->bancodedados,$this->usuario,$this->senha);
        return $this->conexao;
      }catch (PDOException $e){
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
      }
    }

    public function desconecta(){
      $this->conexao = null;
    }


  }
?>