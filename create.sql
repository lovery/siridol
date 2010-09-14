drop table if exists `boqna`;
CREATE TABLE `boqna` (
      `Month` date DEFAULT NULL,
      `Date` date DEFAULT NULL,
      `Rubbish` float(10,2) DEFAULT NULL,
      `Greenarea` float(10,2) DEFAULT NULL,
      `homemanager` float(10,2) DEFAULT NULL,
      `cleanstreets` float(10,2) DEFAULT NULL,
      `fund` float(10,2) DEFAULT NULL,
      `explanation` varchar(150) DEFAULT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8;
