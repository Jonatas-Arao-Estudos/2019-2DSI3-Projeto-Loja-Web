CREATE DATABASE loja;
USE loja;

CREATE TABLE categoria(
	id int primary key auto_increment,
	nome varchar(100) not null
);

CREATE TABLE produto(
	id int primary key auto_increment,
	nome varchar(100) not null,
	descricao longtext,
	valor decimal(10,2),
	fabricante varchar(100),
	id_categoria int,
	FOREIGN KEY (id_categoria) REFERENCES categoria(id)
);

CREATE TABLE foto(
	id int primary key auto_increment,
	id_produto int,
	foto varchar(120),
	FOREIGN KEY (id_produto) REFERENCES produto(id)
);