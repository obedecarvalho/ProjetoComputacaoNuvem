CREATE TABLE usr ( id_usr serial not null primary key, login varchar(64) not null, senha varchar(64) not null );

CREATE TABLE clube ( id_clube serial not null primary key, id_usr integer not null references usr(id_usr), nome_clube varchar(64) not null, patrimonio integer not null, tatica integer not null);

CREATE TABLE jogador ( id_jogador serial not null primary key, id_clube integer references clube(id_clube), nome_jogador varchar(64) not null, forca integer not null, posicao integer not null, escalado integer not null);


CREATE TABLE amistoso(id_amistoso serial NOT NULL primary key,   id_clube_convite integer NOT NULL references clube(id_clube),    id_clube_convidado integer NOT NULL references clube(id_clube),    estado integer NOT NULL);



