CREATE TABLE `DB`.`PREFIXcategories` (
  `id` int  NOT NULL AUTO_INCREMENT,
  `id_parent` int  NOT NULL COMMENT 'parent category id',
  PRIMARY KEY (`id`)
)
ENGINE = MyISAM
DEFAULT CHARSET=utf8
COMMENT = 'categories list';

