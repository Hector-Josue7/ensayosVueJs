CREATE TABLE `ciudad` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `comuna_id` int(4) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ciudad__comuna` (`comuna_id`),
  CONSTRAINT `FK_ciudad__comuna` FOREIGN KEY (`comuna_id`) REFERENCES `comuna` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `ciudad` VALUES (1,1,'Primera Ciudad'),(2,2,'Primera Ciudad'),(3,2,'Segunda Ciudad'),(4,3,'Primera Ciudad'),(5,3,'Segunda Ciudad'),(6,3,'Tercera Ciudad');

CREATE TABLE `comuna` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `region_id` int(4) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_comuna__region` (`region_id`),
  CONSTRAINT `FK_comuna__region` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `comuna` VALUES (1,1,'Primera Comuna'),(2,1,'Segunda Comuna'),(3,2,'Primera Comuna'),(4,3,'Primera Comuna');

CREATE TABLE `region` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `region` VALUES (1,'Primera Region'),(2,'Segunda Region'),(3,'Tercera Region');