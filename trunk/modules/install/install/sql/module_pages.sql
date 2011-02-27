CREATE TABLE `DB`.`PREFIXmodule_pages` (
  `id` int  NOT NULL AUTO_INCREMENT,
  `id_module` int  NOT NULL COMMENT 'module id',
  `i_min_priority` int  NOT NULL COMMENT 'min user priority, who can view it',
  `i_max_priority` int  NOT NULL COMMENT 'max user priority, who can view it',
  `i_menu` tinyint(1) NOT NULL COMMENT 'are avaible by menu?',
  `s_page` text  NOT NULL COMMENT 'page name',
  `s_description` text  NOT NULL COMMENT 'description',
  PRIMARY KEY (`id`)
)
ENGINE = MyISAM
COMMENT = 'list pages, access for it';

