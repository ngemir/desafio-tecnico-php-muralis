// Cadastra Despesas --- POST
function cadastraDespesa(event){
  event.preventDefault();

  // Dados a ser enviado
  inputDescricao = event.target[0].value;
  inputValor = event.target[1].value;
  inputData = event.target[2].value;
  inputPagamento = event.target[3].value;
  inputCategoria = event.target[4].value;
  inputCep = event.target[5].value;
  inputNumero = event.target[6].value;
  
  //Aqui é o JSON dos dados que tem que ser o mesmo que o backend cadastrar
  const dados = {
    descricao: inputDescricao,
    valor: inputValor,
    data_compra: inputData,
    pagamento: inputPagamento,
    categoria: inputCategoria,
    cep: inputCep,
    endereco_numero: inputNumero
  }
  
  console.log(dados);
  //realiza requisição POST
  fetch('./api/despesas/', {
    method: 'POST',
    headers: {
    'Content-Type': 'application/json'
    },
    body: JSON.stringify(dados)
  })
  .then((response) => response.json())
  .then((data) => {
    console.log('Success:', data);
  })
  .catch((error) => {
    console.error('Error:', error);
  });

}