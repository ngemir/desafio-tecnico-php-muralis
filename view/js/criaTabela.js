//Requisições GET

//Busca tabela toda e insere na interface (pronto)
function criarTabelaToda() {
  //requisição para buscar os dados
  fetch('./api/despesas/consultaTodaDespesas', {
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