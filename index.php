<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de despesas</title>
</head>

<body>
  <h1>Serviço de Orçamento Doméstico (POST)</h1>

  <!-- Lista de Despesas = Método GET -->
  <div>
    <h2>Ver a lista de despesas (GET)</h2>
    <input type="submit" id="botao" value="Lista de Despesas via GET" onclick="criarTabela()" />
    <input type="submit" id="botaoMes" value="Lista de Despesas do Mês via GET" onclick="criarTabelaMes()" />
    <table id="tabelaDados">
      <tr>
        <th>ID</th>
        <th>Data da Compra</th>
        <th>Descrição</th>
        <th>Valor</th>
        <th>Tipo de Pagamento</th>
        <th>Categoria</th>
      </tr>
      <tr></tr>
    </table>
  </div>

  <!-- Cadastro de Despesa = Método POST -->
  <div>
    <h2>Cadastro de despesa</h2>
    <form action="./api/despesas/" method="post">
      <input type="text" name="descricao" placeholder="Descrição" required />
      <input type="number" name="valor" placeholder="Valor R$" required />
      <input type="date" name="data" id="data" required >
      <select name="pagamento" id="pagamento" required></select>
      <select name="categoria" id="categoria" required></select>
      <button type="submit">Cadastrar</button>
    </form>
    <p id="respostaCadastro"></p>
  </div>

  <!-- Alteração de Despesa = Método PUT -->
  <div>
    <h2>Alteração de despesa registrado (PUT)</h2>
    <form action="./api/despesas" method="put">

    </form>
  </div>

  <!-- Excluir Despesa = Método DELETE -->
  <div>
    <h2>Excluir despesa (DELETE)</h2>
    <form action="./api/despesas/" method="delete"></form>
  </div>


</body>

<script>
  //Requisições GET

  //Busca tabela toda e insere na interface (pronto)
  function criarTabela() {
    //requisição para buscar os dados
    fetch('./api/despesasTodo/', {
      headers: {
          'Accept': 'application/json'
      },
      method: 'GET'
    })
    .then(response => response.json())
    .then(despesas => {
      const table = document.getElementById("tabelaDados");
      despesas.data.forEach(despesa => {
        // Forma a linha e coluna tabela
        let row = table.insertRow(-1);
        let id = row.insertCell(0);
        let data = row.insertCell(1);
        let descricao = row.insertCell(2);
        let valor = row.insertCell(3);
        let tipoPagamento = row.insertCell(4);
        let Categoria = row.insertCell(5);
    
        //Insere os dados na célula
        id.innerHTML = despesa.id;
        data.innerHTML = despesa.data;
        descricao.innerHTML = despesa.descricao;
        valor.innerHTML = despesa.valor;
        tipoPagamento.innerHTML = despesa.pagamento;
        Categoria.innerHTML = despesa.categoria;

        document.getElementById('botao').disabled = true;
        document.getElementById('botaoMes').disabled = true;
        
      });      
    })
  }

  //Busca tabela do mês e insere na interface (pronto)
  function criarTabelaMes() {
    //requisição para buscar os dados
    fetch('./api/despesas/', {
      headers: {
          'Accept': 'application/json'
      },
      method: 'GET'
    })
    .then(response => response.json())
    .then(despesas => {
      const table = document.getElementById("tabelaDados");
      despesas.data.forEach(despesa => {
        // Forma a linha e coluna tabela
        let row = table.insertRow(-1);
        let id = row.insertCell(0);
        let data = row.insertCell(1);
        let descricao = row.insertCell(2);
        let valor = row.insertCell(3);
        let tipoPagamento = row.insertCell(4);
        let Categoria = row.insertCell(5);
    
        //Insere os dados na célula
        id.innerHTML = despesa.id;
        data.innerHTML = despesa.data;
        descricao.innerHTML = despesa.descricao;
        valor.innerHTML = despesa.valor;
        tipoPagamento.innerHTML = despesa.pagamento;
        Categoria.innerHTML = despesa.categoria;

        document.getElementById('botao').disabled = true;
        document.getElementById('botaoMes').disabled = true;
      });      
    })
  }

  //Busca os tipos de pagamento para inserir no menu dropdown (pronto)
  function listarPagamento() {
    const pagamento = document.getElementById('pagamento');
    fetch('./api/tipospagamento/', {
      method: 'GET'
    })
    .then(resposta => resposta.json())
    .then(tiposPagamento => {
      tiposPagamento.data.forEach(tipo => {
        let option = document.createElement('option');
        option.value = tipo.id;
        option.text = tipo.tipo;
        pagamento.appendChild(option);
      });
    })
  }

  //Busca as Categorias para inserir no menu dropdown (pronto)
  function listarCategoria() {
    let categoriaSelecao = document.getElementById('categoria');
    fetch('./api/categorias/', {
      method: 'GET'
    })
    .then(resposta => resposta.json())
    .then(categorias => {
      categorias.data.forEach(categoria => {
        let option = document.createElement('option');
        option.value = categoria.id;
        option.text = categoria.nome;
        categoriaSelecao.appendChild(option);
      });
    })
  }

  //Executa as 2 funções acima de exibição do dropdown
  window.onload = function() {
    listarPagamento();
    listarCategoria();
  };


</script>

</html>