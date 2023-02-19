<?php
  //Tratamento do request PUT e DELETE
  function parseRequest()
  {
    // Fetch content and determine boundary
    $raw_data = file_get_contents('php://input');
    $boundary = substr($raw_data, 0, strpos($raw_data, "\r\n"));
  
    // Fetch each part
    $parts = array_slice(explode($boundary, $raw_data), 1);
    $data = array();
  
    foreach ($parts as $part) {
      // If this is the last part, break
      if ($part == "--\r\n") break;
  
      // Separate content from headers
      $part = ltrim($part, "\r\n");
      list($raw_headers, $body) = explode("\r\n\r\n", $part, 2);
  
      // Parse the headers list
      $raw_headers = explode("\r\n", $raw_headers);
      $headers = array();
      foreach ($raw_headers as $header) {
        list($name, $value) = explode(':', $header);
        $headers[strtolower($name)] = ltrim($value, ' ');
      }
  
      // Parse the Content-Disposition to get the field name, etc.
      if (isset($headers['content-disposition'])) {
        $filename = null;
        preg_match(
          '/^(.+); *name="([^"]+)"(; *filename="([^"]+)")?/',
          $headers['content-disposition'],
          $matches
        );
        list(, $type, $name) = $matches;
        isset($matches[4]) and $filename = $matches[4];
  
        // handle your fields here
        switch ($name) {
            // this is a file upload
          case 'userfile':
            file_put_contents($filename, $body);
            break;
  
            // default for all other files is to populate $data
          default:
            $data[$name] = substr($body, 0, strlen($body) - 2);
            break;
        }
      }
    }
    return $data;
  }
  //Mostrar o que está passando
  function teste($dados){
    echo "<pre>";
    var_dump($dados);
    echo "</pre>";
  }
  //Lida com dados duplicados que vem do banco de dados
  function trataDadosDuplicados($conexao, $dados){
    //tratamento para data que vem do banco de dados
    $data = strtotime($dados['data_compra']);
    $dataConvertido = date('d-m-Y', $data );
  
    //Tratamento da exibição de Categoria e Tipo de pagamento
    $categoriaDaDespesaStmt = $conexao->query("SELECT nome FROM categorias WHERE id = ". $dados['categoria_id']);
    $categoriaDaDespesa = $categoriaDaDespesaStmt->fetch()['nome'];
  
    $pagamentoDaDespesaStmt = $conexao->query("SELECT tipo FROM tipos_pagamento WHERE id = ". $dados['tipo_pagamento_id']);
    $pagamentoDaDespesa = $pagamentoDaDespesaStmt->fetch()['tipo'];
    
    $retorno = array(
      "id" => $dados['id'],
      "descricao" => $dados['descricao'], 
      "data" => $dataConvertido, 
      "valor" => $dados['valor'], 
      "categoria" => $categoriaDaDespesa, 
      "pagamento" => $pagamentoDaDespesa,
      "cep" => buscaCEP($dados['cep'], strval($dados['endereco_numero']))
    );
    
    return $retorno;
  }
  function conectaDB(){
    //conecta com Banco de dados
    require('../../connection/connection.php');
    $db = new ConexaoBD();
    return $db;
  }

  function requisitar($site){
    $req = curl_init();
    //configura o site para realizar requisicao
    curl_setopt($req, CURLOPT_URL, $site);
    //configura pra que cURL retorne string do site
    curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
    //executa requisicao e armazena resposta na variavel
    $resposta = curl_exec($req);
    //finaliza requisicao
    curl_close($req);

    return $resposta;
  }

  function buscaCEP($cep, $numero) {
    $valor = '';
    $resposta = '';
    //converte valor recebido para string sem traço
    if(gettype($cep) == 'integer'){
      $valor = strval($cep);
    }elseif(gettype($cep) == 'string'){
      $valor = str_replace('-','',$cep);
    }
    
    //validação do CEP
    if(strlen($valor) !== 8){
      $resposta = 'CEP incorreto';
    }else{
      $resposta = json_decode(requisitar('viacep.com.br/ws/'.$valor.'/json'));
      $resposta->endereco_numero = $numero;
    }

    return $resposta;
  }


  //GET
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    require('./consultaDespesas/consultar.php');
  }

  //POST
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require('./cadastraDespesas/cadastrar.php');
  }

  //PUT
  if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    require('./alterarDespesa/alterar.php');
  }

  //DELETE
  if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    require('./deletarDespesa/deletar.php');
  }
?>