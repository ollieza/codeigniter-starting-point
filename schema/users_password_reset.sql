DROP TABLE IF EXISTS `users_password_reset`;
CREATE TABLE IF NOT EXISTS `users_password_reset` (
  `password_reset_code` varchar(80) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `password_reset_date` datetime NOT NULL,
  PRIMARY KEY  (`password_reset_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
