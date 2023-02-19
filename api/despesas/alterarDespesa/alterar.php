<?php
//Função para lidar com requisição PUT (Não alterar)
//Tratamento de dados recebidos
$_PUT = parseRequest();

$idReferencia = $_PUT['id'];
$oqueAlterar = $_PUT['oqueAlterar'];
$dadosAlterar = $_PUT['dadosAlterar'];

if($oqueAlterar == 'data_compra'){
  //Tratamento da data
  $dadosAlterar = strtotime($dadosAlterar);
  $dadosAlterar = date('Y-m-d', $dadosAlterar);
}

try {
  //Conexão com banco de dados
  $db = conectaDB();
  $conexao = $db->conecta();

  //Busca os dados antes de ser alterado
  $mostrarAntesStmt = $conexao->query('SELECT * FROM despesas WHERE id = ' . $idReferencia);
  $mostrarAntesDuplicado = $mostrarAntesStmt->fetch();
  $mostrarAntes = trataDadosDuplicados($conexao, $mostrarAntesDuplicado);


  //Executa a Alteração
  $alteraStmt = $conexao->query('UPDATE despesas SET ' . $oqueAlterar . ' = "' . $dadosAlterar . '" WHERE id = ' . $idReferencia);

  //Busca os dados alterados
  $mostrarAlteradoStmt = $conexao->query('SELECT * FROM despesas WHERE id = ' . $idReferencia);
  $mostrarAlteradoDuplicado = $mostrarAlteradoStmt->fetch();
  $mostrarAlterado = trataDadosDuplicados($conexao, $mostrarAlteradoDuplicado);

  $db->desconecta();

  //Resposta de retorno
  $resposta = [
    "data" => [
      "antes" => $mostrarAntes,
      "depois" => $mostrarAlterado
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
