USE tienda_master;

UPDATE usuarios SET imagen='largaroja.jpg';

CREATE TABLE direccion_habitual
(
    id_direccion INT PRIMARY KEY AUTO_INCREMENT,
    provincia VARCHAR (50) NOT NULL,
    localidad VARCHAR (50) NOT NULL,
    direccion VARCHAR (50) NOT NULL
);

ALTER TABLE usuarios ADD COLUMN id_direccion_habitual INT;
ALTER TABLE usuarios ADD CONSTRAINT fk_usuarios_direccion_habitual FOREIGN KEY (id_direccion_habitual) REFERENCES direccion_habitual(id_direccion);

INSERT INTO direccion_habitual VALUES(1,'Madrid','Madrid','calle bravo murillo 333');
UPDATE usuarios set id_direccion_habitual=1;

CREATE TABLE review
(
id_usuario INT,
id_producto INT,
review VARCHAR(200),
nota INT,
already_reviewed BIT,
CONSTRAINT pk_review   PRIMARY KEY (id_usuario,id_producto),
CONSTRAINT fk_review_producto FOREIGN KEY (id_producto) REFERENCES productos(id)
ON UPDATE CASCADE
ON DELETE CASCADE,
CONSTRAINT fk_review_usuario FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
ON UPDATE CASCADE
ON DELETE CASCADE
);