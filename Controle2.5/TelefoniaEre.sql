create database if not exists TELEFONIA;
use TELEFONIA;

create table if not exists ADMINISTRADORES(
	idAdministrador int not null primary key auto_increment,
    nome varchar(75) not null,
    email varchar(75) not null,
    senha varchar(75) not null,
    inserido date not null,
    visivel boolean not null
);

create table if not exists SETORES(
	idSetores int not null primary key auto_increment,
    nomeSetor varchar(75) not null,
	inserido date not null,
    visivel boolean
);

create table if not exists USUARIOS(
	idUsuarios int not null primary key auto_increment,
    nome varchar(75) not null,
    email varchar(75) not null,
    senha varchar(75) not null,
    setor int not null,
	inserido date not null,
    visivel boolean not null,
    foreign key(SETOR)
		references SETORES(idSetores)
);

create table if not exists SITUACAO(
	idSituacao int not null primary key auto_increment,
    descricao varchar(75),
    visivel boolean not null
);

create table if not exists OPERADORAS(
	idOperadoras int not null primary key auto_increment,
    nomeOperadora varchar(75),
    custoMin float not null,
	inserida date not null,
    visivel boolean not null
);

create table if not exists TELEFONES(
	numTelefones bigint not null primary key auto_increment,
    operadora int not null,
	inserido date not null,
    visivel boolean not null,
	foreign key(operadora)
		references OPERADORAS(idOperadoras)
);

