CREATE TABLE `DB`.`PREFIXorder_states` (
  `id` int  NOT NULL AUTO_INCREMENT,
  `i_code` int  NOT NULL COMMENT 'state code',
  `s_name` text  CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Mnemonic name',
  PRIMARY KEY (`id`)
)
ENGINE = MyISAM
COMMENT = 'states of order';
