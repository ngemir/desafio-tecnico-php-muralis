<?php
function pegaDados()
{
  try {
    //Dados para filtrar o mês
    $mesAtual = date('m', time());
    $anoAtual = date('Y', time());
    $inicioMes = 01;
    $fimMes = 31;

    
    
    //Pega todas as despesas
    $db = conectaDB();
    $conexao = $db->conecta();
    $despesaStmt = $conexao->query('SELECT * FROM despesas WHERE data_compra BETWEEN ("' . $anoAtual . '/' . $mesAtual . '/' . $inicioMes . '") AND ("' . $anoAtual . '/' . $mesAtual . '/' . $fimMes . '") ORDER BY data_compra ASC');

    $despesa = $despesaStmt->fetchAll();

    $retorno = [];
    //Fazer repetição pra fazer o tratamento da Foreign key e data, e preparação de envio
    foreach ($despesa as $cada) {
      array_push($retorno, trataDadosDuplicados($conexao, $cada));
    }

    $conexao = $db->desconecta();

    $retorno = [
      "data" => $retorno,
      "success" => true
    ];

    return $retorno;
  } catch (PDOException $e) {

    echo "Error: Falha ao alterar registro :"  . $e->getMessage();
  }
  $retorno = [
    "data" => [],
    "success" => false
  ];

  return $retorno;
}

function pegaDadosPeriodo($periodoDe, $periodoAte)
{
  try {  
    
    //Pega todas as despesas
    $db = conectaDB();
    $conexao = $db->conecta();
    $despesaStmt = $conexao->query('SELECT * FROM despesas WHERE data_compra BETWEEN ("' . $periodoDe . '") AND ("' . $periodoAte . '") ORDER BY data_compra ASC');

    $despesa = $despesaStmt->fetchAll();

    $retorno = [];
    //Fazer repetição pra fazer o tratamento da Foreign key e data, e preparação de envio
    foreach ($despesa as $cada) {
      array_push($retorno, trataDadosDuplicados($conexao, $cada));
    }

    $conexao = $db->desconecta();

    $retorno = [
      "data" => $retorno,
      "success" => true
    ];

    return $retorno;
  } catch (PDOException $e) {

    echo "Error: Falha ao alterar registro :"  . $e->getMessage();
  }
  $retorno = [
    "data" => [],
    "success" => false
  ];

  return $retorno;
}

function pegaTodosDados()
{
  try {  
    
    //Pega todas as despesas
    $db = conectaDB();
    $conexao = $db->conecta();
    $despesaStmt = $conexao->query('SELECT * FROM despesas ORDER BY data_compra ASC');

    $despesa = $despesaStmt->fetchAll();

    $retorno = [];
    //Fazer repetição pra fazer o tratamento da Foreign key e data, e preparação de envio
    foreach ($despesa as $cada) {
      array_push($retorno, trataDadosDuplicados($conexao, $cada));
    }

    $conexao = $db->desconecta();

    $retorno = [
      "data" => $retorno,
      "success" => true
    ];

    return $retorno;
  } catch (PDOException $e) {

    echo "Error: Falha ao alterar registro :"  . $e->getMessage();
  }
  $retorno = [
    "data" => [],
    "success" => false
  ];

  return $retorno;
}


// A consulta Inicia aqui -------------------------

