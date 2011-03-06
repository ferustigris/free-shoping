CREATE TABLE `DB`.`PREFIXorders` (
  `id` int  NOT NULL AUTO_INCREMENT,
  `id_user` int  NOT NULL COMMENT 'user id',
  `id_product` int  NOT NULL COMMENT 'product',
  `id_state` int  NOT NULL COMMENT 'order state',
  `i_date` int  NOT NULL COMMENT 'date',
  PRIMARY KEY (`id`)
)
ENGINE = MyISAM
COMMENT = 'orders';

