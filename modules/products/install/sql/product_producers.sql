CREATE TABLE `DB`.`PREFIXproduct_producers` (
  `id` int  NOT NULL AUTO_INCREMENT,
  `s_producer` text  NOT NULL COMMENT 'company',
  `s_description` text  NOT NULL COMMENT 'description',
  `s_url` text  NOT NULL COMMENT 'link to producer',
  PRIMARY KEY (`id`)
)
ENGINE = MyISAM
 DEFAULT CHARSET=utf8
COMMENT = 'product producers';

