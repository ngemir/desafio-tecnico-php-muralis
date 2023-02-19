<?php
$_DELETE = parseRequest();

$idDelete = $_DELETE['id'];

try{
  //Conexao com Banco de dados
  $db = conectaDB();
  $conexao = $db->conecta();

  //Pega os dados antes de ser excluído
  $seraApagadoStmt = $conexao->query('SELECT * FROM despesas WHERE id = '. $idDelete);
  $seraApagado = $seraApagadoStmt->fetch();
  $seraApagadoCorrigido = trataDadosDuplicados($conexao, $seraApagado);

  //Apaga os dados
  $conexao->query("DELETE FROM despesas WHERE id = ". $idDelete);

  //Pega os dados depos de ser excluído
  $existeApagado = $conexao->query('SELECT * FROM despesas WHERE id = '. $idDelete)->fetch();
  $depoisApagado = 'Não foi apagado';
  if(!$existeApagado){
    $depoisApagado = 'Dados excluído com sucesso';
  }
  
  //Dados para resposta
  $resposta = [
    "data" => [
      "antes" => $seraApagadoCorrigido,
      "depois" => $depoisApagado
    ],
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