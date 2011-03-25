
CREATE TABLE IF NOT EXISTS `PREFIXfaq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_question` text NOT NULL COMMENT 'message',
  `s_answer` text NOT NULL COMMENT 'message',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='messages' AUTO_INCREMENT=2 ;
