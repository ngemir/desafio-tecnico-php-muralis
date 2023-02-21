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
`http://localhost/api/despesas/`

## Preparativo para API
### SQL do banco de dados
```
CREATE TABLE tipos_pagamento (
    id int NOT NULL AUTO_INCREMENT,
    tipo TEXT NOT NULL,
    PRIMARY KEY (id)
);
CREATE TABLE categorias (
    id int NOT NULL AUTO_INCREMENT,
    nome TEXT NOT NULL,
    descricao TEXT NOT NULL,
    PRIMARY KEY (id)
);
CREATE TABLE despesas (
    id int NOT NULL,
    valor REAL(20,2) NOT NULL,
    data_compra DATETIME NOT NULL,
    descricao TEXT NOT NULL,
    tipo_pagamento_id INT NOT NULL,
    categoria_id INT NOT NULL,
    cep TEXT(9),
    endereco_numero INT,
    PRIMARY KEY (id),
    CONSTRAINT FK_tipo_pagamento FOREIGN KEY (tipo_pagamento_id) REFERENCES tipos_pagamento(id),
    CONSTRAINT FK_categoria FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);
```
### Importante: Ter categoria e Tipo de pagamento registrados
Como a despesa utiliza id de Categoria e Tipo de pagamento, sem elas devidamente registrada acabará por dar erro ao cadastrar a despesa.

O Tipo de pagamento tem que inserir diretamente no banco de dados os 4 tipo de pagamento : `INSERT INTO tipos_pagamento(tipo) VALUES ('Dinheiro'),('Débito'),('Crédito'),('Pix');`

A categoria pode ser cadastrada em `http://localhost/api/categorias/` informando : 
|Atributos|Dados|
|---------|-----|
|nome|String|
|descricao|String|

![Registrar Categoria]('./GIF/CadastroDeCategorias.gif')

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

![Registrar Despesas]('./GIF/CadastroDeDespesas.gif')

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

![Alterar Despesa]('./GIF/AlterarDespesas.gif')

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

![Excluir Despesa]('./GIF/DeletarDespesas.gif')

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

Temos 3 padrões para consulta.

1. Formato (`json` | `pdf` | `excel`):
-  `http://localhost/api/despesas/` e `http://localhost/api/despesas/?formato=json` : Será retornado JSON da despesa do mês atual.

![]('./GIF/ConsultaDespesasFormato.gif');

- `http://localhost/api/despesas/?formato=pdf` : Será retornado a despesa do mês no formato pdf

![]('./GIF/ConsultaDespesasFormato.gif');

- `http://localhost/api/despesas/?formato=excel` : Só funciona em navegador, pois irá realizar o download do arquivo Excel com os dados do mês.

![]('./GIF/ConsultaDespesasFormatoExcel.gif');

2. Tudo (`true` | `false`)
- `http://localhost/api/despesas/?tudo=true` : Retorna toda despesa registrada

3. Período (periodoDe = `21-02-2023` | periodoAte = `22-02-2023`)
- `http://localhost/api/despesas/?periodoDe=(DataAqui)&periodoAte=(DataAqui)` : Em (DataAqui) substitua por ex: 18-02-2023 para filtrar despesas do período especificado.

4. Exemplo de requisição:
- `http://localhost/api/despesas/?formato=json&periodoDe=18-02-2023&periodoAte=20-02-2023`
- `http://localhost/api/despesas/?formato=pdf&tudo=true`
- `http://localhost/api/despesas/?formato=excel`

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
