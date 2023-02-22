CREATE TABLE tipos_pagamento (
    id int NOT NULL AUTO_INCREMENT,
    tipo TEXT NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO tipos_pagamento(tipo) VALUES ('Dinheiro'),('Débito'),('Crédito'),('Pix');