-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema chatpublicodb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema chatpublicodb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `chatpublicodb` DEFAULT CHARACTER SET latin1 ;
USE `chatpublicodb` ;

-- -----------------------------------------------------
-- Table `chatpublicodb`.`tipo_post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chatpublicodb`.`tipo_post` (
  `idtipo_post` INT(11) NOT NULL AUTO_INCREMENT,
  `detalle_tipo` VARCHAR(45) NULL DEFAULT NULL,
  `created_at` DATETIME NULL DEFAULT NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`idtipo_post`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `chatpublicodb`.`post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chatpublicodb`.`post` (
  `idpost` INT(11) NOT NULL AUTO_INCREMENT,
  `texto` VARCHAR(200) NULL DEFAULT NULL,
  `fecha_post` DATETIME NULL DEFAULT NULL,
  `usuario_idusuario` INT(11) NOT NULL,
  `created_at` DATETIME NULL DEFAULT NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`idpost`),
  INDEX `fk_post_usuario1_idx` (`usuario_idusuario` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `chatpublicodb`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chatpublicodb`.`usuario` (
  `idusuario` INT(11) NOT NULL AUTO_INCREMENT,
  `nick_usuario` VARCHAR(45) NULL DEFAULT NULL,
  `fecha_creacion` DATETIME NULL DEFAULT NULL,
  `nombre_usuario` VARCHAR(200) NULL DEFAULT NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  `created_at` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`idusuario`))
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `chatpublicodb`.`comentario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chatpublicodb`.`comentario` (
  `idcomentario` INT(11) NOT NULL AUTO_INCREMENT,
  `comentario_text` VARCHAR(250) NULL DEFAULT NULL,
  `extension_archivo` VARCHAR(45) NULL DEFAULT NULL,
  `ruta_archivo` VARCHAR(250) NULL DEFAULT NULL,
  `post_idpost` INT(11) NOT NULL,
  `usuario_idusuario` INT(11) NOT NULL,
  `fecha_comentario` DATETIME NULL DEFAULT NULL,
  `key_redis_comentario` VARCHAR(250) NULL DEFAULT NULL,
  `created_at` DATETIME NULL DEFAULT NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  `tipo_id_post` INT(11) NOT NULL,
  PRIMARY KEY (`idcomentario`),
  INDEX `fk_comentario_post_idx` (`post_idpost` ASC),
  INDEX `fk_comentario_usuario1_idx` (`usuario_idusuario` ASC),
  INDEX `index4` (`tipo_id_post` ASC),
  CONSTRAINT `fk_comentario_1`
    FOREIGN KEY (`tipo_id_post`)
    REFERENCES `chatpublicodb`.`tipo_post` (`idtipo_post`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comentario_post`
    FOREIGN KEY (`post_idpost`)
    REFERENCES `chatpublicodb`.`post` (`idpost`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comentario_usuario1`
    FOREIGN KEY (`usuario_idusuario`)
    REFERENCES `chatpublicodb`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
