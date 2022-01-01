USE tienda_master;

CREATE TABLE direccion_habitual
(
    id_direccion INT PRIMARY KEY AUTO_INCREMENT,
    provincia VARCHAR (50) NOT NULL,
    localidad VARCHAR (50) NOT NULL,
    direccion VARCHAR (50) NOT NULL
);

ALTER TABLE usuarios ADD COLUMN id_direccion_habitual INT;
ALTER TABLE usuarios ADD CONSTRAINT fk_usuarios_direccion_habitual FOREIGN KEY (id_direccion_habitual) REFERENCES direccion_habitual(id_direccion);
