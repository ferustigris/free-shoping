CREATE TABLE `DB`.`PREFIXuser_options` (
  `id` int  NOT NULL AUTO_INCREMENT,
  `i_link` int  NOT NULL COMMENT 'user id',
  `s_field` text NOT NULL COMMENT 'field',
  `s_value` text NOT NULL COMMENT 'value',
  PRIMARY KEY (`id`)
)
ENGINE = MyISAM
DEFAULT CHARSET=utf8
COMMENT = 'additional options of users';

