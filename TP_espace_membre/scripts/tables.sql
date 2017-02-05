CREATE TABLE `commentss` IF NOT EXISTS (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `publication_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `membres`;
CREATE TABLE `membres` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `inscription` datetime NOT NULL,
  PRIMARY KEY(`id`)
)ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

-- insertion du compte test
INSERT INTO `membres` (login, mdp, email, inscription) VALUES('test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'test@test.com', now());
