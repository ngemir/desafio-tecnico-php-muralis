<div>
  <h2>Cadastro de despesa (POST)</h2>
  <form onsubmit="cadastraDespesa(event)" method="post">
    <input type="text" name="descricao" placeholder="Descrição" required />
    <input type="number" name="valor" placeholder="Valor R$" required />
    <input type="date" name="data" id="data" required>
    <select name="pagamento" id="pagamento" required></select>
    <select name="categoria" id="categoria" required></select>
    <input type="text" placeholder="CEP" id="cepInput" />
    <input type="text" placeholder="Número" id="numeroInput" />
    <button type="submit">Cadastrar</button>
  </form>
  <p id="respostaCadastro"></p>
</div>