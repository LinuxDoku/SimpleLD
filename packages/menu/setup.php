; <?php die() ?>
[info]
name = "menu"
version = 0.1
[0.1]
db[] = "
    CREATE TABLE IF NOT EXISTS `1_menu` (
      `id` int(255) NOT NULL AUTO_INCREMENT,
      `sort` int(255) NOT NULL,
      `menu` varchar(255) CHARACTER SET utf8 NOT NULL,
      `name` varchar(255) CHARACTER SET utf8 NOT NULL,
      `link` varchar(255) CHARACTER SET utf8 NOT NULL,
      `alt` varchar(255) CHARACTER SET utf8 NOT NULL,
      `params` text CHARACTER SET utf8 NOT NULL,
      PRIMARY KEY (`id`)
    )"