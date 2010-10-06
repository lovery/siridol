DROP TABLE IF EXISTS `accountancy`;
CREATE TABLE `accountancy` (
	`month` DATE NOT NULL,
	`on_date` DATE NOT NULL,
	`rubbish` FLOAT(10,2) NOT NULL,
	`greenarea` FLOAT(10,2) NOT NULL,
	`homemanager` FLOAT(10,2) NOT NULL,
	`cleanstreets` FLOAT(10,2) NOT NULL,
	`fund` FLOAT(10,2) NOT NULL,
	`explanation` VARCHAR(150) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8;
