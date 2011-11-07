DROP TABLE IF EXISTS `us_states`;
CREATE TABLE IF NOT EXISTS `us_states` (
  `us_state_code` char(2) NOT NULL,
  `us_state_name` varchar(250) NOT NULL,
  PRIMARY KEY  (`us_state_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
