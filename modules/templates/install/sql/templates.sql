CREATE TABLE `DB`.`PREFIXtemplates` (
  `id` int  NOT NULL AUTO_INCREMENT,
  `s_name` text  NOT NULL COMMENT 'template name',
  `s_description` text  NOT NULL COMMENT 'description',
  PRIMARY KEY (`id`)
)
ENGINE = MyISAM
 DEFAULT CHARSET=utf8
COMMENT = 'templates list';

