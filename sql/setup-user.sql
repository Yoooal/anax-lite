-- USE oophp;

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users`
(
  `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `username` VARCHAR(100) NOT NULL,
  `password` VARCHAR(100),
  `userLevel` INT
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;
