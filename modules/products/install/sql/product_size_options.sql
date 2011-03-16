CREATE TABLE `DB`.`PREFIXproduct_producer_options` (
  `id` int  NOT NULL AUTO_INCREMENT,
  `i_link` int  NOT NULL COMMENT 'user id',
  `s_field` char(60) NOT NULL COMMENT 'field',
  `s_value` text NOT NULL COMMENT 'value',
  PRIMARY KEY (`id`)
)
ENGINE = MyISAM
DEFAULT CHARSET=utf8
COMMENT = 'additional options of products';

