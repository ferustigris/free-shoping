CREATE TABLE `DB`.`PREFIXmodule_actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_module` int(11) NOT NULL COMMENT 'module id',
  `i_min_priority` int(11) NOT NULL COMMENT 'min user priority, who can view it',
  `i_max_priority` int(11) NOT NULL COMMENT 'max user priority, who can view it',
  `s_action` text NOT NULL COMMENT 'page name',
  `s_description` text NOT NULL COMMENT 'description',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='list pages, access for it'
