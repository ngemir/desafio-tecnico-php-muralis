<?php
try {
  //Dados para filtrar o mês
  $mesAtual = date('m', time());
  $anoAtual = date('Y', time());
  $inicioMes = 01;
  $fimMes = 31;

  //criação do array para ser enviado como resposta
  $resultado = [];

  //Pega todas as despesas
  $db = conectaDB();
  $conexao = $db->conecta();
  $despesaStmt = $conexao->query('SELECT * FROM despesas WHERE data_compra BETWEEN ("' . $anoAtual . '/' . $mesAtual . '/' . $inicioMes . '") AND ("' . $anoAtual . '/' . $mesAtual . '/' . $fimMes . '") ORDER BY data_compra ASC');

  $despesa = $despesaStmt->fetchAll();

  //Fazer repetição pra fazer o tratamento da Foreign key e data, e preparação de envio
  foreach ($despesa as $cada) {
    array_push($resultado, trataDadosDuplicados($conexao, $cada));
  }

  $conexao = $db->desconecta();
  //Preparar para envio

  $resposta = [
    "data" => $resultado,
    "success" => true
  ];

  header("Content-Type: application/json");
  echo json_encode($resposta);
  
} catch (PDOException $e) {
  echo "Error: Falha ao alterar registro :"  . $e->getMessage();

  $resposta = [
    "data" => [],
    "success" => false
  ];

  header("Content-Type: application/json");
  echo json_encode($resposta);
}
