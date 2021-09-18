-- Rutina para Crear Modelo de Datos ---

-- Administracion del sistema --
DROP TABLE IF EXISTS `logtx`;
DROP TABLE IF EXISTS `usuario`;
DROP TABLE IF EXISTS `modulo`;
DROP TABLE IF EXISTS `empleado`;
DROP TABLE IF EXISTS `pais`;
DROP TABLE IF EXISTS `tipo_identificacion`;
DROP TABLE IF EXISTS `area`;
DROP VIEW `empleado_det`;

CREATE TABLE `usuario` (
   `id` INT NOT NULL AUTO_INCREMENT,
   `email` VARCHAR(200),
   `nombre` VARCHAR(100), 
   `apellido` CHAR(100), 
   `password` CHAR(50),
   `estado` BOOLEAN NOT NULL,
   PRIMARY KEY (`id`),
   UNIQUE INDEX (`email`));


CREATE TABLE `modulo` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `descripcion` VARCHAR(32) NOT NULL,
    `estado` BOOLEAN NOT NULL,
    PRIMARY KEY (`id`));   


CREATE TABLE `logtx` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `id_usuario` INT NOT NULL,
    `id_modulo` INT NOT NULL,
    `fecha_trax` datetime NOT NULL,
    `mvto` VARCHAR(300),
    PRIMARY KEY (ID));

ALTER TABLE `logtx` ADD CONSTRAINT FOREIGN KEY (`id_usuario`) REFERENCES `usuario`(`id`);
ALTER TABLE `logtx` ADD CONSTRAINT FOREIGN KEY (`id_modulo`) REFERENCES `modulo`(`id`);

-- Maestros ---

CREATE TABLE `pais` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `pais` VARCHAR(30) NOT NULL,
    `dominio` VARCHAR(30) NOT NULL,
    PRIMARY KEY (`id`));

CREATE TABLE `tipo_identificacion` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `tipo_identificacion` VARCHAR(20) NOT NULL,
    PRIMARY KEY (`id`));

CREATE TABLE `area` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `area` VARCHAR(30) NOT NULL,
    PRIMARY KEY (`id`));

CREATE TABLE `empleado`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `primer_apellido` VARCHAR(20) NOT NULL,
    `segundo_apellido` VARCHAR(20) NULL,
    `primer_nombre` VARCHAR(20) NOT NULL,
    `segundo_nombre` VARCHAR(50) NULL,
    `id_pais` INT NOT NULL,
    `tipo_identificacion` INT NOT NULL,
    `numero_identificacion` VARCHAR(20) NOT NULL,
    `email` VARCHAR(300) NOT NULL,
    `estado` BOOLEAN NOT NULL,
    `fecha_registro` datetime NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX (`numero_identificacion`),
    UNIQUE INDEX (`email`));

ALTER TABLE `empleado` ADD CONSTRAINT FOREIGN KEY (`id_pais`) REFERENCES `pais`(`id`);
ALTER TABLE `empleado` ADD CONSTRAINT FOREIGN KEY (`tipo_identificacion`) REFERENCES `tipo_identificacion`(`id`);


CREATE VIEW empleado_det AS
Select E.primer_apellido
, E.segundo_apellido
, E.primer_nombre
, E.segundo_nombre
, E.id_pais
, P.pais
, E.tipo_identificacion as id_identificacion
, TI.tipo_identificacion
, E.numero_identificacion
, E.email
, E.estado
, DATE_FORMAT(E.fecha_registro,"%Y-%m-%d")
, E.id
From empleado E inner join pais P On E.id_pais = P.id
Inner Join tipo_identificacion TI On E.tipo_identificacion = TI.id