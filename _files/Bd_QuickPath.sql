--select * from pessoa p inner join pessoa_juridica pj on p.id_pessoa = pj.id_pessoa
create sequence sid_pessoa;
create table pessoa(

id_pessoa integer not null default nextval('sid_pessoa'),
nome_pessoa varchar (70) not null,
telefone_pessoa varchar(15),
celular_pessoa varchar(15),
email_pessoa varchar(50),
cep varchar(9),
logradouro varchar(50),
numero integer,
complemento varchar(70),
bairro varchar(50),
cidade varchar(50),
uf char(2),
login_pessoa varchar(16) not null,
senha_pessoa text not null,
tipo_pessoa VARCHAR(20),
status VARCHAR(1),
CONSTRAINT pk_pessoa PRIMARY KEY (id_pessoa)
);



create sequence sid_fisica;
create table pessoa_fisica(
id_pessoa integer not null,
cpf_fisica varchar(15) not null UNIQUE,


CONSTRAINT pk_fisica PRIMARY KEY (id_pessoa),
CONSTRAINT fk_pessoa FOREIGN KEY(id_pessoa) REFERENCES pessoa(id_pessoa)
);




create table pessoa_juridica(
id_juridica integer NOT NULL,
cnpj_juridica varchar(18) not null UNIQUE,
razao_social varchar(70) not null UNIQUE,
descricao text,
imagem VARCHAR(50),

CONSTRAINT pk_juridica PRIMARY KEY (id_juridica),
CONSTRAINT fk_pessoajuridica FOREIGN KEY(id_juridica) REFERENCES pessoa(id_pessoa)
);

create sequence sid_cargo;

create table cargo(
id_cargo integer not null default nextval('sid_cargo'),
nome_cargo varchar(20),
id_restaurante INTEGER NOT NULL,

CONSTRAINT pk_cargo PRIMARY KEY(id_cargo),
CONSTRAINT fk_rest FOREIGN KEY(id_restaurante) REFERENCES pessoa_juridica(id_juridica)
);



create sequence sid_categoria;
create table categoria(
id_categoria integer not null default nextval('sid_categoria'),
nome_categoria varchar(20),
id_restaurante INTEGER NOT NULL,

CONSTRAINT pk_categoria PRIMARY KEY(id_categoria),
CONSTRAINT fk_rest FOREIGN KEY(id_restaurante) REFERENCES pessoa_juridica(id_juridica)
);

create sequence sid_funcionario;

create table funcionario(
id_funcionario integer not null,
id_cargo integer,
salario numeric(18,5),
id_restaurante integer,

CONSTRAINT pk_funcionario PRIMARY KEY (id_funcionario),
CONSTRAINT fk_pessoa FOREIGN KEY(id_funcionario) REFERENCES pessoa(id_pessoa),
CONSTRAINT fk_cargofunc FOREIGN KEY(id_cargo) REFERENCES cargo(id_cargo),
CONSTRAINT fk_rest FOREIGN KEY(id_restaurante) REFERENCES pessoa_juridica(id_juridica)
);

create sequence sid_num_mesa;
create table num_mesa(
id_num_mesa integer not null default nextval('sid_num_mesa'),
numero_mesa INTEGER NOT NULL,
mesa_ocupada char(1),
id_restaurante integer,

CONSTRAINT pk_num_mesa PRIMARY KEY (id_num_mesa),
CONSTRAINT fk_rest FOREIGN KEY(id_restaurante) REFERENCES pessoa_juridica(id_juridica)

);

create sequence sid_mesa;
create table mesa(
id_mesa integer not null default nextval('sid_mesa'),
numero_mesa integer,
id_funcionario integer,
id_pessoa integer,
id_restaurante integer,


CONSTRAINT pk_mesa PRIMARY KEY(id_mesa),
CONSTRAINT fk_rest FOREIGN KEY(id_restaurante) REFERENCES pessoa_juridica(id_juridica),
CONSTRAINT fk_num_mesa FOREIGN KEY (numero_mesa)REFERENCES num_mesa (id_num_mesa),
CONSTRAINT fk_funcmesa FOREIGN KEY(id_funcionario) REFERENCES funcionario(id_funcionario),
CONSTRAINT fk_pessoa FOREIGN KEY(id_pessoa) REFERENCES pessoa(id_pessoa)
);

create sequence sid_produto;

create table produto(
id_produto integer not null default nextval('sid_produto'),
nome_produto varchar(50) not null,
unidade_produto char(2) not null,
preco_produto numeric(10,2) not null,
quant_estoque integer,
id_categoria integer,
id_restaurante INTEGER,
imagem VARCHAR(30),


CONSTRAINT pk_produto PRIMARY KEY(id_produto),
CONSTRAINT fk_rest FOREIGN KEY(id_restaurante) REFERENCES pessoa_juridica(id_juridica),
CONSTRAINT fk_catproduto FOREIGN KEY(id_categoria) REFERENCES categoria(id_categoria)
);

create sequence sid_mesaproduto;
create table mesaproduto(
id_mesaproduto integer not null default nextval('sid_mesaproduto'),
id_mesa integer,
id_produto integer,

CONSTRAINT pk_mesaproduto PRIMARY KEY(id_mesaproduto),
CONSTRAINT fk_mesa FOREIGN KEY(id_mesa) REFERENCES mesa(id_mesa),
CONSTRAINT fk_produto FOREIGN KEY(id_produto) REFERENCES produto(id_produto)
);

create sequence sid_venda;
create table venda(
id_venda integer not null default nextval('sid_venda'),
preco_total numeric(10,2) NOT NULL,
data_venda VARCHAR(12),
hora_venda VARCHAR(10),
quantidade INTEGER,
tipo_pagamento VARCHAR(20),

id_funcionario INTEGER,
id_restaurante INTEGER NOT NULL,
id_pessoa INTEGER NOT NULL,
id_produto INTEGER NOT NULL,

CONSTRAINT pk_venda PRIMARY KEY(id_venda),
CONSTRAINT fk_rest FOREIGN KEY(id_restaurante) REFERENCES pessoa_juridica(id_juridica),
CONSTRAINT fk_pessoa FOREIGN KEY(id_pessoa) REFERENCES pessoa(id_pessoa),
CONSTRAINT fk_produto FOREIGN KEY(id_produto) REFERENCES produto(id_produto)
);




