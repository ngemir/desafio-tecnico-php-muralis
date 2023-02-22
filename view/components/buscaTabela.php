<h1>Serviço de Orçamento Doméstico (POST)</h1>

<!-- Lista de Despesas = Método GET -->
<div>
  <h2>Ver a lista de despesas (GET)</h2>
  <input type="submit" id="botao" value="Lista de Despesas via GET" onclick="criarTabelaTudo()" />
  <input type="submit" id="botaoMes" value="Lista de Despesas do Mês via GET" onclick="criarTabelaMes()" />
  <div>
    <p>Busca Por período</p>
    <label>De :</label> <input type="date" id="inputPeriodoDe">
    <br>
    <label> Ate :</label> <input type="date" id="inputPeriodoAte">
    <input type="submit" id="botaoPeriodo" onclick="criarTabelaPeriodo()">
  </div>
  <br>
  <table id="tabelaDados">
    <tr>
      <th>ID</th>
      <th>Data da Compra</th>
      <th>Descrição</th>
      <th>Valor</th>
      <th>Tipo de Pagamento</th>
      <th>Categoria</th>
      <th>CEP</th>
      <th>Logradouro</th>
      <th>Bairro</th>
      <th>Número</th>
    </tr>
  </table>
  <div>
    <h2>Ver a lista de despesas Em PDF (GET)</h2>
    <input type="submit" value="Lista de Despesas em PDF via GET" onclick="criarTabelaTudoPDF()" />
    <input type="submit" value="Lista de Despesas do Mês em PDF via GET" onclick="criarTabelaMesPDF()" />
    <div>
      <p>Busca Por período</p>
      <label>De :</label> <input type="date" id="inputPeriodoDePDF">
      <br>
      <label> Ate :</label> <input type="date" id="inputPeriodoAtePDF">
      <input type="submit" id="botaoPeriodo" onclick="criarTabelaPeriodoPDF()">
    </div>
    <br>
  </div>
  <div>
    <h2>Ver a lista de despesas Em Excel (GET)</h2>
    <input type="submit" value="Lista de Despesas em Excel via GET" onclick="criarTabelaTudoExcel()" />
    <input type="submit" value="Lista de Despesas do Mês em Excel via GET" onclick="criarTabelaMesExcel()" />
    <div>
      <p>Busca Por período</p>
      <label>De :</label> <input type="date" id="inputPeriodoDeExcel">
      <br>
      <label> Ate :</label> <input type="date" id="inputPeriodoAteExcel">
      <input type="submit" id="botaoPeriodo" onclick="criarTabelaPeriodoExcel()">
    </div>
    <br>
  </div>
</div>