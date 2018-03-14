-- MySQL Script generated by MySQL Workbench
-- Wed Mar 14 13:58:30 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema tpvoyage
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema tpvoyage
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tpvoyage` DEFAULT CHARACTER SET utf8 ;
USE `tpvoyage` ;

-- -----------------------------------------------------
-- Table `tpvoyage`.`vol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tpvoyage`.`vol` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `villedepart` TEXT NULL,
  `villearrive` TEXT NULL,
  `datedepart` TIMESTAMP NULL,
  `datearrive` TIMESTAMP NULL,
  `prix` FLOAT NULL,
  `nbplace` INT NULL,
  `type` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tpvoyage`.`reservation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tpvoyage`.`reservation` (
  `id` INT NOT NULL,
  `nbplace` VARCHAR(45) NULL,
  `vol_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_reservation_vol_idx` (`vol_id` ASC),
  CONSTRAINT `fk_reservation_vol`
    FOREIGN KEY (`vol_id`)
    REFERENCES `tpvoyage`.`vol` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
