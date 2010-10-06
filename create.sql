drop table if exists `boqna`;
CREATE TABLE `boqna` (
	`Month` date NOT NULL,
	`Date` date NOT NULL,
	`Rubbish` float(10,2) NOT NULL,
	`Greenarea` float(10,2) NOT NULL,
	`homemanager` float(10,2) NOT NULL,
	`cleanstreets` float(10,2) NOT NULL,
	`fund` float(10,2) NOT NULL,
	`explanation` varchar(150) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8;
