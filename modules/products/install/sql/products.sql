CREATE TABLE `DB`.`PREFIXproducts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) NOT NULL COMMENT 'category',
  `id_product` int(11) NOT NULL COMMENT 'parent product',
  `id_material` int(11) NOT NULL DEFAULT '-1' COMMENT 'material',
  `id_producer` int(11) NOT NULL DEFAULT '-1' COMMENT 'producer',
  `i_price` int(11) NOT NULL DEFAULT '0' COMMENT 'product price',
  PRIMARY KEY (`id`)
  ) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='products list'
