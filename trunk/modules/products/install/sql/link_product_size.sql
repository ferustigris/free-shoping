CREATE TABLE `DB`.`PREFIXlink_product_size` (
  `id` int  NOT NULL AUTO_INCREMENT,
  `id_product` int  NOT NULL COMMENT 'link to product',
  `id_size` int  NOT NULL COMMENT 'link to size',
  PRIMARY KEY (`id`)
)
ENGINE = MyISAM
COMMENT = 'link products and sizes';

