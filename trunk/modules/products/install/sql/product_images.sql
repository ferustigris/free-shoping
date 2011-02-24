CREATE TABLE `DB`.`PREFIXproduct_images` (
  `id` int  NOT NULL AUTO_INCREMENT,
  `id_product` int  NOT NULL COMMENT 'link to product',
  `s_full_img` text  NOT NULL COMMENT 'full image',
  `s_small_img` text  NOT NULL COMMENT 'small image',
  PRIMARY KEY (`id`)
)
ENGINE = MyISAM
COMMENT = 'images of products';

