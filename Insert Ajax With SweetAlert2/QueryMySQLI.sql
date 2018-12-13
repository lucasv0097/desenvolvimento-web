CREATE DATABASE `meubanco`;

CREATE TABLE  `meubanco`.`USUARIO` (
  `ID_USUARIO` int(10) unsigned NOT NULL auto_increment,
  `NOME` varchar(200) NOT NULL default '',
  `EMAIL` varchar(200) NOT NULL default '',
  `SENHA` varchar(45) NOT NULL default '',
  PRIMARY KEY  (`ID_USUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


select * from USUARIO;


delete from USUARIO
where ID_USUARIO>'3';

INSERT INTO usuario (NOME, EMAIL, SENHA) 
VALUES ('Lucas Vieira Silva', 'lucas_vieira@hotmail.com', 'nopass');

ALTER TABLE USUARIO AUTO_INCREMENT = 3;