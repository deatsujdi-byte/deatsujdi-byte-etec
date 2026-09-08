CREATE DATABASE IF NOT EXISTS bd_biblioteca;
USE bd_biblioteca;
CREATE TABLE filial (
    codigo INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    logradouro VARCHAR(150) NOT NULL,
    numero VARCHAR(10) NOT NULL,
    bairro VARCHAR(80) NOT NULL,
    cidade VARCHAR(80) NOT NULL,
    uf CHAR(2) NOT NULL,
    cep CHAR(9) NOT NULL,
    telefone_principal VARCHAR(20) NOT NULL,
    telefone_secundario VARCHAR(20) DEFAULT NULL,
    PRIMARY KEY (codigo),
    CONSTRAINT chk_uf CHECK (uf = UPPER(uf)),
    CONSTRAINT chk_cep CHECK (cep REGEXP '^[0-9]{5}-?[0-9]{3}$')
);
CREATE TABLE livro (
    isbn CHAR(13) NOT NULL,
    titulo VARCHAR(200) NOT NULL,
    autor VARCHAR(150) NOT NULL,
    ano_publicacao SMALLINT NOT NULL,
    editora VARCHAR(100) NOT NULL,
    numero_exemplares INT NOT NULL DEFAULT 1,
    genero_literario VARCHAR(50) NOT NULL,
    filial_codigo INT NOT NULL,
    PRIMARY KEY (isbn),
    CONSTRAINT fk_livro_filial
        FOREIGN KEY (filial_codigo) REFERENCES filial(codigo)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    CONSTRAINT chk_ano_publicacao CHECK (ano_publicacao BETWEEN 1900 AND 2100),
    CONSTRAINT chk_numero_exemplares CHECK (numero_exemplares >= 0)
);