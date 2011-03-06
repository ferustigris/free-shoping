CREATE TABLE `DB`.`PREFIXproducts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) NOT NULL COMMENT 'category',
  `id_product` int(11) NOT NULL COMMENT 'parent product',
  `id_material` int(11) NOT NULL DEFAULT '-1' COMMENT 'material',
  `id_producer` int(11) NOT NULL DEFAULT '-1' COMMENT 'producer',
  `i_price` int(11) NOT NULL DEFAULT '0' COMMENT 'product price',
  `s_product` text NOT NULL COMMENT 'name of product',
  `s_article` text NOT NULL COMMENT 'article of product',
  `s_description` text NOT NULL COMMENT 'description',
  PRIMARY KEY (`id`)
  ) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='products list'
