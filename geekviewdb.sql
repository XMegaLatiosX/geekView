create database GeekViewdb;

use GeekViewdb;

CREATE TABLE `geekviewdb`.`usuario` (
  `usuario_id` INT NOT NULL AUTO_INCREMENT,
  `usuario_nome` VARCHAR(50) NOT NULL,
  `usuario_email` VARCHAR(75) NOT NULL,
  `usuario_senha` VARCHAR(30) NOT NULL,
  `usuario_nick` VARCHAR(30) NOT NULL,
  `usuario_data_de_entrada` DATE NOT NULL,
  `usuario_icone` VARCHAR(400) NOT NULL,
  `usuario_rank` VARCHAR(50) NOT NULL,
  `usuario_status` BIT(2) NOT NULL,
  PRIMARY KEY (`usuario_id`));