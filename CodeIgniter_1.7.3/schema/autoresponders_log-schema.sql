DROP TABLE IF EXISTS `autoresponder_log`;
CREATE TABLE IF NOT EXISTS `autoresponder_log` (
  `autoresponder_log_id` int(16) NOT NULL auto_increment,
  `autoresponder_id` int(11) NOT NULL,
  `autoresponder_log_to_name` varchar(255) default NULL,
  `autoresponder_log_to_email` varchar(255) default NULL,
  `autoresponder_log_from_email` varchar(250) NOT NULL,
  `autoresponder_log_from_name` varchar(100) NOT NULL,
  `autoresponder_log_subject` varchar(500) NOT NULL,
  `autoresponder_log_message` text NOT NULL,
  `autoresponder_log_substitution_array` varchar(1000) NOT NULL,
  `autoresponder_log_attachments_array` varchar(1000) NOT NULL,
  `autoresponder_log_bcc_notify` int(11) default NULL,
  `autoresponder_log_email_sent` int(1) default NULL,
  `autoresponder_log_created` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`autoresponder_log_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;