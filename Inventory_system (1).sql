-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema InventorySystem
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema InventorySystem
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `InventorySystem` DEFAULT CHARACTER SET utf8 ;
USE `InventorySystem` ;

-- -----------------------------------------------------
-- Table `InventorySystem`.`Tip_doc`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `InventorySystem`.`Tip_doc` (
  `idTip_doc` INT NOT NULL COMMENT 'sr(a) aqui se guardara el numero de identificacion',
  `descripcion` TEXT(12) NOT NULL COMMENT 'sr(a) en etes campo se guardara el tipo de identficacion ya se a cc,ce,ti,etc.',
  PRIMARY KEY (`idTip_doc`),
  UNIQUE INDEX `descripcion_UNIQUE` (`descripcion` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `InventorySystem`.`Rol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `InventorySystem`.`Rol` (
  `idRol` INT NOT NULL COMMENT 'se guardara la id del rol de la persona',
  `rol` TEXT(20) NOT NULL COMMENT 'aqui se guardara el rol de las personas y sea administrador o empleado',
  PRIMARY KEY (`idRol`),
  UNIQUE INDEX `rol_UNIQUE` (`rol` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `InventorySystem`.`Login_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `InventorySystem`.`Login_usuario` (
  `n° documento` INT NOT NULL COMMENT 'sr(a) en este campo se guardara el numero de identificcion de la persona',
  `Tip_doc_idTip_doc` INT NOT NULL COMMENT 'aqui se guardara la ide del tipo del documento',
  `contraseña` VARCHAR(45) NOT NULL COMMENT 'aqui se guardara la contraseña asignada',
  `Rol_idRol` INT NOT NULL COMMENT 'en este campo la persona seleccionara el rol a la que pertenece la persona',
  `1nombre` VARCHAR(45) NOT NULL COMMENT 'aqui se registrara el primer nombre de la persona',
  `2nombrel` VARCHAR(45) NOT NULL COMMENT 'aqui se guardara el segundo nombre de la persona',
  `1apellido` VARCHAR(45) NOT NULL COMMENT 'aqui se guardara el primer apellido de la persona',
  `2apellido` VARCHAR(45) NOT NULL COMMENT 'aqui se guardara el segundo apellido del la persona ',
  `edad` INT NOT NULL COMMENT 'aqui se guardara la edad de la persona',
  PRIMARY KEY (`n° documento`),
  INDEX `fk_Login_usuario_Tip_doc1_idx` (`Tip_doc_idTip_doc` ASC) VISIBLE,
  INDEX `fk_Login_usuario_Rol1_idx` (`Rol_idRol` ASC) VISIBLE,
  CONSTRAINT `fk_Login_usuario_Tip_doc1`
    FOREIGN KEY (`Tip_doc_idTip_doc`)
    REFERENCES `InventorySystem`.`Tip_doc` (`idTip_doc`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Login_usuario_Rol1`
    FOREIGN KEY (`Rol_idRol`)
    REFERENCES `InventorySystem`.`Rol` (`idRol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `InventorySystem`.`unidad_medida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `InventorySystem`.`unidad_medida` (
  `idunidad_medida` INT NOT NULL COMMENT 'se guarda la id del la unidad que se va utilizar',
  `medida` VARCHAR(45) NOT NULL COMMENT 'se digita la el tipo de cantidad que se ingresa (lt,un,ml,etc)',
  PRIMARY KEY (`idunidad_medida`),
  UNIQUE INDEX `medida_UNIQUE` (`medida` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `InventorySystem`.`tipo_producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `InventorySystem`.`tipo_producto` (
  `idtipo_producto` INT NOT NULL AUTO_INCREMENT COMMENT 'en este campo se guarda la id del tipo de producto',
  `descripcion` TEXT(20) NOT NULL COMMENT 'en este campo se guarda la descripcion del producto, sea hijiene,aseo,personal, etc.',
  PRIMARY KEY (`idtipo_producto`),
  UNIQUE INDEX `descripcion_UNIQUE` (`descripcion` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `InventorySystem`.`estado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `InventorySystem`.`estado` (
  `idestado` INT NOT NULL AUTO_INCREMENT COMMENT 'se guarda la id del estado el producto',
  `tipo_estado` TEXT(20) NOT NULL COMMENT 'se sellecciona si llego en buen o mal estado',
  PRIMARY KEY (`idestado`),
  UNIQUE INDEX `tipo_estado_UNIQUE` (`tipo_estado` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `InventorySystem`.`Provedor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `InventorySystem`.`Provedor` (
  `idprovedor` VARCHAR(20) NOT NULL COMMENT 'se guarda la id del provedor',
  `telefono` INT NOT NULL COMMENT 'se guarda el telefono del provedor',
  `nombre` INT NOT NULL COMMENT 'se guarda el nombre de la persona o el laboratorio(provedor)',
  `direccion` VARCHAR(45) NULL COMMENT 'se guarda la dirreccion del provedor',
  PRIMARY KEY (`idprovedor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `InventorySystem`.`salida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `InventorySystem`.`salida` (
  `idsalida` INT NOT NULL AUTO_INCREMENT COMMENT 'se guarda la id del la salidas',
  `nombre_clien` VARCHAR(45) NOT NULL COMMENT 'se guarda el nombre del cliente que compro el producto',
  `fecha y hora` VARCHAR(45) NOT NULL COMMENT 'se guardad la fecha y hora de salida del producto',
  `cantidad` VARCHAR(45) NOT NULL COMMENT 'se guarda la cantidad del producto ',
  PRIMARY KEY (`idsalida`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `InventorySystem`.`entradas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `InventorySystem`.`entradas` (
  `identradas` INT NOT NULL AUTO_INCREMENT COMMENT 'se guardara la ide de las entradas',
  `Nombre_produ` VARCHAR(45) NOT NULL COMMENT 'en este campo se guardara el nombre del producto',
  `cantidad` INT NOT NULL COMMENT 'en este campo se guardara la cantidad que llega del producto',
  `Stock` INT NOT NULL COMMENT 'aqui se guardara los productos que se guardaron y que hay en el almacen',
  `hora y fecha` DATETIME NOT NULL COMMENT 'en este campo se guardara la hora y la fecha de llegada del producto',
  `Login_usuario_n° documento` INT NOT NULL COMMENT 'en este campo se guardara el numero de documento que se registro ',
  `unidad_medida_id` VARCHAR(20) NOT NULL COMMENT 'en este campo se guarda la unidad de la cantidad que llego ya sea litos,unidad, etc.',
  `tipo_producto_idtipo_producto` TEXT(20) NOT NULL COMMENT 'en este campo se guarda el tipo de producto ya sea aseo, hjiene,persona,etc.',
  `estado_idestado` INT NOT NULL COMMENT 'en este campo se guardara el estado que llego el producto ya sea bueno o malo',
  `Provedor_telefono` VARCHAR(45) NOT NULL COMMENT 'en este campo se guarda el telefono del provedor',
  `salida_idsalida` INT NOT NULL COMMENT 'ene este campo se guarda la cantidad de productos que salieron',
  PRIMARY KEY (`identradas`),
  INDEX `fk_Productos_Tipo_producto1_idx` (`unidad_medida_id` ASC) VISIBLE,
  INDEX `fk_Productos_tipo_producto1_idx` (`tipo_producto_idtipo_producto` ASC) VISIBLE,
  INDEX `fk_Productos_Login_usuario1_idx` (`Login_usuario_n° documento` ASC) VISIBLE,
  INDEX `fk_Productos_estado1_idx` (`estado_idestado` ASC) VISIBLE,
  INDEX `fk_Productos_Provedor1_idx` (`Provedor_telefono` ASC) VISIBLE,
  INDEX `fk_entradas_salida1_idx` (`salida_idsalida` ASC) VISIBLE,
  CONSTRAINT `fk_Productos_Tipo_producto1`
    FOREIGN KEY (`unidad_medida_id`)
    REFERENCES `InventorySystem`.`unidad_medida` (`idunidad_medida`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Productos_tipo_producto1`
    FOREIGN KEY (`tipo_producto_idtipo_producto`)
    REFERENCES `InventorySystem`.`tipo_producto` (`idtipo_producto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Productos_Login_usuario1`
    FOREIGN KEY (`Login_usuario_n° documento`)
    REFERENCES `InventorySystem`.`Login_usuario` (`n° documento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Productos_estado1`
    FOREIGN KEY (`estado_idestado`)
    REFERENCES `InventorySystem`.`estado` (`idestado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Productos_Provedor1`
    FOREIGN KEY (`Provedor_telefono`)
    REFERENCES `InventorySystem`.`Provedor` (`telefono`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_entradas_salida1`
    FOREIGN KEY (`salida_idsalida`)
    REFERENCES `InventorySystem`.`salida` (`idsalida`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
