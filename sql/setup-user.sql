CREATE DATABASE IF NOT EXISTS oophp;
USE oophp;
GRANT ALL ON oophp.* TO user@localhost IDENTIFIED BY "pass";
SET NAMES utf8;

DROP TABLE IF EXISTS `anax_users`;

CREATE TABLE `anax_users`
(
  `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `username` VARCHAR(100) NOT NULL,
  `password` VARCHAR(100),
  `userLevel` INT,

  UNIQUE KEY `username_unique` (`username`)
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;
