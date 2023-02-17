<h1>Serviço de Orçamento Doméstico (POST)</h1>

  <!-- Lista de Despesas = Método GET -->
  <div>
    <h2>Ver a lista de despesas (GET)</h2>
    <input type="submit" id="botao" value="Lista de Despesas via GET" onclick="criarTabelaToda()" />
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