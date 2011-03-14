CREATE TABLE `DB`.`PREFIXcategory_options` (
  `id` int  NOT NULL AUTO_INCREMENT,
  `i_link` int  NOT NULL COMMENT 'cat id',
  `s_field` char(20) NOT NULL COMMENT 'field',
  `s_value` text NOT NULL COMMENT 'value',
  PRIMARY KEY (`id`)
)
ENGINE = MyISAM
DEFAULT CHARSET=utf8
COMMENT = 'additional options of categories';

