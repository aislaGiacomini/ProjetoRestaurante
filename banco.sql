-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema restaurante
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema restaurante
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `restaurante` DEFAULT CHARACTER SET utf8mb4 ;
USE `restaurante` ;

-- -----------------------------------------------------
-- Table `restaurante`.`clientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurante`.`clientes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `telefone` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `restaurante`.`mesas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurante`.`mesas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `numero` INT(11) NOT NULL,
  `capacidade` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `restaurante`.`pedidos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurante`.`pedidos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` INT(11) NULL DEFAULT NULL,
  `id_mesa` INT(11) NULL DEFAULT NULL,
  `data` DATE NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `id_cliente` (`id_cliente` ASC),
  INDEX `id_mesa` (`id_mesa` ASC),
  CONSTRAINT `pedidos_ibfk_1`
    FOREIGN KEY (`id_cliente`)
    REFERENCES `restaurante`.`clientes` (`id`),
  CONSTRAINT `pedidos_ibfk_2`
    FOREIGN KEY (`id_mesa`)
    REFERENCES `restaurante`.`mesas` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `restaurante`.`pratos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurante`.`pratos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `preco` DECIMAL(10,2) NOT NULL,
  `descricao` TEXT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `restaurante`.`pedido_itens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurante`.`pedido_itens` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` INT(11) NULL DEFAULT NULL,
  `id_prato` INT(11) NULL DEFAULT NULL,
  `quantidade` INT(11) NOT NULL,
  `preco` DECIMAL NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `id_pedido` (`id_pedido` ASC),
  INDEX `id_prato` (`id_prato` ASC),
  CONSTRAINT `pedido_itens_ibfk_1`
    FOREIGN KEY (`id_pedido`)
    REFERENCES `restaurante`.`pedidos` (`id`),
  CONSTRAINT `pedido_itens_ibfk_2`
    FOREIGN KEY (`id_prato`)
    REFERENCES `restaurante`.`pratos` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `restaurante`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurante`.`usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` TEXT NOT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
