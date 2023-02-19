<?php
require('../../connection/connection.php');
if ($_SERVER["REQUEST_METHOD"] == "GET") {
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $categoria = $_POST['nome'];
  $descricao = $_POST['descricao'];
  $bd = new ConexaoBD();
  $conexao = $bd->conecta();

  $sql = "INSERT INTO categorias(nome, descricao) VALUES ('". $categoria . "', '" . $descricao . "' )";

  $stmt = $conexao->prepare($sql);
  $stmt->execute();

  $idDoInsert = $conexao->lastInsertId();
  $bd->desconecta();

  $resposta = [
    "data" => $idDoInsert,
    "success" => true
  ];

  header("Content-Type: application/json");
  echo json_encode($resposta);
}
