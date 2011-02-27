DROP TABLE IF EXISTS `accountancy`;
CREATE TABLE `accountancy` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`month` DATE NOT NULL,
	`on_date` DATE NOT NULL,
	`rubbish` FLOAT(10,2) NOT NULL,
	`greenarea` FLOAT(10,2) NOT NULL,
	`homemanager` FLOAT(10,2) NOT NULL,
	`cleanstreets` FLOAT(10,2) NOT NULL,
	`fund` FLOAT(10,2) NOT NULL,
	`explanation` VARCHAR(150) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

ALTER TABLE `accountancy` ADD `id_house` INT(5);

DROP TABLE IF EXISTS `Id_house`;
CREATE TABLE `Id_house` (
	`ID` INT (5) NOT NULL,
	`month` DATE NOT NULL,
	`explanation` VARCHAR(150) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8;
