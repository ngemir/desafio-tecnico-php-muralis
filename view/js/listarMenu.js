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
        option.value = tipo.tipo;
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
        option.value = categoria.nome;
        option.text = categoria.nome;
        categoriaSelecao.appendChild(option);
      });
    })
}

//Executa as 2 funções acima de exibição do dropdown
window.onload = function () {
  listarPagamento();
  listarCategoria();
};