DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) unsigned NOT NULL auto_increment,
  `user_username` varchar(50) NOT NULL,
  `user_email` varchar(255) NOT NULL default '',
  `user_pass` varchar(60) NOT NULL default '',
  `user_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `user_modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `user_last_login` datetime default NULL,
  `user_role` varchar(20) NOT NULL default 'fan',
  `user_first_name` varchar(200) NOT NULL,
  `user_surname` varchar(200) NOT NULL,
  `user_telephone` varchar(20) NOT NULL,
  `user_address_line1` varchar(100) NOT NULL,
  `user_address_line2` varchar(100) default NULL,
  `user_towncity` varchar(40) NOT NULL,
  `user_county` varchar(200) NOT NULL,
  `user_country` varchar(200) NOT NULL,
  `user_postzip_code` varchar(10) NOT NULL,
  `user_billing_address_different` smallint(1) NOT NULL,
  `user_billing_address_line1` varchar(100) NOT NULL,
  `user_billing_address_line2` varchar(100) default NULL,
  `user_billing_towncity` varchar(40) NOT NULL,
  `user_billing_county` varchar(200) NOT NULL,
  `user_billing_country` varchar(200) NOT NULL,
  `user_billing_postzip_code` varchar(10) NOT NULL,
  `activated` int(1) NOT NULL default '1',
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_username`, `user_email`, `user_pass`, `user_date`, `user_modified`, `user_last_login`, `user_role`, `user_first_name`, `user_surname`, `user_telephone`, `user_address_line1`, `user_address_line2`, `user_towncity`, `user_county`, `user_country`, `user_postzip_code`, `user_billing_address_different`, `user_billing_address_line1`, `user_billing_address_line2`, `user_billing_towncity`, `user_billing_county`, `user_billing_country`, `user_billing_postzip_code`, `activated`) VALUES
(1, 'admin', 'joe@blogs.com', '$P$BM2i8Y5e3lddJWPAd3Oxk.QJJTUgj7.', '2010-02-24 14:11:35', '2010-02-24 14:11:35', '2010-10-21 15:36:52', 'admin', 'Ollie', 'Rattue', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', 1);
