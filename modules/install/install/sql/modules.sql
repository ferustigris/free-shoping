CREATE TABLE `DB`.`PREFIXmodules` (
  `id` int  NOT NULL AUTO_INCREMENT,
  `is_active` int  NOT NULL COMMENT 'is module active?',
  `s_name` text  NOT NULL COMMENT 'module name, directory',
  PRIMARY KEY (`id`)
)
ENGINE = MyISAM
COMMENT = 'Modules list';

