
CREATE TABLE IF NOT EXISTS `PREFIXmessages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) NOT NULL COMMENT 'parent id',
  `id_user` text NOT NULL COMMENT 'sender',
  `s_message` text NOT NULL COMMENT 'message',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='messages' AUTO_INCREMENT=2 ;