CREATE TABLE IF NOT EXISTS `TELEFONIA`.`Ligacoes` (
  `idLigacoes` INT NOT NULL AUTO_INCREMENT,
  `tempoChamada` TIME NOT NULL,
  `problema` BOOLEAN NOT NULL DEFAULT FALSE,
  `valorInvalido` BOOLEAN NOT NULL DEFAULT FALSE,
  `visivel` BOOLEAN NOT NULL DEFAULT TRUE,
  `custoFinal` FLOAT NULL,
  `numFalso1` VARCHAR(45) NULL,
  `numFalso2` VARCHAR(45) NULL,
  `numEntrada` BIGINT NOT NULL,
  `numSaida` BIGINT NOT NULL,
   `inserido` Date NOT NULL,
  PRIMARY KEY (`idLigacoes`),
  CONSTRAINT `fk_Ligacoes_TELEFONES`
    FOREIGN KEY (`numEntrada`)
    REFERENCES `TELEFONIA`.`TELEFONES` (`numTelefones`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Ligacoes_TELEFONES1`
    FOREIGN KEY (`numSaida`)
    REFERENCES `TELEFONIA`.`TELEFONES` (`numTelefones`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

create table if not exists CLIENTES(
	idClientes int not null primary key auto_increment,
    nome varchar(75),
    email varchar(75),
    endereco varchar(275),
    dataNasc date,
    cpf varchar(45),
    situacao int not null,
    telefone bigint not null,
	inserido date not null,
    visivel boolean not null,
    foreign key(SITUACAO)
		references SITUACAO(idSituacao),
	foreign key(telefone)
		references TELEFONES(numTelefones)
);

/* CRIAÇÃO DAS LOGS */
DELIMITER $$

CREATE TRIGGER ADM
AFTER INSERT ON ADMINISTRADORES
FOR EACH ROW BEGIN
	DECLARE nome varchar(75);
    DECLARE id int;
	INSERT INTO LOGADM(descricao_log) VALUES(CONCAT('Novo Administrador: ', NEW.nome , '  id: ' , NEW.idAdministrador, 'desde: ', NEW.inserido));
END $$

DELIMITER ;

create table if not exists LOGADM(
	idLog int not null primary key auto_increment,
    descricao_log varchar(175),
    inserido timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

DELIMITER $$

CREATE TRIGGER USUARIOS
AFTER INSERT ON USUARIOS
FOR EACH ROW BEGIN
	INSERT INTO LOGUSU(descricao_log) VALUES(CONCAT('Novo usuario: ',NEW.nome , '  id: ' ,NEW.idUsuarios, ' setor: ',NEW.setor, ' desde: ',NEW.inserido));
END $$

DELIMITER ;

create table if not exists LOGUSU(
	idLog int not null primary key auto_increment,
    descricao_log varchar(175),
    inserido timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

DELIMITER $$

CREATE TRIGGER SETORES
AFTER INSERT ON SETORES
FOR EACH ROW BEGIN
	INSERT INTO LOGSET(descricao_log) VALUES(CONCAT('Novo setor: ',NEW.nomeSetor , '  id: ' ,NEW.idSetores, ' desde: ',NEW.inserido));
END $$

DELIMITER ;

create table if not exists LOGSET(
	idLog int not null primary key auto_increment,
    descricao_log varchar(175),
   inserido timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

DELIMITER $$

CREATE TRIGGER SITUACAO
AFTER INSERT ON SITUACAO
FOR EACH ROW BEGIN
	INSERT INTO LOGSIT(descricao_log) VALUES(CONCAT('Nova Situação: ',NEW.descricao , '  id: ' ,NEW.idSituacao));
END $$

DELIMITER ;

create table if not exists LOGSIT(
	idLog int not null primary key auto_increment,
    descricao_log varchar(175),
   inserido timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

DELIMITER $$

CREATE TRIGGER OPERADORAS
AFTER INSERT ON OPERADORAS
FOR EACH ROW BEGIN
	INSERT INTO LOGOPE(descricao_log) VALUES(CONCAT('Nova operadora: ',NEW.nomeOperadora , '  id: ' ,NEW.idOperadoras,' desde: ',NEW.inserida));
END $$

DELIMITER ;

create table if not exists LOGOPE(
	idLog int not null primary key auto_increment,
    descricao_log varchar(175),
   inserido timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

DELIMITER $$

CREATE TRIGGER TELEFONES
AFTER INSERT ON TELEFONES
FOR EACH ROW BEGIN
	INSERT INTO LOGTEL(descricao_log) VALUES(CONCAT('Nova telefone: ',NEW.numTelefones ,' desde: ',NEW.inserido));
END $$

DELIMITER ;

create table if not exists LOGTEL(
	idLog int not null primary key auto_increment,
    descricao_log varchar(175),
    inserido timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

DELIMITER $$

CREATE TRIGGER LIGACOES
AFTER INSERT ON LIGACOES
FOR EACH ROW BEGIN
	INSERT INTO LOGLIG(descricao_log) VALUES(CONCAT('Ligação: ',NEW.idLigacoes ,' desde: ',NEW.inserido));
END $$

DELIMITER ;

create table if not exists LOGLIG(
	idLog int not null primary key auto_increment,
    descricao_log varchar(175),
    inserido timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

DELIMITER $$

CREATE TRIGGER CLIENTES
AFTER INSERT ON CLIENTES
FOR EACH ROW BEGIN
	INSERT INTO LOGCLI(descricao_log) VALUES(CONCAT('nome: ',NEW.nome,' id: ', NEW.idClientes ,' em: ',NEW.inserido));
END $$

DELIMITER ;

create table if not exists LOGCLI(
	idLog int not null primary key auto_increment,
    descricao_log varchar(175),
    inserido timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

/* INSERTS NECESSÁRIOS PARA O INICIO */
insert into SETORES values(null,"Financeiro",CURDATE(),TRUE);
insert into SETORES values(null,"suporte",CURDATE(),TRUE);
insert into SETORES values(null,"vendas",CURDATE(),TRUE);
insert into SITUACAO values(null,"ativo",TRUE);
insert into SITUACAO values(null,"bloqueado",TRUE);
insert into SITUACAO values(null,"cancelado",TRUE);
insert into OPERADORAS values(null,"Indefinida",0.00,CURDATE(),FALSE);
insert into TELEFONES values(1,1,CURDATE(),TRUE);
insert into TELEFONES values(2,1,CURDATE(),TRUE);

#Como as logs estão incompletas não quis "adicionar ao front"