<?php
    if($_SERVER["REQUEST_METHOD"] == "GET"){
      include '../../connection/connection.php';
      
      $tiposDePagamento = [];

      $buscaTiposDePagamento = $conexaobd->query("SELECT * FROM tipos_pagamento");
      
      foreach ($buscaTiposDePagamento as $tipoPagamento) {
        array_push($tiposDePagamento,$tipoPagamento);
      }

      $resposta = [
        "data" => $tiposDePagamento,
        "success" => true
      ];
      

      echo json_encode($resposta);
    }