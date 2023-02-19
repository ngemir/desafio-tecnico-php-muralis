# Teste Técnico PHP da Muralis
Projeto API gestão de Despesas
## Descrição da API
A API tem como objetivo cumprir exigência do [Teste Técnico PHP da Muralis](./D_PHP_INTERMEDIARIO_V01_16012023.pdf):
- Registrar Despesa
- Alterar Despesa
- Excluir Despesa
- Consultar Despesas do Mês (JSON)
- Gerar PDF da Despesa
- Gerar Planilha Excel da Despesa (Em Desenvolvimento)

## Link da API
`http://localhost:80/api/despesas/`

## Como utilizar cada função da API
### Registrar Despesa
|Atributos|Dados|
|---------|-----|
|valor|Integer|
|data_compra|YYYY-MM-DD|
|descricao|String|
pagamento|Dinheiro/Débito/Crédito/Pix|
|categoria|escreva o nome da categoria registrada|
|cep|ex: 00000-000|
|endereco_numero| Integer|

Detalhe: a categoria também pode ser cadastrada em `http://localhost:80/api/categorias/` informando : 
|Atributos|Dados|
|---------|-----|
|nome|String|
|descricao|String|

>Retorno será um JSON assim:
```
{
	"data": {
		"id": "1"
	},
	"success": true
}
```

### Alterar Despesa
|Atributos|Dados|
|---------|-----|
|id|Integer|
|oqueAlterar| Algum dos atributos do registro (valor, data_compra, descricao, pagamento, categoria, cep e endereco_numero)|
|dadosAlterar| Valor de acordo com cada campo. (ex: pagamento = Débito)

> Retorno será um JSON assim para confirmar a alteração feita (Ex: Alterando campo `descricao` do `id` = 1)
```
{
	"data": {
		"antes": {
			"id": 1,
			"descricao": "Aqui entra dado antigo",
			"data": "15-02-2023",
			"valor": 300,
			"categoria": "eletrônico",
			"pagamento": "Dinheiro",
			"cep": {
				"cep": "08780-060",
				"logradouro": "Rua Doutor Ricardo Vilela",
				"complemento": "de 785\/786 ao fim",
				"bairro": "Centro",
				"localidade": "Mogi das Cruzes",
				"uf": "SP",
				"ibge": "3530607",
				"gia": "4546",
				"ddd": "11",
				"siafi": "6713",
				"endereco_numero": "1313"
			}
		},
		"depois": {
			"id": 1,
			"descricao": "Aqui entra dado novo",
			"data": "15-02-2023",
			"valor": 300,
			"categoria": "eletrônico",
			"pagamento": "Dinheiro",
			"cep": {
				"cep": "08780-060",
				"logradouro": "Rua Doutor Ricardo Vilela",
				"complemento": "de 785\/786 ao fim",
				"bairro": "Centro",
				"localidade": "Mogi das Cruzes",
				"uf": "SP",
				"ibge": "3530607",
				"gia": "4546",
				"ddd": "11",
				"siafi": "6713",
				"endereco_numero": "1313"
			}
		}
	},
	"success": true
}
```

### Excluir Despesa
|Atributos|Dados|
|---------|-----|
|id|Integer|

> Retorna um JSON para falar que excluiu o dado:
```
{
	"data": {
		"antes": {
			"id": 1,
			"descricao": "Aqui entra dado novo",
			"data": "15-02-2023",
			"valor": 300,
			"categoria": "eletrônico",
			"pagamento": "Dinheiro",
			"cep": {
				"cep": "08780-060",
				"logradouro": "Rua Doutor Ricardo Vilela",
				"complemento": "de 785\/786 ao fim",
				"bairro": "Centro",
				"localidade": "Mogi das Cruzes",
				"uf": "SP",
				"ibge": "3530607",
				"gia": "4546",
				"ddd": "11",
				"siafi": "6713",
				"endereco_numero": "1313"
			}
		},
		"depois": "Dados excluído com sucesso"
	},
	"success": true
}
```

### Consultar Despesas
Detalhe: Como foi especificado no teste técnico, de padrão a consulta da Despesa pegará a despesa do mês que o computador se encontra.

`http://localhost:80/api/despesas/?formato="formatoAqui"&periodoDe="primeiroPeriodoAqui"&periodoAte="segundoPeriodoAqui"`

|Atributos|Dados|
|---------|-----|
|formato|json, pdf, excel|
|periodoDe | Date |
|periodoAte| Date |
|tudo|boolean|

> Retorno será de acordo com o formato escolhido

## Desenvolvedor
 <a href="https://github.com/ngemir">
 <div>
 <img src="https://avatars.githubusercontent.com/u/32247042?s=400&u=b41c30a3a3bce17ce990f35f39c294f3b96d3e9e&v=4" height="auto" width="50px">
 <span>Emir Takayama</span>
 </div>
</a>
