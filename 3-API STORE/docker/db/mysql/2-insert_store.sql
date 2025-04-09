/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 8.0.17 : Database - wshop_shop
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

USE `wshop_api`;

/*Data for the table `store` */

insert  into `store`(`id`,`name`, `address`, `zipcode`, `city`)
values
       (1,'Auchan', '7-9 Bd des Batignolles', '75008', 'Paris'),
       (2,'Auchan', 'Rte de la Sablière', '13011', 'Marseille'),
       (3,'Auchan', '1 Pl. Antoinette Fouque', '69007', 'Lyon'),
       (4,'Auchan', '50-60 rue de la Pompe', '75016', 'Paris'),
       (5,'Leclerc', '191 Bd Macdonald', '75019', 'Paris'),
       (6,'Leclerc', '94 rue de Lannoy', '59800', 'Lille'),
       (7,'Carrefour', '1 Centre Commercial, CC Euralille', '59000', 'Lille'),
       (8,'Carrefour', '1 Avenue du Général Sarrail', '75016', 'Paris'),
       (9,'Carrefour', '11 Avenue St antoine', '13015', 'Marseille'),
       (10,'Carrefour', '112 Avenue de Hambourg', '13008', 'Marseille');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;