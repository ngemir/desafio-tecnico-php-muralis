<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de despesas</title>
</head>

<body>
  <?php include './view/components/buscaTabela.php' ?>

  <!-- Cadastro de Despesa = Método POST -->
  <div>
    <h2>Cadastro de despesa</h2>
    <form onsubmit="cadastraDespesa(event)" method="post">
      <input type="text" name="descricao" placeholder="Descrição" required />
      <input type="number" name="valor" placeholder="Valor R$" required />
      <input type="date" name="data" id="data" required >
      <select name="pagamento" id="pagamento" required></select>
      <select name="categoria" id="categoria" required></select>
      <input type="text" placeholder="CEP" id="cepInput" />
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
<!-- Mascara CEP -->
<script src="https://unpkg.com/imask"></script>
<script src="./view/js/trataCEP.js"></script>

<!-- Listar Menu -->
<script src="./view/js/listarMenu.js"></script>

<!-- GET -->
<script src="./view/js/criaTabela.js"></script>

<script src="./view/js/cadastraDespesa.js"></script>

<script src="">
  
</script>

</html>