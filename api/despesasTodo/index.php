<?php

if($_SERVER["REQUEST_METHOD"] == "GET"){
    //conecta com Banco de dados
    include('../../connection/connection.php');
    
    //criação do array para ser enviado como resposta
    $resultado = [];

    //Pega todas as despesas
    $despesa = $conexaobd->query('SELECT * FROM despesas');
    
    //Fazer repetição pra fazer o tratamento da Foreign key e data, e preparação de envio
    foreach($despesa as $cada){
      //Pega categoria da Despesa registrada
      $categoriaDaDespesa = mysqli_fetch_array($conexaobd->query('SELECT nome FROM categorias WHERE ' . $cada['categoria_id'] . ' =  id'))[0];
      //Pega o tipo de pagamento da Despesa Registrada
      $pagamentoDaDespesa = mysqli_fetch_array($conexaobd->query('SELECT tipo FROM tipos_pagamento WHERE ' . $cada['tipo_pagamento_id'] . ' = id' ))[0];
      
      //tratamento para data que vem do banco de dados
      $data = strtotime($cada['data_compra']);
      $dataConvertido = date('d-m-Y', $data );

      //cria o array de 1 despesa
      $cadaDespesa = array("id" => $cada['id'], "descricao" => $cada['descricao'], "data" => $dataConvertido, "valor" => $cada['valor'], "categoria" => $categoriaDaDespesa, "pagamento" => $pagamentoDaDespesa);

      //insere no array que será a resposta da requisição
      array_push($resultado, $cadaDespesa);

      //Serve para visualizar na resposta da requisição pelo software de requisição (ex: Postman, Insomniac)
      // echo 'Data: ' . $dataConvertido . '</br> Descrição: ' . $cada['descricao'] . ' </br> Categoria: ' . $categoriaDaDespesa . ' </br> Tipo de Pagamento: ' . $pagamentoDaDespesa;
    }

    //Preparar para envio

    $resposta = [
      "data" => $resultado,
      "success" => true
    ];

    header("Content-Type: application/json");
    echo json_encode($resposta);

  }
?>