--create sequence sid_endereco;

create table endereco(
id_endereco integer not null default nextval('sid_endereco'),
cep varchar(9),
logradouro varchar(50),
numero integer,
complemento varchar(70),
bairro varchar(50),
cidade varchar(50),
uf char(2),

--CONSTRAINT pk_endereco PRIMARY KEY(id_endereco)
--);

create sequence sid_cargo;

create table cargo(
id_cargo integer not null default nextval('sid_cargo'),
nome_cargo varchar(20),

CONSTRAINT pk_cargo PRIMARY KEY(id_cargo)
);

create sequence sid_categoria;

create table categoria(
id_categoria integer not null default nextval('sid_categoria'),
nome_categoria varchar(20),

CONSTRAINT pk_categoria PRIMARY KEY(id_categoria)
);

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

	CONSTRAINT pk_pessoa PRIMARY KEY (id_pessoa)
);

create sequence sid_fisica;

create table pessoa_fisica(
id_fisica integer not null default nextval('sid_fisica'),
cpf_fisica varchar(15) not null UNIQUE,
id_pessoa integer,

CONSTRAINT pk_fisica PRIMARY KEY (id_fisica),
CONSTRAINT fk_pessoafisica FOREIGN KEY(id_pessoa) REFERENCES pessoa(id_pessoa)
);

create sequence sid_juridica;

create table pessoa_juridica(
id_juridica integer not null default nextval('sid_juridica'),
cnpj_juridica varchar(18) not null UNIQUE,
razao_social varchar(70) not null UNIQUE,
id_pessoa integer,

CONSTRAINT pk_juridica PRIMARY KEY (id_juridica),
CONSTRAINT fk_pessoajuridica FOREIGN KEY(id_pessoa) REFERENCES pessoa(id_pessoa)
);

create sequence sid_funcionario;

create table funcionario(
id_funcionario integer not null default nextval('sid_funcionario'),
id_pessoa integer,
id_cargo integer,

CONSTRAINT pk_funcionario PRIMARY KEY (id_funcionario),
CONSTRAINT fk_pessoafunc FOREIGN KEY(id_pessoa) REFERENCES pessoa(id_pessoa),
CONSTRAINT fk_cargofunc FOREIGN KEY(id_cargo) REFERENCES cargo(id_cargo)
);

create sequence sid_mesa;

create table mesa(
id_mesa integer not null default nextval('sid_mesa'),
numero_mesa integer,
mesa_ocupada char(1),
id_funcionario integer,
id_pessoa integer,

CONSTRAINT pk_mesa PRIMARY KEY(id_mesa),
CONSTRAINT fk_funcmesa FOREIGN KEY(id_funcionario) REFERENCES funcionario(id_funcionario)
);

create sequence sid_produto;

create table produto(
id_produto integer not null default nextval('sid_produto'),
nome_produto varchar(50) not null,
unidade_produto char(2) not null,
preco_produto numeric(10,2) not null,
id_categoria integer,

CONSTRAINT pk_produto PRIMARY KEY(id_produto),
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