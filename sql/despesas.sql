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