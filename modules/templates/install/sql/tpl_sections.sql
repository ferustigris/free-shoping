CREATE TABLE `DB`.`PREFIXtpl_sections` (
  `id` int  NOT NULL AUTO_INCREMENT,
  `id_tpl` int  NOT NULL COMMENT 'id template',
  `is_main` int  NOT NULL COMMENT 'are this section main frame?',
  `s_section` text  NOT NULL COMMENT 'section name',
  PRIMARY KEY (`id`)
)
ENGINE = MyISAM
COMMENT = 'sections';

