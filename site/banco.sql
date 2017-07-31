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
    patrimonio double NOT NULL,
    tatica integer NOT NULL, # 1 a 5 (3-4-3, 3-5-2, 4-4-2, 4-3-3, 5-4-1)
    PRIMARY KEY (id_clube),
    FOREIGN KEY (id_usr) REFERENCES usr(id_usr),
    UNIQUE (id_usr)
);

CREATE TABLE jogador(
	id_jogador integer unsigned NOT NULL auto_increment,
    id_clube integer unsigned, #jogadores sem clube = NULL
    nome_jogador varchar(64) NOT NULL,
    forca integer NOT NULL, # 1 a 10
    posicao integer NOT NULL, # 1 a 4 (G,D,M,A)
    escalado integer NOT NULL, # 0 a 1(nao escalado ou escalado)
    PRIMARY KEY (id_jogador),
    FOREIGN KEY (id_clube) REFERENCES clube(id_clube)    
);

CREATE TABLE amistoso(
    id_amistoso integer unsigned NOT NULL auto_increment,
    id_clube_convite integer unsigned NOT NULL,
    id_clube_convidado integer unsigned NOT NULL,
    estado integer NOT NULL, # 1 a 3 (esperando, rejeitado, realizado)
    PRIMARY KEY (id_amistoso),
    FOREIGN KEY (id_clube_convite) REFERENCES clube(id_clube),
    FOREIGN KEY (id_clube_convidado) REFERENCES clube(id_clube)
);
