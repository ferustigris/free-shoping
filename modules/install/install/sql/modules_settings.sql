CREATE TABLE `DB`.`PREFIXmodule_settings` (
  `id` int  NOT NULL AUTO_INCREMENT,
  `i_link` int  NOT NULL COMMENT 'module id',
  `s_field` text  NOT NULL COMMENT 'field',
  `s_value` text  NOT NULL COMMENT 'value',
  PRIMARY KEY (`id`)
)
ENGINE = MyISAM
 DEFAULT CHARSET=utf8
COMMENT = 'settings of modules';

