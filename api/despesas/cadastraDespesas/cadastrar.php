<?php

//pega os dados do Post
$inputValor = $_POST['valor'];
$inputData = $_POST['data'];
$inputDescricao = $_POST['descricao'];
$inputPagamento = $_POST['pagamento'];
$inputCategoria = $_POST['categoria'];
$inputCep = $_POST['cep'];
$inputEnderecoNumero = $_POST['numero'];

try {
  $db = conectaDB();
  $conexaobd = $db->conecta();

  $idTipoPagamentoStmt = $conexaobd->query("SELECT id FROM tipos_pagamento WHERE '" . $inputPagamento . "' = tipo");

  $idCategoriaStmt = $conexaobd->query("SELECT id FROM categorias WHERE '" . $inputCategoria . "' = nome");

  $idTipoPagamento = [];

  foreach ($idTipoPagamentoStmt as $id) {
    array_push($idTipoPagamento, $id['id']);
  }

  $idCategoria = [];
  foreach ($idCategoriaStmt as $id) {
    array_push($idCategoria, $id['id']);
  }

  $sql = "INSERT INTO despesas(valor, data_compra, descricao, tipo_pagamento_id, categoria_id, cep, endereco_numero) VALUES ( '" . $inputValor . "' , '" . $inputData . "' , '" . $inputDescricao . "' , '" . $idTipoPagamento[0] . "' , '" . $idCategoria[0] . "' , '" . $inputCep .  "' , " . $inputEnderecoNumero . ")";

  $stmt = $conexaobd->prepare($sql);
  $stmt->execute();


  echo "O novo valor foi inserido com sucesso";

  $idDoInsert = $conexaobd->lastInsertId();
  $db->desconecta();

  $resposta = [
    "data" => $idDoInsert,
    "success" => true
  ];

  header("Content-Type: application/json");
  echo json_encode($resposta);
} catch (PDOException $e) {

  echo "Error: Falha ao inserir registro :"  . $e->getMessage();

  $resposta = [
    "data" => [],
    "success" => false
  ];

  header("Content-Type: application/json");
  echo json_encode($resposta);
}
