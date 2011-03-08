CREATE TABLE `DB`.`PREFIXproduct_materials` (
  `id` int  NOT NULL AUTO_INCREMENT,
  `s_material` text  NOT NULL COMMENT 'material name',
  `s_description` text  NOT NULL COMMENT 'description',
  PRIMARY KEY (`id`)
)
ENGINE = MyISAM
 DEFAULT CHARSET=utf8
COMMENT = 'materials list';

