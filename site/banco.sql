CREATE DATABASE fastfoot;

USE fastfoot;

CREATE TABLE usr(
    id_usr integer unsigned NOT NULL auto_increment,
    login varchar(64) NOT NULL,
    senha varchar(64) NOT NULL,
    PRIMARY KEY (id_usr)
);

CREATE TABLE clube(
	id_clube integer unsigned NOT NULL auto_increment,
    id_usr integer unsigned NOT NULL,
    nome_clube varchar(64) NOT NULL,
    dinheiro double NOT NULL,
    tatica integer,
    PRIMARY KEY (id_clube),
    FOREIGN KEY (id_usr) REFERENCES usr(id_usr)    
);

CREATE TABLE jogador(
	id_jogador integer unsigned NOT NULL auto_increment,
    id_clube integer unsigned NOT NULL,
    nome_jogador varchar(64) NOT NULL,
    dinheiro double NOT NULL,
    tatica integer NOT NULL,
    PRIMARY KEY (id_jogador),
    FOREIGN KEY (id_clube) REFERENCES clube(id_clube)    
);

CREATE TABLE amistoso(
    id_amistoso integer unsigned NOT NULL auto_increment,
    id_clube_convite integer unsigned NOT NULL,
    id_clube_convidado integer unsigned NOT NULL,
    estado integer NOT NULL,
    PRIMARY KEY (id_amistoso),
    FOREIGN KEY (id_clube_convite) REFERENCES clube(id_clube),
    FOREIGN KEY (id_clube_convidado) REFERENCES clube(id_clube)
);
