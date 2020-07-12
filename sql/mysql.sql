#
# Structure de la table `module aleatoire`
#

CREATE TABLE aleatoire (
  photoid int(50) NOT NULL auto_increment,
  lien varchar(200) NOT NULL default '',
  nomlien varchar(150) NOT NULL default '',
  photo varchar(64) NOT NULL default '',
  KEY photoid (photoid)
) TYPE=MyISAM;
