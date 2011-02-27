DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `country_iso` char(2) NOT NULL,
  `country_name` varchar(80) NOT NULL,
  `country_printable_name` varchar(80) NOT NULL,
  `country_iso3` char(3) default NULL,
  `country_numcode` smallint(6) default NULL,
  PRIMARY KEY  (`country_iso`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