if(isset($_GET['formato']) == true){
  //Verificação se existe período informado da qual quer
  if(isset($_GET['periodoDe']) == true && isset($_GET['periodoAte']) == true){
    if($_GET['periodoDe'] !== null && $_GET['periodoAte'] !== null && $_GET['periodoDe'] !== '' && $_GET['periodoAte'] !== ''){
      $periodoDe = $_GET['periodoDe'];
      
      $periodoAte = $_GET['periodoAte'];
      
      $periodoDe = strtotime($periodoDe);
      $periodoAte = strtotime($periodoAte);
      
      $periodoDe = date('Y-m-d', $periodoDe);
      $periodoAte = date('Y-m-d', $periodoAte);
    }
  }

  //Verifica qual formato de dados foi solicidado
  if ($_GET['formato'] == '' || $_GET['formato'] == 'json') {
    //Validação se existe período exigido, senão pega todas despesas
    if(isset($_GET['tudo']) == true){
      $resposta = pegaTodosDados();
    }elseif(isset($_GET['periodoDe']) == true && isset($_GET['periodoAte']) == true){
      if($_GET['periodoDe'] !== null && $_GET['periodoAte'] !== null && $_GET['periodoDe'] !== '' && $_GET['periodoAte'] !== ''){
        $resposta = pegaDadosPeriodo($periodoDe, $periodoAte);
      }else{
        $resposta = pegaDados();
      }
    }else{
      $resposta = pegaDados();
    }

    header("Content-Type: application/json");
    echo json_encode($resposta);
  }

  // envia os dados em formato pdf
  if ($_GET['formato'] == 'pdf') {
    //caminho da lib usada para gerar PDF
    require('../../library/fpdf/PDF_MySQL_Table.php');

    //Dados para filtrar o mês atual
    $mesAtual = date('m', time());
    $anoAtual = date('Y', time());
    $inicioMes = 01;
    $fimMes = 31;
    
    class PDF extends PDF_MySQL_Table
    {
      // Page header
      function Header()
      {
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Title
        $this->SetFillColor(52, 218, 247);
        $this->Cell(0, 10, 'Despesa Mensal', 1, 0, 'C', true);
        // Line break
        $this->Ln(10);
      }

      // Page footer
      function Footer()
      {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
      }
    }

    // Conecta no banco de dados (A Lib funciona com mysqli_connect)
    $link = mysqli_connect('localhost', 'root', '', 'muralisphp');
    
    // Classe da lib FPDF
    $pdf = new PDF();

    //Cria página PDF
    $pdf->AddPage('L', 'A4', 0);
    
    // Cria tabela de acordo com a conexão no banco de dados
    // definição da propriedade da tabela
    $prop = array(
      'HeaderColor' => array('0','0','0'),
      'textColor' => array('255', '255', '255')    
    );

    //Validação se existe período exigido, senão pega todas despesas
    if(isset($_GET['tudo']) == true) {
      $pdf->Table($link, 'SELECT * FROM despesas ORDER BY id ASC', $prop);
    }elseif(isset($_GET['periodoDe']) == true && isset($_GET['periodoAte']) == true){
      if($_GET['periodoDe'] !== null && $_GET['periodoAte'] !== null && $_GET['periodoDe'] !== '' && $_GET['periodoAte'] !== ''){
        $pdf->Table($link, 'SELECT * FROM despesas WHERE data_compra BETWEEN "' . $periodoDe . '" AND "' . $periodoAte . '" ORDER BY id ASC', $prop);
      }else{
        $pdf->Table($link, 'SELECT * FROM despesas WHERE data_compra BETWEEN ("' . $anoAtual . '/' . $mesAtual . '/' . $inicioMes . '") AND ("' . $anoAtual . '/' . $mesAtual . '/' . $fimMes . '") ORDER BY data_compra ASC', $prop);
      }
    }else{
      $pdf->Table($link, 'SELECT * FROM despesas WHERE data_compra BETWEEN ("' . $anoAtual . '/' . $mesAtual . '/' . $inicioMes . '") AND ("' . $anoAtual . '/' . $mesAtual . '/' . $fimMes . '") ORDER BY data_compra ASC', $prop);
    }

    //Exibir PDF
    $pdf->Output('I', 'Despesa Mensal', true);
  }

  //envia os dados em formato excel
  if ($_GET['formato'] == 'excel') {
    
  }

  if ($_GET['formato'] == 'teste') {
    $link = mysqli_connect('localhost', 'root', '', 'muralisphp');
    $result = mysqli_query($link, "SELECT * FROM despesas", MYSQLI_USE_RESULT);
    foreach($result as $obj){
      $obj = $result->fetch_object();
      $diaMesAno = $obj->data_compra;
      $diaMesAno = substr($diaMesAno, 0, 10);
      $diaMesAno = strtotime($diaMesAno);
      $diaMesAno = date('d-m-Y', $diaMesAno);
      teste($diaMesAno);
    }

  }
}