/* Lógico_2: */
CREATE DATABASE CRUD_MARCOS;
USE CRUD_MARCOS;

CREATE TABLE Cliente (
    id_cliente int PRIMARY KEY AUTO_INCREMENT,
    nome varchar(100),
    sobrenome varchar(100),
    cep char(9),
    numero int,
    sexo char(1),
    data_nascimento char(10),
    cpf char(14),
    rg char(12),
    guarda_religiosa char(1),
    obs varchar(100),
    telefone char(15),
    email varchar(100)
);

CREATE TABLE Endereco (
    cep char(9) PRIMARY KEY,
    logradouro varchar(100),
    bairro varchar(100),
    cod_cidade int
);

CREATE TABLE Cidade (
    cod_cidade int PRIMARY KEY AUTO_INCREMENT,
    cidade varchar(100),
    cod_estado int
);

CREATE TABLE Estado (
    cod_estado int PRIMARY KEY AUTO_INCREMENT,
    uf char(2),
    estado varchar(100)
);
 
ALTER TABLE Cliente ADD CONSTRAINT cep
    FOREIGN KEY (cep)
    REFERENCES Endereco (cep);
 
ALTER TABLE Endereco ADD CONSTRAINT cod_cidade
    FOREIGN KEY (cod_cidade)
    REFERENCES Cidade (cod_cidade);
 
ALTER TABLE Cidade ADD CONSTRAINT cod_estado
    FOREIGN KEY (cod_estado)
    REFERENCES Estado (cod_estado);


