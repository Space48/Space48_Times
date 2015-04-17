CREATE TABLE `space48_times` (
  `times_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `open_time` varchar(255) NOT NULL,
  `close_time` varchar(255) NOT NULL,
  `open_message` varchar(255) NOT NULL,
  `show_open_number` tinyint(1) NOT NULL,
  `show_closed_number` tinyint(1) NOT NULL,
  `times_type` varchar(255) DEFAULT NULL,
  `close_message` varchar(255) DEFAULT NULL,
  `default_day` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`times_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1