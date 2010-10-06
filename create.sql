DROP TABLE IF EXISTS `boqna`;
CREATE TABLE `boqna` (
	`month` DATE NOT NULL,
	`date` DATE NOT NULL,
	`rubbish` FLOAT(10,2) NOT NULL,
	`greenarea` FLOAT(10,2) NOT NULL,
	`homemanager` FLOAT(10,2) NOT NULL,
	`cleanstreets` FLOAT(10,2) NOT NULL,
	`fund` FLOAT(10,2) NOT NULL,
	`explanation` VARCHAR(150) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8;
