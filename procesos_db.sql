/*
SQLyog Community v12.3.0 (64 bit)
MySQL - 10.1.34-MariaDB : Database - procesos_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`procesos_db` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `procesos_db`;

/*Table structure for table `cat_sede` */

DROP TABLE IF EXISTS `cat_sede`;

CREATE TABLE `cat_sede` (
  `id_sede` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`id_sede`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `cat_sede` */

insert  into `cat_sede`(`id_sede`,`descripcion`) values 
(0,'Ninguna'),
(1,'Bogotá'),
(2,'México'),
(3,'Perú');

/*Table structure for table `tbl_proceso` */

DROP TABLE IF EXISTS `tbl_proceso`;

CREATE TABLE `tbl_proceso` (
  `id_numero_proceso` varchar(8) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_sede` int(8) DEFAULT NULL,
  `presupuesto` decimal(12,2) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_numero_proceso`),
  KEY `fk_tbl_usuario` (`id_usuario`),
  KEY `fk_cat_sede` (`id_sede`),
  CONSTRAINT `fk_cat_sede` FOREIGN KEY (`id_sede`) REFERENCES `cat_sede` (`id_sede`),
  CONSTRAINT `fk_tbl_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_proceso` */

/*Table structure for table `tbl_usuario` */

DROP TABLE IF EXISTS `tbl_usuario`;

CREATE TABLE `tbl_usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(45) NOT NULL,
  `nombres` varchar(55) NOT NULL,
  `apellidos` varchar(55) NOT NULL,
  `contrasena` varchar(40) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_usuario` */

/* Procedure structure for procedure `sp_create_tbl_proceso` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_create_tbl_proceso` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_create_tbl_proceso`(sp_descripcion varchar(200),sp_id_sede int, sp_presupuesto numeric(12,2), sp_id_usuario int)
BEGIN
Declare codido varchar(8);
set @codigo='';
SELECT DATE_FORMAT(CURRENT_TIMESTAMP, "%d%k%i%S") into @codigo;

INSERT INTO `procesos_db`.`tbl_proceso`(`id_numero_proceso`,
`descripcion`,
`id_sede`,
`presupuesto`,
`id_usuario`)
VALUES
(@codigo,
sp_descripcion,
sp_id_sede,
sp_presupuesto,
sp_id_usuario);
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_create_tbl_usuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_create_tbl_usuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_create_tbl_usuario`(sp_usuario varchar(45), sp_nombres varchar(55), sp_apellidos varchar(55), sp_contrasena varchar(40))
BEGIN
  declare cantidad int;
  Select count(*) as cuenta from tbl_usuario where sp_usuario=usuario into cantidad;
  
  if cantidad>0 then
	select 99 as respuesta;
  else 
   insert INTO `procesos_db`.`tbl_usuario`
	(
	`usuario`,
	`nombres`,
	`apellidos`,
	`contrasena`)
	VALUES
	(
     sp_usuario, 
     sp_nombres, 
     sp_apellidos, 
     sp_contrasena);
     select 200 as respuesta;
  End if;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_delete_tbl_proceso` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_delete_tbl_proceso` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_delete_tbl_proceso`(sp_id_numero_proceso varchar(8))
BEGIN
	delete from tbl_proceso where sp_id_numero_proceso=id_numero_proceso;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_login_tbl_usuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_login_tbl_usuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_login_tbl_usuario`(sp_usuario varchar(45), sp_contrasena varchar(40))
BEGIN
	Select id_usuario,usuario,nombres,apellidos from tbl_usuario where sp_usuario=usuario and sp_contrasena=contrasena;
  
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_select_cat_sede` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_select_cat_sede` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_select_cat_sede`()
BEGIN
	select * from cat_sede;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_select_tbl_proceso` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_select_tbl_proceso` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_select_tbl_proceso`(sp_fecha_proceso_desde varchar(19),sp_fecha_proceso_hasta varchar(19),sp_id varchar(8))
BEGIN
	if (sp_fecha_proceso_desde='' or sp_fecha_proceso_hasta='') and sp_id=0 then
		select a.id_numero_proceso, a.descripcion as desc_proceso, a.fecha_creacion, a.presupuesto, b.descripcion as desc_sede, c.usuario from
        tbl_proceso as a, cat_sede as b, tbl_usuario as c where a.id_sede=b.id_sede and a.id_usuario=c.id_usuario
        order by a.fecha_creacion desc;
	elseif sp_id<>0 then
		select * from tbl_proceso where id_numero_proceso=sp_id;
	else
		set sp_fecha_proceso_desde = CONCAT(sp_fecha_proceso_desde,' 00:00:00');
        set sp_fecha_proceso_hasta = CONCAT(sp_fecha_proceso_hasta,' 23:59:59');
        
		select a.id_numero_proceso, a.descripcion as desc_proceso, a.fecha_creacion, a.presupuesto, b.descripcion as desc_sede, c.usuario from
        tbl_proceso as a, cat_sede as b, tbl_usuario as c where a.id_sede=b.id_sede and a.id_usuario=c.id_usuario
        and (a.fecha_creacion between sp_fecha_proceso_desde and sp_fecha_proceso_hasta)
        order by a.fecha_creacion desc;
    end if;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_update_tbl_proceso` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_update_tbl_proceso` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_update_tbl_proceso`(sp_descripcion varchar(200),sp_id_sede int, sp_presupuesto numeric(12,2), sp_id_numero_proceso varchar(8),sp_id_usuario int)
BEGIN
UPDATE `procesos_db`.`tbl_proceso`
SET
`descripcion` = sp_descripcion,
`id_sede` = sp_id_sede,
`presupuesto` = sp_presupuesto,
`id_usuario` = sp_id_usuario
WHERE `id_numero_proceso` = sp_id_numero_proceso;
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
