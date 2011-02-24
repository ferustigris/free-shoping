CREATE TABLE `DB`.`PREFIXcategories` (
  `id` int  NOT NULL AUTO_INCREMENT,
  `id_parent` int  NOT NULL COMMENT 'parent category id',
  `s_category` text  NOT NULL COMMENT 'category title',
  `s_description` text  NOT NULL COMMENT 'category description',
  `s_small_img` text  NOT NULL COMMENT 'path to small img',
  `s_full_img` text  NOT NULL COMMENT 'path to full img',
  PRIMARY KEY (`id`)
)
ENGINE = MyISAM
COMMENT = 'categories list';

