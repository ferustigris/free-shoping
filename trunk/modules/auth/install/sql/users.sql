CREATE TABLE `DB`.`PREFIXusers` (
  `id` int  NOT NULL AUTO_INCREMENT,
  `s_name` char(30) NOT NULL COMMENT 'login',
  `s_passwd` char(60) NOT NULL COMMENT 'password',
  `i_priority` int  NOT NULL COMMENT 'priority user',
  PRIMARY KEY (`id`)
)
ENGINE = MyISAM
DEFAULT CHARSET=utf8
COMMENT = 'users';

