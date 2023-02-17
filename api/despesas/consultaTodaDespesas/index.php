<?php
  if($_SERVER["REQUEST_METHOD"] == "GET"){
    //conecta com Banco de dados
    require('../../../connection/connection.php');
    $db = new ConexaoBD();

    $mesAtual = date('m' ,time());
    $anoAtual = date('Y' ,time());
    $inicioMes = 01;
    $fimMes = 31;
    //criação do array para ser enviado como resposta
    $resultado = [];

    //Pega todas as despesas
    $conexao = $db->conecta();
    $despesa = $conexao->query('SELECT * FROM despesas WHERE data_compra ORDER BY data_compra ASC');
    
    //Fazer repetição pra fazer o tratamento da Foreign key e data, e preparação de envio
    foreach($despesa as $cada){
      //Pega categoria da Despesa registrada
      $buscaCategoria = $conexao->query('SELECT nome FROM categorias WHERE ' . $cada['categoria_id'] . ' =  id');
      
      $categoriaDespesa = [];

      foreach ($buscaCategoria as $categoria){
        array_push($categoriaDespesa, $categoria['nome']);
      }

      //Pega o tipo de pagamento da Despesa Registrada
      $buscaPagamento = $conexao->query('SELECT tipo FROM tipos_pagamento WHERE ' . $cada['tipo_pagamento_id'] . ' = id' );
      
      $pagamentoDespesa = [];

      foreach ($buscaPagamento as $pagamento){
        array_push($pagamentoDespesa, $pagamento['tipo']);
      }

      //tratamento para data que vem do banco de dados
      $data = strtotime($cada['data_compra']);
      $dataConvertido = date('d-m-Y', $data );

      //cria o array de 1 despesa
      $cadaDespesa = array("id" => $cada['id'],"descricao" => $cada['descricao'], "data" => $dataConvertido, "valor" => $cada['valor'], "categoria" => $categoriaDespesa, "pagamento" => $pagamentoDespesa);

      //insere no array que será a resposta da requisição
      array_push($resultado, $cadaDespesa);

      //Serve para visualizar na resposta da requisição pelo software de requisição (ex: Postman, Insomniac)
      // echo 'Data: ' . $dataConvertido . '</br> Descrição: ' . $cada['descricao'] . ' </br> Categoria: ' . $categoriaDaDespesa . ' </br> Tipo de Pagamento: ' . $pagamentoDaDespesa;
    }

    $conexao = $db->desconecta();
    //Preparar para envio

    $resposta = [
      "data" => $resultado,
      "success" => true
    ];

    header("Content-Type: application/json");
    echo json_encode($resposta);

  }
?>