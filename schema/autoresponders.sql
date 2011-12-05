DROP TABLE IF EXISTS `autoresponders`;
CREATE TABLE IF NOT EXISTS `autoresponders` (
  `autoresponder_id` int(11) NOT NULL auto_increment,
  `autoresponder_name` varchar(20) default NULL,
  `autoresponder_subject` varchar(200) default NULL,
  `autoresponder_message` text,
  `autoresponder_modified` timestamp NOT NULL default '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`autoresponder_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;