<?php
  require ('../../connection/connection.php');
  if($_SERVER["REQUEST_METHOD"] == "GET"){
    $bd = new ConexaoBD();
    
    $categorias = [];
    
    $conexao = $bd->conecta();
    $pesquisa = $conexao->query("SELECT * FROM categorias");
    $conexao = $bd->desconecta();

    foreach ($pesquisa as $categoria) {
      array_push($categorias, $categoria);
    }

    $resposta = [
      "data" => $categorias,
      "success" => true
    ];

    echo json_encode($resposta);
  }