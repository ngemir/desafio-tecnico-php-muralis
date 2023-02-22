//Requisições GET
function colocarDados(despesas) {
  const table = document.getElementById("tabelaDados");
  despesas.data.forEach(despesa => {
    console.log(despesa)
    // Forma a linha e coluna tabela
    let row = table.insertRow(-1);
    let id = row.insertCell(0);
    let data = row.insertCell(1);
    let descricao = row.insertCell(2);
    let valor = row.insertCell(3);
    let tipoPagamento = row.insertCell(4);
    let categoria = row.insertCell(5);
    let cep = row.insertCell(6);
    let cepLogradouro = row.insertCell(7);
    let cepBairro = row.insertCell(8);
    let cepNumero = row.insertCell(9);

    //Insere os dados na célula
    id.innerHTML = despesa.id;
    data.innerHTML = despesa.data_compra;
    descricao.innerHTML = despesa.descricao;
    valor.innerHTML = despesa.valor;
    tipoPagamento.innerHTML = despesa.pagamento;
    categoria.innerHTML = despesa.categoria;
    cep.innerHTML = despesa.cep.cep;
    cepLogradouro.innerHTML = despesa.cep.logradouro
    cepBairro.innerHTML = despesa.cep.bairro
    cepNumero.innerHTML = despesa.cep.endereco_numero

    document.getElementById('botao').disabled = true;
    document.getElementById('botaoMes').disabled = true;
    document.getElementById('botaoPeriodo').disabled = true;
  })
}

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
      colocarDados(despesas);
    });
}

function criarTabelaTudo() {
  //requisição para buscar os dados
  fetch('./api/despesas/?tudo=true', {
    headers: {
      'Accept': 'application/json'
    },
    method: 'GET'
  })
    .then(response => response.json())
    .then(despesas => {
      colocarDados(despesas);
    });
}

function criarTabelaPeriodo() {

  let periodoDe = document.getElementById('inputPeriodoDe').value;
  let periodoAte = document.getElementById('inputPeriodoAte').value;
  
  //requisição para buscar os dados
  fetch('./api/despesas/?periodoDe=' + periodoDe + '&periodoAte=' + periodoAte, {
    headers: {
      'Accept': 'application/json'
    },
    method: 'GET'
  })
    .then(response => response.json())
    .then(despesas => {
      colocarDados(despesas);
    });
}

function criarTabelaMesPDF() {

  window.location.href = 'api/despesas/?formato=pdf';
}

function criarTabelaTudoPDF() {
  window.location.href = 'api/despesas/?formato=pdf&tudo=true';
}

function criarTabelaPeriodoPDF() {

  let periodoDe = document.getElementById('inputPeriodoDePDF').value;
  let periodoAte = document.getElementById('inputPeriodoAtePDF').value;

  window.location.href = `api/despesas/?formato=pdf&periodoDe=${periodoDe}&periodoAte=${periodoAte}`
  
}

function criarTabelaMesExcel() {

  window.location.href = 'api/despesas/?formato=excel';
}

function criarTabelaTudoExcel() {
  window.location.href = 'api/despesas/?formato=excel&tudo=true';
}

function criarTabelaPeriodoExcel() {

  let periodoDe = document.getElementById('inputPeriodoDeExcel').value;
  let periodoAte = document.getElementById('inputPeriodoAteExcel').value;

  window.location.href = `api/despesas/?formato=excel&periodoDe=${periodoDe}&periodoAte=${periodoAte}`
  
}
