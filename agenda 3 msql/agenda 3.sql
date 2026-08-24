create database if not exists joao_de_barro;
use joao_de_barro;

CREATE TABLE sindico (
	matricula INT PRIMARY KEY,
	nome VARCHAR(100) NOT NULL,
	endereco VARCHAR(200) NOT NULL,
	telefone VARCHAR(20) NOT NULL
);

CREATE TABLE proprietario (
	rg VARCHAR(20) PRIMARY KEY,
	nome VARCHAR(100) NOT NULL,
	telefone VARCHAR(20),
	email VARCHAR(150)
);

CREATE TABLE condominio (
	codigo INT PRIMARY KEY,
	nome VARCHAR(100) NOT NULL,
	endereco VARCHAR(200) NOT NULL,
	matricula_sindico INT NOT NULL UNIQUE,
	CONSTRAINT fk_condominio_sindico
		FOREIGN KEY (matricula_sindico) REFERENCES sindico (matricula)
);

CREATE TABLE apartamento (
	codigo_condominio INT NOT NULL,
	numero INT NOT NULL,
	tipo ENUM('Padrão', 'Cobertura') NOT NULL,
	rg_proprietario VARCHAR(20) NOT NULL,
	PRIMARY KEY (codigo_condominio, numero),
	CONSTRAINT fk_apartamento_condominio
		FOREIGN KEY (codigo_condominio) REFERENCES condominio (codigo),
	CONSTRAINT fk_apartamento_proprietario
		FOREIGN KEY (rg_proprietario) REFERENCES proprietario (rg)
);

CREATE TABLE garagem (
	codigo_condominio INT NOT NULL,
	numero_apartamento INT NOT NULL,
	numero INT NOT NULL,
	tipo ENUM('Padrão', 'Coberta') NOT NULL,
	PRIMARY KEY (codigo_condominio, numero_apartamento),
	UNIQUE (codigo_condominio, numero),
	CONSTRAINT fk_garagem_apartamento
		FOREIGN KEY (codigo_condominio, numero_apartamento)
		REFERENCES apartamento (codigo_condominio, numero)
);
