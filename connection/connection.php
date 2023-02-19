<?php
  class ConexaoBD{
    private $hospedagem = 'localhost';
    private $bancodedados = 'phpmuralis';
    private $usuario = 'root';
    private $senha = '';
    
    public $conexao;

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