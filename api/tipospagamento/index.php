<?php
  require ('../../connection/connection.php');
  if($_SERVER["REQUEST_METHOD"] == "GET"){
    $bd = new ConexaoBD();
    
    $pagamentos = [];
    
    $conexao = $bd->conecta();
    $pesquisa = $conexao->query("SELECT * FROM tipos_pagamento");
    $conexao = $bd->desconecta();

    foreach ($pesquisa as $pagamento) {
      array_push($pagamentos, $pagamento);
    }

    $resposta = [
      "data" => $pagamentos,
      "success" => true
    ];

    echo json_encode($resposta);
  }