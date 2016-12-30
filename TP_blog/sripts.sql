CREATE TABLE `billets` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `contenu` text,
  `date_creation` datetime DEFAULT NOW()
) ENGINE=InnoDB AUTO_INCREMENT DEFAULT CHARSET=latin1


CREATE TABLE `commentaires` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_billet` int(10) NOT NULL AUTO_INCREMENT,
  `auteur` varchar(255) NOT NULL,
  `commentaire` text,
  `date_commentaire` datetime DEFAULT NOW()
) ENGINE=InnoDB AUTO_INCREMENT DEFAULT CHARSET=latin1
