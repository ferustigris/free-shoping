CREATE TABLE `DB`.`PREFIXusers` (
  `id` int  NOT NULL AUTO_INCREMENT,
  `s_name` text  NOT NULL COMMENT 'login',
  `s_passwd` text  NOT NULL COMMENT 'password',
  `i_priority` int  NOT NULL COMMENT 'priority user',
  PRIMARY KEY (`id`)
)
ENGINE = MyISAM
COMMENT = 'users';

