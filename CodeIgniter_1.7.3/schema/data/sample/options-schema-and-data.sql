DROP TABLE IF EXISTS `options`;
CREATE TABLE IF NOT EXISTS `options` (
  `option_id` int(40) NOT NULL auto_increment,
  `option_name` varchar(1000) NOT NULL,
  `option_value` varchar(1000) NOT NULL,
  PRIMARY KEY  (`option_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`option_id`, `option_name`, `option_value`) VALUES
(1, 'vat_rate', '17.50');
