CREATE TABLE `commentss` IF NOT EXISTS (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `publication_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS;
CREATE TABLE `membres` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `login`
  `mdp`
  `email`
  `inscription`
  PRIMARY KEY(`id`)
)ENGINE=InnoDB AUTO_INCREMENT DEFAULT CHARSET=latin1;
