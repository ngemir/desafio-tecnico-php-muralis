<?php
    if($_SERVER["REQUEST_METHOD"] == "GET"){
      include '../../connection/connection.php';

      $categorias = [];

      $buscaCategoria = $conexaobd->query("SELECT * FROM categorias");
      
      foreach ($buscaCategoria as $categoria) {
        array_push($categorias, $categoria);
      }

      $resposta = [
        "data" => $categorias,
        "success" => true
      ];

      echo json_encode($resposta);
    }