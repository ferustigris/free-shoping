CREATE TABLE `DB`.`PREFIXtpl_show_pages` (
  `id` int  NOT NULL AUTO_INCREMENT,
  `id_page` int  NOT NULL COMMENT 'page id',
  `id_section` int  NOT NULL COMMENT 'section id',
  `i_sort` int  NOT NULL COMMENT 'index for sort',
  PRIMARY KEY (`id`)
)
ENGINE = MyISAM
DEFAULT CHARSET=utf8
COMMENT = 'show pages';

